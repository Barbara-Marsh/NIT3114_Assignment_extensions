<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Plan;
use App\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function edit()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $plan_id = Subscription::where('user_id', $id)->value('plan_id');
        $user['plan'] = Plan::where('id', $plan_id)->value('name');
        $plans = Plan::all()->where('is_active', '==', TRUE);

        return view('layouts.user.edit_subscription_form')->with(['user' => $user['attributes']])->with(['plans' => $plans]);
    }

    public function update(Request $request)
    {
        // TODO: validation

        // TODO: change to take account of new_plan_id variable
        // if open change immediately
        // else change in next billing cycle
        $user_id = Auth::id();
        $plan_id = $request['plan_type'];

        $subscription = Subscription::where('user_id', $user_id)->first();
        $subscription->plan_id = $plan_id;
        $subscription->save();

        $request->session()->flash('alert-success', 'Plan successfully updated');

        return redirect()->route('user.index');
    }

    public function show()
    {
        $plans = Plan::all()->toArray();
        return view('layouts.user.new_subscription')->with(['plans' => $plans]);
    }

    public function store(Request $request)
    {
        // TODO: validation

        $price = Plan::where('id', $request['plan_id'])->value('price');

        $subscription = new Subscription;
        $subscription->user_id = Auth::id();
        $subscription->plan_id = $request['plan_id'];
        $subscription->price = $price;
        $subscription->starts_at = Carbon::now()->toDateString();
        $subscription->ends_at = Carbon::now()->addMonth()->toDateString();
        $subscription->status = 'active';
        $subscription->save();
        $request->session()->flash('alert-success', 'Product subscription created successfully');

        $plan = Plan::where('id', $subscription->plan_id)->first();
        $planName = $plan['name'];

        if ($planName != 'Open') {
            return redirect()->route('user.show_billing');
        } else {
            return redirect()->route('user.show_newsletter');
        }
    }

    public function destroy(Request $request, Subscription $subscription)
    {
        // TODO: create function
    }
}
