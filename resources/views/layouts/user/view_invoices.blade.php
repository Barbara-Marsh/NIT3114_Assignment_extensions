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
                        </tr>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice['id'] }}</td>
                                <td>{{ date('d-m-Y', strtotime($invoice['date'])) }}</td>
                                <td>{{ $invoice['plan'] }}</td>
                                <td>${{ number_format($invoice['price'], 2) }}</td>

                            </tr>
                            <tr>
                        @endforeach
                        <tr>
                            <td colspan="3">
                                <a href="{{ route('user.index', ['user_id' => $user['id']]) }}" class="btn btn-default">Return to Profile</a>
                            </td>
                            <td><a href="{{ route('user.edit_billing', ['user_id' => $user['id']]) }}" class="btn btn-default">Update Payment Details</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2 sidebar">
            @include('layouts.user-right-sidebar')
        </div>
    </div>
@endsection
