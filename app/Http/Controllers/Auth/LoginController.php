<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @Override Method
     *
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        $data = [];
        if ($alert = Session::get('alert')) {
            $data['alert'] = $alert;
        }

        return view('auth.login', $data);
    }

    /**
     * @Override Method
     *
     * 1. If an organisation's pre-paid is true,
     * logout authenticated user and return login page with a danger message.
     *
     * 2. If a player already have a subscription,
     * logout authenticated user and return login page with a info message.
     *
     * 3. If a player does not belongs to any team,
     * logout authenticated user and return login page with an info message.
     *
     * 4. Otherwise, go to homepage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->team && $user->team->organisation) {
            $isPrePaidOrg = $user->team->organisation->pre_paid;
            $orgStandardPrice = $user->team->organisation->standard_subscription_price;
            $orgDiscountedPrice = $user->team->organisation->discounted_subscription_price;

            if ($isPrePaidOrg == true) {
                $this->guard()->logout();
                $request->session()->invalidate();

                $alert['type'] = 'danger';
                $alert['msg'] = 'Your membership of the app is pre-paid and you do not need to complete a subscription. ' .
                    'Please contact support if you have any concerns about this.';

                return redirect()->route('login')->with('alert', $alert);
            } else if ($user->current_subscription != null || $orgStandardPrice == null || $orgDiscountedPrice == null) {
                $this->guard()->logout();
                $request->session()->invalidate();

                $alert['type'] = 'info';
                $alert['msg'] = 'It is not possible for you to access our payment gateway at this time. ' .
                    'Please contact support for more information.';

                return redirect()->route('login')->with('alert', $alert);
            } else
                return redirect()->intended($this->redirectPath());
        } else {
            $this->guard()->logout();
            $request->session()->invalidate();

            $alert['type'] = 'info';
            $alert['msg'] = 'It is not possible for you to access our payment gateway at this time. ' .
                'Please contact support for more information.';

            return redirect()->route('login')->with('alert', $alert);
        }

    }
}
