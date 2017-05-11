<?php

namespace App\Http\Controllers\Admin;

use App\Invoice;
use App\Plan;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
            $subscriptions = Subscription::where('plan_id', '=', $plan['id'])->get();
            $count = count($subscriptions);
            $plan['count'] = $count;
        }

        return $plans;
    }

    public function invoicesList()
    {
        $today = new \DateTime();
        $recent = $today->sub(new \DateInterval('P7D'));
        $recent = $recent->format('Y-m-d H:i');
        $max = $today->add(new \DateInterval('P60D'));
        $max = $max->format('Y-m-d H:i');
        $subscriptions = Subscription::where('status', '=', 'active')->whereBetween('ends_at', [$recent, $max])->get();

        return view('layouts.admin.invoices')->with(['subscriptions' => $subscriptions]);
    }

    public function createInvoice(Request $request)
    {
        $subscription = json_decode($request['subscription']);
        $date = date("Y-m-d H:i:s");
        return view('layouts.admin.create-invoices')
            ->with('subscription', $subscription)
            ->with('date', $date);
    }
}
