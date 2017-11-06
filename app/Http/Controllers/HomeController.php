<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Redirect the login page if not authenticated
     *
     * Render the dashboard if authenticated.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Redirect the success page if the payment was completed successfully
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $guard = Auth::guard();
        $guard->logout();
        $request->session()->invalidate();

        return view('frontend.success');
    }
}
