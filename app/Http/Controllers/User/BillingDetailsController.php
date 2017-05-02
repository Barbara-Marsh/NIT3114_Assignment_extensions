<?php

namespace App\Http\Controllers\User;

use App\BillingDetails;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillingDetailsController extends Controller
{
    public function edit()
    {
        $id = Auth::id();
        $billing_details = BillingDetails::where('user_id', $id)->first()->toArray();

        return view('layouts.user.edit_billing_form')->with(['billing_details' => $billing_details]);
    }

    public function update(Request $request)
    {
        // TODO: validation

        $billingDetails = BillingDetails::where('id', $request['id'])->first();
        $billingDetails->update($request->all());

        $request->session()->flash('alert-success', 'Billing details successfully updated');
        return redirect()->route('user.index');
    }

    public function show()
    {
        return view('layouts.user.new_billing_form');
    }

    public function store(Request $request)
    {
        // TODO: validation

        // TODO: make card number collection more secure

        $billingDetails = new BillingDetails;
        $billingDetails->user_id = Auth::id();
        $billingDetails->card_name = $request['card_name'];
        $billingDetails->card_number = $request['card_number'];
        $billingDetails->expiry = $request['expiry'];
        $billingDetails->csv = $request['csv'];
        $billingDetails->save();

        $request->session()->flash('alert-success', 'Billing details added successfully');

        return redirect()->route('user.show_newsletter');
    }

    public function destroy()
    {
        // TODO: complete function
    }
}
