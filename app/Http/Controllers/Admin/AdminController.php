<?php

namespace App\Http\Controllers\Admin;

use App\Plan;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Cashier\Subscription;

class AdminController extends Controller
{
    public function index()
    {
        $numberNewSubscribers = $this->calcNumberOfNewSubscribers();
        $subscribersPerPlan = $this->calcNumberOfSubscribersPerPlan();

        return view('layouts.admin.index')
            ->with('new_subscribers', $numberNewSubscribers)
            ->with('subscribers_plan', $subscribersPerPlan);
    }

    public function calcNumberOfNewSubscribers()
    {
        $today = new \DateTime();
        $recent = $today->sub(new \DateInterval('P1M'));
        $numberUsers = User::where('created_at', '>', $recent)->count();

        return $numberUsers;
    }

    public function calcNumberOfSubscribersPerPlan()
    {
        $plans = Plan::all()->toArray();

        foreach ($plans as &$plan) {
            $subscriptions = Subscription::where('name', '=', $plan['name'])->get();
            $count = count($subscriptions);
            $plan['count'] = $count;
        }

        return $plans;
    }

    public function viewUsers()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (isset($user->subscription->name)) {
                $user['plan'] = $user->subscription->name;
            }
        }

        return view('layouts.admin.all-users')->with('users', $users);
    }

    public function banUser(Request $request)
    {
        $user = User::findOrFail($request['user_id']);
        $user->is_banned = TRUE;
        $user->save();

        $request->session()->flash('alert-success', 'User successfully banned');

        return redirect()->route('admin.view-users');
    }
}
