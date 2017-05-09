@extends('master')

@section('title')
    All Invoices
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>All Invoices</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2 sidebar">
            @include('layouts.user-sidebar')
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Your invoices</div>
                <div class="panel-body">
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Plan</th>
                            <th>Invoice Total</th>
                            <th>Outstanding Amount</th>
                        </tr>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice['id'] }}</td>
                                <td>{{ date('d-m-Y', strtotime($invoice['date'])) }}</td>
                                <td>{{ $invoice['plan'] }}</td>
                                <td>${{ number_format($invoice['price'], 2) }}</td>
                                @if($invoice['paid'] == FALSE)
                                    <td>${{ number_format($invoice['price'], 2) }}</td>
                                @else
                                    <td>${{ number_format(0, 2) }}</td>
                                @endif
                            </tr>
                            <tr>
                        @endforeach
                        <tr>
                            <td colspan="4"></td>
                            <td><a href="{{ route('user.edit_billing', ['user_id' => $user['id']]) }}" class="btn btn-default">Update Payment Details</a></td>
                        </tr>
                    </table>
                    <p>Please pay any outstanding amounts as soon as possible to avoid disruption to your service.</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 sidebar">
            @include('layouts.user-right-sidebar')
        </div>
    </div>
@endsection
