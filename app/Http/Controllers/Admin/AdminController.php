<?php

namespace App\Http\Controllers\Admin;

use App\Plan;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $numberNewUsers = $this->calcNumberOfNewSubscribers();
        $subscribersPerPlan = $this->calcNumberSubscribersPerPlan();
        //dd($numberNewUsers);

        return view('admin.index')->with('new_subscribers', $numberNewUsers);
    }

    public function calcNumberOfNewSubscribers()
    {
        $today = new \DateTime();
        $recent = $today->sub(new \DateInterval('P1M'));
        $numberUsers = User::where('created_at', '>', $recent)->count();

        return $numberUsers;
    }

    public function calcNumberSubscribersPerPlan()
    {
        $subscriptions = Subscription::all();
    }
}
