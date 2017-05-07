<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use function Sodium\add;

class InvoiceController extends Controller
{
    public function getTotalOwing()
    {
        $user_id = Auth::id();
        $subscriptions = Subscription::where('user_id', $user_id)->get();
        $total_owing = 0.0;

        foreach ($subscriptions as $subscription) {
            $invoice = Invoice::where('subscription_id', $subscription['id'])->value('price');
            if ($invoice != NULL) {
                $total_owing = $total_owing + $invoice;
            }
        }

        return $total_owing;
    }

    public function index_unpaid()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);

        $invoices = DB::table('invoices')
            ->join('subscriptions', function ($join) {
                $join->on('invoices.subscription_id', '=', 'subscriptions.id');
            })->where('subscriptions.user_id', '=', Auth::id())
              ->where('invoices.paid', '=', FALSE)
              ->orderBy('date', 'desc')
              ->get();

        return view('layouts.user.view_unpaid')->with(['user' => $user, 'invoices' => $invoices]);
    }

    public function index_all()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);

        $invoices = DB::table('invoices')
            ->join('subscriptions', function ($join) {
                $join->on('invoices.subscription_id', '=', 'subscriptions.id');
            })->where('subscriptions.user_id', '=', Auth::id())
              ->orderBy('date', 'desc')
              ->get();

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
                $price = $price + doubleval($request['discount']);
            }

            return $price;
        }

        $invoice = new Invoice();
        $invoice->subscription_id = $request['subscription_id'];
        $invoice->price = calcPrice($request);
        $invoice->date = $request['date'];

        if ($request['ignore_taxes'] == TRUE) {
            $invoice->ignore_taxes = TRUE;
        } else {
            $invoice->ignore_taxes = FALSE;
        }

        $invoice->save();

        //update subscription
        $subscription = Subscription::where('id', $request['subscription_id'])->first();
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
