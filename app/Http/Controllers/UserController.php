<?php

namespace App\Http\Controllers;

use App\BillingDetails;
use App\User;
use App\UserSettings;
use App\Subscription;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user['subscription'] = Subscription::where('user_id', $id)->first()->toArray();
        $plan_id = (int)$user['subscription']['plan_id'];
        $user['plan'] = Plan::where('id', $plan_id)->first()->toArray();
        $user['billing'] = BillingDetails::where('user_id', $id)->first()->toArray();
        $user['newsletter'] = UserSettings::where('user_id', $id)->value('subscribed_to_newsletter');
        $user['offers'] = UserSettings::where('user_id', $id)->value('third_party_offers');

        return view('layouts/profile')->with(['user' => $user['attributes']]);
    }

    public function edit_plan()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $plan_id = Subscription::where('user_id', $id)->value('plan_id');
        $user['plan'] = Plan::where('id', $plan_id)->value('name');
        $plans = Plan::all()->toArray();

        return view('layouts.user.edit_plan_form')->with(['user' => $user['attributes']])->with(['plans' => $plans]);
    }

    public function update_plan()
    {

    }

    public function edit_subscription()
    {
        $id = Auth::id();
        $user_settings = UserSettings::where('user_id', $id)->first()->toArray();

        return view('layouts.user.edit_subscription_form')->with(['user_settings' => $user_settings]);
    }

    public function update_subscription()
    {

    }

    public function edit_billing()
    {
        $id = Auth::id();

        return view('layouts.user.edit_billing_form');
    }

    public function update_billing()
    {

    }
}
