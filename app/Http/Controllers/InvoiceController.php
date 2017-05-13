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
                $plan = Plan::where('id', '=', $subscription->id)->value('name');
                $invoice = array('id' => $id, 'date' => $date, 'price' => $price, 'plan' => $plan);
                array_push($invoices, $invoice);
            }
        }

        return view('layouts.user.view_invoices')->with(['user' => $user, 'invoices' => $invoices]);
    }

    public function store(Request $request)
    {
        // Create invoice
        // Calculate the price if the 'discount' or 'ignore_taxes' fields are present
        function calcPrice($request)
        {
            $price = doubleval($request['price']);
            if (isset($request['discount'])) {
                $price = $price - doubleval($request['discount']);
            }

            if (isset($request['ignore_taxes']) && $request['ignore_taxes'] == TRUE) {
                // Remove taxes from price. Assumed 10% GST.
                $price = $price / 1.1;
            }

            return $price;
        }

        $request['price'] = calcPrice($request);
        $this->validate($request, self::rules());
        $invoice = Invoice::create($request->all());

        // Send email
        $user_id = Subscription::where('id', $invoice->subscription_id)->pluck('user_id');
        $user = User::findOrFail($user_id[0]);
        $invoice_id = $invoice->id;
        $inv = Invoice::findOrFail($invoice_id);
        $type = 'old';
        Mail::to($user)->send(new MailInvoice($user, $inv, $type));

        // Update Subscription
        $subscription = Subscription::where('id', $request['subscription_id'])->first();
        // Change the subscription id to the new id if renew_plan_id is set
        if (isset($subscription->renew_plan_id)) {
            $renew_id = $subscription->renew_plan_id;
            $subscription->plan_id = $renew_id;
            $plan = Plan::where('id', $subscription->renew_plan_id)->first();
            $price = $plan->price;
            $subscription->price = $price;
            $subscription->renew_plan_id = NULL;
        }
        // Update the starts_at and ends_at dates
        $starts_at = new \DateTime($subscription['ends_at']);
        $starts_at->add(new \DateInterval('P1D'));
        $ends_at = clone $starts_at;
        $ends_at->add(new \DateInterval('P1M'));
        $ends_at->sub(new \DateInterval('P1D'));
        $subscription->starts_at = $starts_at;
        $subscription->ends_at = $ends_at;
        // Validator only accepts arrays, so create array for validation
        $sub = $subscription->toArray();
        $validator = Validator::make($sub, [
            'plan_id' => 'required',
            'starts_at' => "required|date",
            'ends_at' => "required|date",
            'price' => "required|numeric",
            'renew_plan_id' => "nullable|numeric",
        ]);
        $subscription->save();

        $request->session()->flash('alert-success', 'Invoice created successfully');

        return redirect()->route('admin.invoices_list');
    }

    public static function rules()
    {
        $rules = [
            'subscription_id' => "required|numeric",
            'price' => "required|numeric",
            'discount' => "nullable|numeric",
            'date' => "required|date",
            'ignore_taxes' => "nullable|boolean",
        ];

        return $rules;
    }
}
