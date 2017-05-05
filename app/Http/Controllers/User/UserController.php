<?php

namespace App\Http\Controllers\User;

use App\Http\Middleware\Admin;
use App\User;
use App\Subscription;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);

        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.index');
        }

        $subscription = Subscription::where('user_id', $id)->first()->toArray();
        $plan_id = (int)$subscription['plan_id'];
        $plan = Plan::where('id', $plan_id)->first()->toArray();
        $renew_plan_id = (int)$subscription['renew_plan_id'];
        $renew_plan = Plan::where('id', $renew_plan_id)->first();

        return view('layouts/profile')->with(['user' => $user, 'subscription' => $subscription, 'plan' => $plan, 'renew_plan' => $renew_plan]);
    }

    public function edit_newsletter_settings()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);

        return view('layouts.user.edit_newsletter_form')->with(['user' => $user]);
    }

    public function update_newsletter_settings(Request $request)
    {
        // TODO: validation

        $id = Auth::id();
        $user = User::findOrFail($id);
        $newsletter = FALSE;
        $third_party = FALSE;
        if ($request['subscribed_to_newsletter'] && $request['subscribed_to_newsletter'] === 'on') {
            $newsletter = TRUE;
        }
        if ($request['third_party_offers'] && $request['third_party_offers'] === 'on') {
            $third_party = TRUE;
        }
        $user->subscribed_to_newsletter = $newsletter;
        $user->third_party_offers = $third_party;
        $user->update();

        $request->session()->flash('alert-success', 'Newsletter settings successfully updated');

        return redirect()->route('user.index');
    }

    public function show_newsletter_settings()
    {
        return view('layouts.user.new_newsletter_form');
    }

    public function store_newsletter_settings(Request $request)
    {
        // TODO: validation

        $id = Auth::id();
        $user = User::findOrFail($id);
        $newsletter = FALSE;
        $third_party = FALSE;
        if ($request['subscribed_to_newsletter']) {
            $newsletter = TRUE;
        }
        if ($request['third_party_offers']) {
            $third_party = TRUE;
        }
        $user->subscribed_to_newsletter = $newsletter;
        $user->third_party_offers = $third_party;
        $user->save();

        $request->session()->flash('alert-success', 'Product subscription created successfully');

        return redirect()->route('user.index');
    }

    public function edit_billing()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);

        return view('layouts.user.edit_billing_form')->with(['user' => $user]);
    }

    public function update_billing(Request $request)
    {
        // TODO: validation

        $user = User::where('id', $request['id'])->first();
        $user->card_name = $request['card_name'];
        $user->card_number = $request['card_number'];
        $user->expiry = $request['expiry'];
        $user->csv = $request['csv'];
        $user->update();

        $request->session()->flash('alert-success', 'Billing details successfully updated');
        return redirect()->route('user.index');
    }

    public function show_billing()
    {
        return view('layouts.user.new_billing_form');
    }

    public function store_billing(Request $request)
    {
        // TODO: validation

        // TODO: make card number collection more secure

        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->card_name = $request['card_name'];
        $user->card_number = $request['card_number'];
        $user->expiry = $request['expiry'];
        $user->csv = $request['csv'];
        $user->save();

        $request->session()->flash('alert-success', 'Billing details added successfully');

        return redirect()->route('user.show_newsletter');
    }
}
