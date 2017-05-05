<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use function Sodium\add;

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
}
