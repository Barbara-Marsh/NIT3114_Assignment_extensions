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
        $outstandingInvoices = $this->calcOutstandingInvoices();

        return view('layouts.admin.index')
            ->with('new_subscribers', $numberNewSubscribers)
            ->with('outstanding', $outstandingInvoices)
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

    public function calcOutstandingInvoices()
    {
        $invoices = Invoice::where('paid', '=', FALSE)->count();

        return $invoices;
    }

    public function createInvoicesList()
    {
        $today = new \DateTime();
        $recent = $today->sub(new \DateInterval('P7D'));
        $subscriptions = Subscription::where('ends_at', '>', $recent)->where('status', '=', 'active')->get();

        //dd($subscriptions);

        return view('layouts.admin.invoices')->with(['subscriptions' => $subscriptions]);
    }

    public function view_outstanding()
    {
        $invoices = DB::table('invoices')
            ->join('subscriptions', function ($join) {
                $join->on('invoices.subscription_id', '=', 'subscriptions.id');
            })
                ->where('invoices.paid', '=', FALSE)
                ->orderBy('date', 'desc')
                ->get();

        return view('layouts.admin.view_unpaid')->with(['invoices' => $invoices]);
    }
}
