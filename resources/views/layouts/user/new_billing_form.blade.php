@extends('master')

@section('title')
    Add Billing Details
@endsection

@section('content-header')
<div class="row content-header">
    <div class="col-md-12">
        <h1>Add Billing Details</h1>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="sidebar">
        @include('layouts.user-sidebar')
    </div>
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Update details</div>
            <div class="panel-body">
                <div class="col-md-6 col-md-offset-3">
                    <form class="form-horizontal" action="{{ route('user.store_billing') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="card_name" class="control-label">Name on card: </label>
                            <input type="text" class="form-control" name="card_name" value="{{ old('card_name') }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="card_number" class="control-label">Card number: </label>
                            <input type="text" class="form-control" name="card_number" value="{{ old('card_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="expiry" class="control-label">Expiry date: </label>
                            <input type="text" class="form-control" name="expiry" value="{{ old('expiry') }}">
                        </div>
                        <div class="form-group">
                            <label for="csv" class="control-label">CSV: </label>
                            <input type="text" class="form-control" name="csv" value="{{ old('csv') }}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default">Add Billing Method</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
