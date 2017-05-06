@extends('master')

@section('title')
    Unpaid Invoices
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Unpaid Invoices</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Unpaid invoices</div>
                <div class="panel-body">
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Invoice Total</th>
                            <th>Outstanding Amount</th>
                            <th></th>
                        </tr>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
                                <td>${{ number_format($invoice->price, 2) }}</td>
                                <td>${{ number_format($invoice->price, 2) }}</td>
                                <td><a href="" class="btn btn-default">Send Reminder</a></td>
                            </tr>
                        @endforeach
                    </table>
                    <p><a href="{{ route('admin.index') }}" class="btn btn-default">Return to Admin Console</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
