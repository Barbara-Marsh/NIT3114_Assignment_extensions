<?php

namespace App\Http\Controllers\User;

use App\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;
use App\Mail\Goodbye;
use App\Mail\Resume;
use App\Mail\UpdateCard;
use App\Mail\UpdatePlan;
use Laravel\Cashier\Subscription;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    public function show()
    {
        $plans = Plan::all()->toArray();
        $user = Auth::user();
        $email = $user->email;

        return view('layouts.user.new_subscription')->with(['plans' => $plans, 'email' => $email]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $plan = Plan::findOrFail($request['plan_id']);
        $stripeToken = $request->get('stripeToken');

        $user->newSubscription($plan->name, $plan->stripe_id)->create($stripeToken);

        Mail::to($user)->send(new Welcome($user));

        $request->session()->flash('alert-success', 'Product subscription created successfully');

        return redirect()->route('user.index');
    }

    public function cancel(Request $request)
    {
        $id = $request->get('subscription_id');

        $subscription = Subscription::find($id);
        $subscription->cancel();

        $user = Auth::user();
        Mail::to($user)->send(new Goodbye($user));

        $request->session()->flash('alert-success', "Subscription Cancelled. Please see your profile for end date of your account.");
        return redirect()->route('user.index');
    }

    public function resume(Request $request)
    {
        $id = $request->get('subscription_id');
        $user = Auth::user();

        $subscription = Subscription::find($id);
        $subscription->resume();
        Mail::to($user)->send(new Resume($user));

        $request->session()->flash('alert-success', "Subscription Reset. Welcome back!");
        return redirect()->route('user.index');
    }


    public function edit()
    {
        $plans = Plan::all()->toArray();
        $user = Auth::user();
        $email = $user->email;
        $subscription_name = Subscription::where('user_id', $user->id)->value('name');

        return view('layouts.user.edit_subscription')->with(['plans' => $plans, 'current_plan_name' => $subscription_name, 'email' => $email]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $subscription = $user->subscription;
        $current_plan = $subscription->stripe_plan;
        $stripe_id = $request->get('stripe_id');
        //$stripe_name = $request->get('name');
        //dd($stripe_id); //basic

        Stripe::setApiKey(config('services.stripe.secret'));

        //$subscription = \Stripe\Subscription::retrieve($stripe_id);
        /*$subscription->stripe_plan = $stripe_id;
        $subscription->name = $stripe_name;
        $subscription->save();*/

        // this method didn't work
        $user->subscription($current_plan)->swap($stripe_id);

        // this method charges immediately
        // and updates local db but not stripe
        /*$user->subscription->stripe_plan = $stripe_id;
        $user->subscription->name = $name;
        $user->subscription->save();*/

        Mail::to($user)->send(new UpdatePlan($user));
        $request->session()->flash('alert-success', "Subscription Updated. Any additional fees incurred from changing your plan will be added to your next invoice.");

        return redirect()->route('user.index');
    }

    public function edit_card()
    {
        $user = Auth::user();
        $email = $user->email;

        return view('layouts.user.edit_card')->with(['email' => $email]);
    }

    public function update_card(Request $request)
    {
        $stripeToken = $request->get('stripeToken');
        $user = Auth::user();
        $user->updateCard($stripeToken);
        Mail::to($user)->send(new UpdateCard($user));

        $request->session()->flash('alert-success', "Card Updated.");

        return redirect()->route('user.index');
    }

    public function listInvoices()
    {
        $user = Auth::user();
        $invoices = $user->invoicesIncludingPending();

        return view('layouts.user.view_invoices')->with(['invoices' => $invoices]);
    }

    public function downloadInvoice(Request $request)
    {
        $invoiceId = $request->get('invoiceId');

        return $request->user()->downloadInvoice($invoiceId, [
            'header' => 'Thank you for your payment',
            'vendor'  => 'Australian Weather Services',
            'product' => 'Subscription',
            'street' => '11 Elm Street',
            'location'=>'Footscray VIC 3011',
            'phone' => '4242 4242 42',
            'url' => 'www.example.com',
        ]);
    }
}
