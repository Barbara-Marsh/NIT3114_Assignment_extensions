<?php

namespace App\Http\Controllers\User;

use App\User;
use App\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserSettingsController extends Controller
{
    public function edit()
    {
        $id = Auth::id();
        $user_settings = UserSettings::where('user_id', $id)->first()->toArray();

        return view('layouts.user.edit_newsletter_form')->with(['user_settings' => $user_settings]);
    }

    public function update(Request $request)
    {
        // TODO: validation

        $user_id = Auth::id();
        $userSettings = UserSettings::where('user_id', $user_id)->first();

        $newsletter = FALSE;
        $third_party = FALSE;

        if ($request['subscribed_to_newsletter']) {
            $newsletter = TRUE;
        }

        if ($request['third_party_offers']) {
            $third_party = TRUE;
        }

        $userSettings->subscribed_to_newsletter = $newsletter;
        $userSettings->third_party_offers = $third_party;
        //var_dump($userSettings);

        $userSettings->update();

        $request->session()->flash('alert-success', 'Newsletter settings successfully updated');

        return redirect()->route('user.index');
    }

    public function show()
    {
        return view('layouts.user.new_newsletter_form');
    }

    public function store(Request $request)
    {
        // TODO: validation

        $newsletter = FALSE;
        $third_party = FALSE;

        if ($request['subscribed_to_newsletter']) {
            $newsletter = TRUE;
        }

        if ($request['third_party_offers']) {
            $third_party = TRUE;
        }

        $userSettings = new UserSettings;
        $userSettings->user_id = Auth::id();
        $userSettings->subscribed_to_newsletter = $newsletter;
        $userSettings->third_party_offers = $third_party;
        $userSettings->save();
        $request->session()->flash('alert-success', 'Product subscription created successfully');

        return redirect()->route('user.index');
    }

    public function destroy()
    {
        // TODO: create function
    }
}
