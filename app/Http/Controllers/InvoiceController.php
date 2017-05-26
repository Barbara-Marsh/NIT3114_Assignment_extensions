<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Plan;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invoice as MailInvoice;
use Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);

        /*
        $subscriptions = Subscription::where('user_id', '=', $id)->get();
        $invoices = [];

        foreach ($subscriptions as $subscription) {
            $invoiceData = Invoice::where('subscription_id', '=', $subscription->id)
                ->orderBy('date', 'desc')
                ->get()
                ->toArray();

            foreach ($invoiceData as $datum) {
                $id = $datum['id'];
                $date = $datum['date'];
                $price = $datum['price'];
                $plan = Plan::where('id', '=', $subscription->plan_id)->value('name');
                $invoice = array('id' => $id, 'date' => $date, 'price' => $price, 'plan' => $plan);
                array_push($invoices, $invoice);
            }
        }
        */

        return view('layouts.user.view_invoices')->with(['user' => $user, 'invoices' => $invoices]);
    }

}
