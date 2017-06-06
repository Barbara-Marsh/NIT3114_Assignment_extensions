<?php

namespace App\Http\Controllers\User;

use App\Plan;
use App\User;
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

class SubscriptionController extends Controller
{
    public function show()
    {
        $plans = Plan::all()->toArray();
        $user_id = Auth::id();
        $email = User::where('id', '=', $user_id)->value('email');

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
        $subscription = $user->activeSubscription();
        $current_plan = $subscription->name;
        $stripe_id = $request->get('stripe_id');
        $user->subscription($current_plan)->swap($stripe_id);

        // manually update name field of subscription table because swap() method doesn't do it
        // had to do db call because update wouldn't work when using $subscription variable directly
        Subscription::where('id', $subscription->id)->update(['name' => $request->get('name')]);

        Mail::to($user)->send(new UpdatePlan($user));
        $request->session()->flash('alert-success', "Subscription Updated. Please check your invoices.");

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
