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
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.index');
        }

        $id = Auth::id();
        $user = User::findOrFail($id);
        $subscriptions = $user->subscriptions()->get();

        return view('layouts/profile')->with(['user' => $user, 'subscriptions' => $subscriptions]);
    }

    public function edit_newsletter_settings()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);

        return view('layouts.user.edit_newsletter_form')->with(['user' => $user]);
    }

    public function update_newsletter_settings(Request $request)
    {
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
        $user->save();

        $request->session()->flash('alert-success', 'Newsletter settings successfully updated');

        return redirect()->route('user.index');
    }

    public function show_newsletter_settings()
    {
        return view('layouts.user.new_newsletter_form');
    }

    public function store_newsletter_settings(Request $request)
    {
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

        $request->session()->flash('alert-success', 'Registration successful');

        return redirect()->route('user.index');
    }
}
