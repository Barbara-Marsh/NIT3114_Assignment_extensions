<?php

namespace App\Http\Controllers\User;

use App\Invoice;
use App\User;
use App\Plan;
use App\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invoice as MailInvoice;
use Validator;

class SubscriptionController extends Controller
{
    public function edit()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $plan_id = Subscription::where('user_id', $id)->value('plan_id');
        $user['plan'] = Plan::where('id', $plan_id)->value('name');
        $plans = Plan::all()->where('is_active', '==', TRUE);

        return view('layouts.user.edit_subscription_form')->with(['user' => $user['attributes']])->with(['plans' => $plans]);
    }

    public function update(Request $request)
    {
        $user_id = Auth::id();
        $plan_id = $request['plan_id'];
        $subscription = Subscription::where('user_id', $user_id)->first();

        // If original plan was Open, change to new plan immediately, else change plan in next billing cycle
        if ($subscription['plan_id'] == 1) {
            $price = Plan::where('id', $request['plan_id'])->value('price');
            $request['price'] = $price;
            $request['starts_at'] = Carbon::now()->toDateString();
            $request['ends_at'] = Carbon::now()->addMonth()->toDateString();
            $request['status'] = 'active';
            $this->validate($request, [
                'price' => "numeric",
                'starts_at' => "required|date",
                'ends_at' => "required|date",
                'status' => 'required',
            ]);
            $subscription->update($request->all());
            if ($request['renew_plan_id'] == 0) {
                $subscription->renew_plan_id = $request['renew_plan_id'];
                $subscription->save();
                $request->session()->flash('alert-info', "Your plan has been canceled. We're sorry to see you go.");

                return redirect()->route('user.index');
            } else {
                $request->session()->flash('alert-success', 'Plan successfully updated, please update your payment method');

                return redirect()->route('user.show_billing')->with(['create_invoice' => 'true']);
            }



        } else {
            $request['renew_plan_id'] = $plan_id;
            $this->validate($request, [
                'renew_plan_id' => "numeric|nullable",
            ]);
            $subscription->renew_plan_id = $request['renew_plan_id'];
            $subscription->status = 'active';
            $subscription->save();

            // If the user has chosen to cancel their plan, redirect to profile page with message
            if ($request['renew_plan_id'] == 0) {
                $subscription->renew_plan_id = $request['renew_plan_id'];
                $subscription->save();
                $request->session()->flash('alert-info', "Your plan has been canceled. We're sorry to see you go.");

                return redirect()->route('user.index');
            }
            $request->session()->flash('alert-success', 'Plan successfully updated');

            return redirect()->route('user.index');
        }
    }

    public function show()
    {
        $plans = Plan::all()->toArray();
        return view('layouts.user.new_subscription')->with(['plans' => $plans]);
    }

    public function store(Request $request)
    {
        $price = Plan::where('id', $request['plan_id'])->value('price');

        // Create Subscription
        $request['user_id'] = Auth::id();
        $request['price'] = $price;
        $request['starts_at'] = Carbon::now()->toDateString();
        $request['ends_at'] = Carbon::now()->addMonth()->toDateString();
        $request['status'] = 'active';

        $this->validate($request, self::rules());
        $subscription = Subscription::create($request->all());

        // Create Invoice
        $invoice = array();
        $invoice['subscription_id'] = $subscription->id;
        $invoice['price'] = $price;
        $invoice['date'] = Carbon::now()->toDateString();
        $invoice['ignore_taxes'] = FALSE;

        $validator = Validator::make($invoice, [
            'subscription_id' => 'required',
            'price' => "required|numeric",
            'date' => "required|date",
            'ignore_taxes' => "required|boolean",
        ]);

        $new_inv = Invoice::create($invoice);

        // Send email
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $invoice_id = $new_inv->id;
        $inv = Invoice::findOrFail($invoice_id);
        $type = 'new';
        Mail::to($user)->send(new MailInvoice($user, $inv, $type));

        $request->session()->flash('alert-success', 'Product subscription created successfully');

        $plan = Plan::where('id', $subscription->plan_id)->first();
        $planName = $plan['name'];

        if ($planName != 'Open') {
            return redirect()->route('user.show_billing');
        } else {
            return redirect()->route('user.show_newsletter');
        }
    }

    public static function rules()
    {
        $rules = [
            'user_id' => 'required',
            'plan_id' => 'required',
            'renew_plan_id' => 'nullable',
            'price' => "numeric",
            'starts_at' => "required|date",
            'ends_at' => "required|date",
            'status' => 'required',
        ];

        return $rules;
    }
}
