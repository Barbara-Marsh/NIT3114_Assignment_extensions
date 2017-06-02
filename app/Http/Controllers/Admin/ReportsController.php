<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function getInvoices()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $start_date = Carbon::now()->subMonth(1)->timestamp;
        $invoice_request = \Stripe\Invoice::all(array('date' => array('gte' => $start_date)));
        $invoices = $invoice_request->data;
        $report_data = [];
        foreach ($invoices as $invoice) {
            $invoice_data = [];
            $invoice_data['id'] = $invoice['id'];
            $invoice_data['customer_id'] = $invoice['customer'];
            $invoice_data['customer_name'] = User::where('stripe_id', '=', $invoice['customer'])->value('name');
            $invoice_data['lines'] = [];
            Carbon::setToStringFormat('d-m-Y');
            foreach ($invoice['lines']->data as $line) {
                $invoice_data['lines'][] = [
                    'total_amount' => $line['amount'] / 100,
                    'description' => $line['description'],
                    'plan_name' => $line['plan']['name'],
                    'amount' => $line['plan']['amount'] / 100,
                    'start' => Carbon::createFromTimestamp($line['period']['start'])->__toString(),
                    'end' => Carbon::createFromTimestamp($line['period']['end'])->__toString(),
                ];
            }
            Carbon::resetToStringFormat();
            $report_data[] = $invoice_data;
        }

        return view('layouts.admin.invoices')->with(['invoices' => $report_data]);
    }
}
