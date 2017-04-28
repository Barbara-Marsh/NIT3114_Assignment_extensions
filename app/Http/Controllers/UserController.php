<?php

namespace App\Http\Controllers;

use App\User;
use App\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user['plan'] = ''; // TODO: Get this working

        $user['subscription'] = UserSettings::where('user_id', $id)->value('subscribed_to_newsletter');
        $user['offers'] = UserSettings::where('user_id', $id)->value('third_party_offers');;

        return view('layouts/profile')->with(['user' => $user]);
    }
}
