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
        $user['subscription']['ends_at'];
        $plan_id = (int)$user['subscription']['plan_id'];
        $user['plan'] = Plan::where('id', $plan_id)->first()->toArray();
        $user['billing'] = BillingDetails::where('user_id', $id)->first()->toArray();
        $user['newsletter'] = UserSettings::where('user_id', $id)->value('subscribed_to_newsletter');
        $user['offers'] = UserSettings::where('user_id', $id)->value('third_party_offers');

        return view('layouts/profile')->with(['user' => $user['attributes']]);
    }
}
