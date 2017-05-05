<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
