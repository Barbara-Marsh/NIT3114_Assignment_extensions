@extends('master')

@section('title')
    Profile
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>{{ $user['name'] }}'s User Profile</h1>
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
                <div class="panel-heading" style="font-size: larger">Your settings</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Email: </strong>{{ $user['email'] }}</p><hr>
                            <p><strong>Current Plan: </strong>{{ $plan['name'] }}</p>
                            <p class="text-justify"><strong>Plan Features: </strong>{{ $plan['features'] }}</p>
                            @if($plan['name'] == 'Open')
                                <p><strong>Price: </strong>Free</p>
                            @else
                                <p><strong>Price: </strong>${{ $plan['price'] }}</p>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <p><strong>Status: </strong>{{ $subscription['status'] }}</p>
                            <p><strong>Plan is current until: </strong>{{ date('d-m-Y', strtotime($subscription['ends_at'])) }}</p>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Email Settings: </strong></p>
                        </div>
                        <div class="col-md-12">
                            <ul>
                                <li>Newsletter Subscription
                                    <input type="checkbox"
                                           @if ($user['subscribed_to_newsletter'] == true)
                                           checked="checked"
                                           @endif
                                           disabled="disabled">
                                </li>
                                <li>Third Party Offers
                                    <input type="checkbox"
                                           @if ($user['third_party_offers'] == true)
                                           checked="checked"
                                           @endif
                                           disabled="disabled">
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if ($plan['name'] !== 'Open')
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Billing Details: </strong></p>
                                <p>Name on card: {{ $user['card_name'] }}</p>
                                <p>Card No.: {{ $user['card_number'] }}</p>
                            </div>
                            <div class="col-md-12">
                                <p>Expiry: {{ date('d-m-Y', strtotime($user['expiry'])) }}</p>
                                <p>CSV: {{ $user['csv'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: larger">Your invoices</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
