<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Plan;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\Invoice as MailInvoice;

class InvoiceController extends Controller
{
    public function getTotalOwing()
    {
        $user_id = Auth::id();
        $subscriptions = Subscription::where('user_id', $user_id)->get();
        $total_owing = 0.0;

        foreach ($subscriptions as $subscription) {
            $invoices = Invoice::where('subscription_id', $subscription['id'])->where('paid', '=', FALSE)->get();
            foreach ($invoices as $invoice) {
                $total_owing = $total_owing + $invoice->price;
            }
        }

        return $total_owing;
    }

    public function index_unpaid()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);

        $subscriptions = Subscription::where('user_id', '=', $id)->get();
        $invoices = [];

        foreach ($subscriptions as $subscription) {
            $invoiceData = Invoice::where('subscription_id', '=', $subscription->id)
                ->where('paid', '=', FALSE)
                ->orderBy('date', 'desc')
                ->get()->toArray();

            foreach ($invoiceData as $datum) {
                $id = $datum['id'];
                $date = $datum['date'];
                $price = $datum['price'];
                $plan = Plan::where('id', '=', $subscription->id)->value('name');
                $invoice = array('id' => $id, 'date' => $date, 'price' => $price, 'plan' => $plan);
                array_push($invoices, $invoice);
            }
        }

        return view('layouts.user.view_unpaid')->with(['user' => $user, 'invoices' => $invoices]);
    }

    public function index_all()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);

        $subscriptions = Subscription::where('user_id', '=', $id)->get();
        $invoices = [];

        foreach ($subscriptions as $subscription) {
            $invoiceData = Invoice::where('subscription_id', '=', $subscription->id)
                ->orderBy('date', 'desc')
                ->get()->toArray();

            foreach ($invoiceData as $datum) {
                $id = $datum['id'];
                $date = $datum['date'];
                $price = $datum['price'];
                $paid = $datum['paid'];
                $plan = Plan::where('id', '=', $subscription->id)->value('name');
                $invoice = array('id' => $id, 'date' => $date, 'price' => $price, 'paid' => $paid, 'plan' => $plan);
                array_push($invoices, $invoice);
            }
        }

        return view('layouts.user.view_all')->with(['user' => $user, 'invoices' => $invoices]);
    }

    public function store(Request $request)
    {
        // TODO: validation

         //create invoice
        function calcPrice($request)
        {
            $price = doubleval($request['price']);
            if (isset($request['discount'])) {
                $price = $price - doubleval($request['discount']);
            }

            return $price;
        }

        $invoice = new Invoice();
        $invoice->subscription_id = $request['subscription_id'];
        $invoice->price = calcPrice($request);
        $invoice->date = $request['date'];

        if ($request['ignore_taxes'] == TRUE) {
            $invoice->ignore_taxes = TRUE;
            $invoice->price = $invoice->price / 1.1;
        } else {
            $invoice->ignore_taxes = FALSE;
        }
        $invoice->save();

        // send email
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $invoice_id = $invoice->id;
        $inv = Invoice::findOrFail($invoice_id);
        $type = 'old';
        Mail::to($user)->send(new MailInvoice($user, $inv, $type));

        //update subscription
        $subscription = Subscription::where('id', $request['subscription_id'])->first();
        if (isset($subscription->renew_plan_id)) {
            $renew_id = $subscription->renew_plan_id;
            $subscription->plan_id = $renew_id;
            $plan = Plan::where('id', $subscription->renew_plan_id)->first();
            $price = $plan->price;
            $subscription->price = $price;
            $subscription->renew_plan_id = NULL;
        }

        $starts_at = new \DateTime($subscription['ends_at']);
        $starts_at->add(new \DateInterval('P1D'));
        $ends_at = clone $starts_at;
        $ends_at->add(new \DateInterval('P1M'));
        $ends_at->sub(new \DateInterval('P1D'));
        $subscription->starts_at = $starts_at;
        $subscription->ends_at = $ends_at;
        $subscription->update();

        $request->session()->flash('alert-success', 'Invoice created successfully');

        return redirect()->route('admin.invoices_list');
    }
}
