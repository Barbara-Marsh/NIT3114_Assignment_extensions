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
        <div class="sidebar">
            @include('layouts.user-sidebar')
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: larger">Your settings</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Email: </strong>{{ $user['email'] }}</p><hr>
                            <p><strong>Current Plan: </strong>{{ $user['plan']['name'] }}</p>
                            <p class="text-justify"><strong>Plan Features: </strong>{{ $user['plan']['features'] }}</p>
                            <p>${{ $user['plan']['price'] }}</p>
                        </div>
                        <div class="col-md-8">
                            <p><strong>Status: </strong>{{ $user['subscription']['status'] }}</p>
                            <p><strong>Plan is current until: </strong>{{ date('d-m-Y', strtotime($user['subscription']['ends_at'])) }}</p>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ Route('user.edit_subscription', ['id' => $user['subscription']['id']]) }}" class="btn btn-default btn-margin-top align-right">Change Plan</a><br>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Email Settings: </strong></p>
                        </div>
                        <div class="col-md-8">
                            <ul>
                                <li>Newsletter Subscription
                                    <input type="checkbox"
                                           @if ($user['user_settings']['subscribed_to_newsletter'] == true)
                                           checked="checked"
                                           @endif
                                           disabled="disabled">
                                </li>
                                <li>Third Party Offers
                                    <input type="checkbox"
                                           @if ($user['user_settings']['third_party_offers'] == true)
                                           checked="checked"
                                           @endif
                                           disabled="disabled">
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ Route('user.edit_newsletter', ['id' => $user['user_settings']['id']]) }}" class="btn btn-default btn-margin-top align-right">Change Newsletter Settings</a>
                        </div>
                    </div><hr>
                    @if ($user['plan']['name'] !== 'Open')
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Billing Details: </strong></p>
                            <p>Name on card: {{ $user['billing']['card_name'] }}</p>
                            <p>Card No.: {{ $user['billing']['card_number'] }}</p>
                        </div>
                        <div class="col-md-8">
                            <p>Expiry: {{ date('d-m-Y', strtotime($user['billing']['expiry'])) }}</p>
                            <p>CSV: {{ $user['billing']['csv'] }}</p>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('user.edit_billing', ['id' => $user['user_settings']['id']]) }}" class="btn btn-default btn-margin-top align-right">Change Billing Details</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
