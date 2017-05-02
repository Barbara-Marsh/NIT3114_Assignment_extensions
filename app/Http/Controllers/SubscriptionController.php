<?php

namespace App\Http\Controllers;

use App\User;
use App\Plan;
use App\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function edit()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $plan_id = Subscription::where('user_id', $id)->value('plan_id');
        $user['plan'] = Plan::where('id', $plan_id)->value('name');
        $plans = Plan::all()->toArray();

        return view('layouts.user.edit_subscription_form')->with(['user' => $user['attributes']])->with(['plans' => $plans]);
    }

    public function update(Request $request)
    {
        $user_id = Auth::id();
        $plan_id = $request['plan_type'];

        $subscription = Subscription::where('user_id', $user_id)->first();
        $subscription->plan_id = $plan_id;
        $subscription->save();

        $request->session()->flash('alert-success', 'Plan successfully updated');

        return redirect()->route('user.index');
    }

    public function store(Request $request)
    {

    }

    public function destroy(Request $request, Subscription $subscription)
    {

    }
}
