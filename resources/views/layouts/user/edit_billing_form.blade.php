@extends('master')

@section('title')
    Change Billing Details
@endsection

@section('content-header')
<div class="row content-header">
    <div class="col-md-12">
        <h1>Change Billing Details</h1>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="sidebar">
        @include('layouts.user-sidebar')
    </div>
    <div class="col-md-6 col-md-offset-3">
        <form action="" method="">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $billing_details['user_id'] }}">
            <table id="card-details-table">
                <tr>
                    <td><label for="card_name">Name on card: </label></td>
                    <td><input type="text" name="card_name" value="{{ $billing_details['card_name'] or old('card_name') }}"></td>
                </tr>
                <tr>
                    <td><label for="card_number">Card number: </label></td>
                    <td><input type="text" name="card_number" value="{{ $billing_details['card_number'] or old('card_name') }}"></td>
                </tr>
                <tr>
                    <td><label for="expiry">Expiry date: </label></td>
                    <td><input type="text" name="expiry" value="{{ $billing_details['expiry'] or old('expiry') }}"></td>
                </tr>
                <tr>
                    <td><label for="csv">CSV: </label></td>
                    <td><input type="text" name="csv" value="{{ $billing_details['csv'] or old('csv') }}"></td>
                    <td><a href="" class="btn btn-default">Change Billing Method</a></td>
                    <td><a href="{{ Route('user.index') }}" class="btn btn-default">Cancel</a></td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection
