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
                            <th>Invoice Date</th>
                            <th>Invoice Total</th>
                            <th></th>
                        </tr>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                                <td>{{ $invoice->total() }}</td>
                                <td style="text-align: right">
                                    <form action="{{ Route('user.download_invoice') }}" method="get">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="invoiceId" value="{{ $invoice->id }}">
                                        <button class="btn btn-primary">
                                            <span class="glyphicon glyphicon-save"></span> Download
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" style="text-align: right">
                                <a href="{{ route('user.index') }}" class="btn btn-primary">Return to Profile</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
