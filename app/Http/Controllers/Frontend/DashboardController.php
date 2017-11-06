<?php

namespace App\Http\Controllers\Frontend;

use App\UserSubscription;
use Cartalyst\Stripe\Exception\StripeException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $standardPrice = $user->team->organisation->standardPrice->price;
        $discountedPrice = $user->team->organisation->discountedPrice->price;

        $data = [
            'user' => $user,
            'standardPrice' => $standardPrice,
            'discountedPrice' => $discountedPrice
        ];

        return view('frontend.home', $data);
    }

    /**
     * Create a Stripe charge + subscription with Credit Card.
     *
     * ==
     *
     * Package 1 - Annual commitment, no prepaid period
     * @param : planType = 1, planAmount = discounted price, planTrialPeriod = 0
     *
     * Package 2 - No annual commitment, no prepaid period
     * @param : planType = 2, planAmount = standard price, planTrialPeriod = 0
     *
     * Package 3 - Annual commitment, 3 months prepaid
     * @param : planType = 1, planAmount = discounted price, planTrialPeriod = 90 days
     *
     * Package 4 - Annual commitment (implied), one year prepaid
     * @param : planType = 1, planAmount = discounted price, planTrialPeriod = 365 days
     *
     * ==
     *
     * Package Setup Fee - unless add the equipment in Package 1 & 2
     * @param : chargeType = 1, chargeAmount = 0.00
     *
     * Equipment Setup Fee - if add the equipment in Package 1 & 2
     * @param : chargeType = 2, chargeAmount = 150.00
     *
     * Package + Equipment Setup Fee - required in Package 3 & 4
     * @param : chargeType = 3, chargeAmount = number of prepaid months x discounted price + equipment setup fee
     *
     * ==
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        $user = Auth::user();
        $orgStandard = $user->team->organisation->standardPrice;
        $orgDiscounted = $user->team->organisation->discountedPrice;

        $token = $request->input('stripeToken');
        $email = $request->input('stripeEmail');
        $planType = (int) $request->input('planType');
        $planAmount = (float) $request->input('planAmount');
        $planTrialPeriod = (int) $request->input('planTrialPeriod');
        $chargeType = (int) $request->input('chargeType');
        $chargeAmount = (float) $request->input('chargeAmount');

        // Define the plan id & name
        if ($planType == 1) {
            $planId = 'discounted_' . $orgDiscounted->name;
            $planName = 'Discounted Monthly Plan ($' . $orgDiscounted->price . ')';
        } else {
            $planId = 'standard_' . $orgStandard->name;
            $planName = 'Standard Monthly Plan ($' . $orgStandard->price . ')';
        }

        // Define the charge description
        if ($chargeType == 1)
            $chargeDesc = 'Package Setup Fee';
        else if ($chargeType == 2)
            $chargeDesc = 'Equipment Setup Fee';
        else
            $chargeDesc = 'Package + Equipment Setup Fee';

        // Create or Retrieve a customer
        try {
            $customerList = Stripe::customers()->all();
            $customers = $customerList['data'];
            $customer = null;

            if(!empty($customers)) {
                foreach($customers as $person) {
                    if($person['email'] == $email) {
                        $customer = $person;
                        break;
                    }
                }

                if(empty($customer)) {
                    $customer = Stripe::customers()->create(array(
                        'email' => $email,
                        'card'  => $token
                    ));
                }
            } else {
                $customer = Stripe::customers()->create(array(
                    'email' => $email,
                    'card'  => $token
                ));
            }
        }
        catch (StripeException $e) {
            $result = [
                'error' => 'Customer creation/retrieval was failed!'
            ];

            return response()->json($result, 200);
        }

        // Create or Retrieve a plan
        try {
            $planList = Stripe::plans()->all();
            $plans = $planList['data'];
            $plan = null;

            if(!empty($plans)) {
                foreach($plans as $p) {
                    if($p['id'] == $planId) {
                        $plan = $p;
                        break;
                    }
                }

                if(empty($plan)) {
                    $plan = Stripe::plans()->create(array(
                        'id'                   => $planId,
                        'name'                 => $planName,
                        'amount'               => $planAmount,
                        'currency'             => 'usd',
                        'interval'             => 'month',
                        'statement_descriptor' => 'Monthly Plan'
                    ));
                }
            } else {
                $plan = Stripe::plans()->create(array(
                    'id'                   => $planId,
                    'name'                 => $planName,
                    'amount'               => $planAmount,
                    'currency'             => 'usd',
                    'interval'             => 'month',
                    'statement_descriptor' => 'Monthly Plan'
                ));
            }
        }
        catch (StripeException $e) {
            $result = [
                'error' => 'Plan creation/retrieval was failed!'
            ];

            return response()->json($result, 200);
        }

        // Create a subscription
        try {
            $trialPeriod = null;
            if ($planTrialPeriod > 0)
                $trialPeriod = time() + $planTrialPeriod * 86400; // Convert days to unix timestamp

            $subscription = Stripe::subscriptions()->create($customer['id'], [
                'plan' => $plan['id'],
                'trial_end' => $trialPeriod
            ]);
        }
        catch (StripeException $e) {
            $result = [
                'error' => 'Subscription creation was failed!'
            ];

            return response()->json($result, 200);
        }

        // Create a charge
        if ($chargeAmount > 0) {
            try {
                $charge = Stripe::charges()->create(array(
                    'customer'      => $customer['id'],
                    'amount'        => $chargeAmount,
                    'currency'      => 'usd',
                    'description'   => $chargeDesc
                ));
            }
            catch (StripeException $e) {
                $result = [
                    'error' => 'Charge creation was failed!'
                ];

                return response()->json($result, 200);
            }
        }

        // Save the customer, plan, subscription, charge response data
        if (!empty($subscription)) {

            $userSubscription = UserSubscription::where('player_id', $user->player_id)->first();
            if ($userSubscription == null)
                $userSubscription = new UserSubscription;

            $userSubscription->player_id = $user->player_id;
            $userSubscription->customer_id = $customer['id'];
            $userSubscription->plan_id = $plan['id'];
            $userSubscription->plan_amount = $plan['amount'] / 100;
            $userSubscription->subscription_id = $subscription['id'];
            $userSubscription->subscription_status = $subscription['status'];

            if (!empty($charge)) {
                $userSubscription->charge_id = $charge['id'];
                $userSubscription->charge_amount = $charge['amount'] / 100;
                $userSubscription->charge_currency = $charge['currency'];
                $userSubscription->charge_status = $charge['status'];
                $userSubscription->charge_data = serialize($charge);
            }

            $userSubscription->plan_data = serialize($plan);
            $userSubscription->customer_creation_data = serialize($customer);
            $userSubscription->subscription_data = serialize($subscription);
            $userSubscription->save();

            $user->current_subscription = $userSubscription->player_subscription_id;
            $user->save();
        } else {
            $result = [
                'error' => 'Payment was failed!'
            ];

            return response()->json($result, 200);
        }

        $result = [
            'success' => 'Payment was succeeded!'
        ];

        return response()->json($result, 200);
    }
}
