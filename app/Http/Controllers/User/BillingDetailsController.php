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
        $billingDetails = BillingDetails::where('id', $request['id'])->first();
        $billingDetails->update($request->all());

        $request->session()->flash('alert-success', 'Billing details successfully updated');
        return redirect()->route('user.index');
    }
}
