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
        <div class=" col col-md-9 col-md-offset-3">
            <h2>Your settings</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <p><strong>Email: </strong>{{ $user['email'] }}</p>
        </div>
    </div>
    <div class="row row-bottom-margin">
        <div class="col-md-4 col-md-offset-3">
            <p><strong>Current Plan: </strong>{{ $user['plan']['name'] }}</p>
            <p><strong>Plan Features: </strong>{{ $user['plan']['features'] }}</p>
            <p>${{ $user['plan']['price'] }}</p>
            <p><strong>Status: </strong>{{ $user['subscription']['status'] }}</p>
            <p><strong>Plan is current until: </strong>{{ date('d-m-Y', strtotime($user['subscription']['ends_at'])) }}</p>
        </div>
        <div class="col-md-3">
            <a href="{{ Route('user.edit_plan') }}" class="btn btn-default btn-margin-top">Change Plan</a>
        </div>
    </div>
    <div class="row row-bottom-margin">
        <div class="col-md-4 col-md-offset-3">
            <p><strong>Email Settings: </strong></p>
            <ul>
                <li>Newsletter Subscription
                    <input type="checkbox"
                       @if ($user['newsletter'] == true)
                       checked="checked"
                       @endif
                       disabled="disabled">
                </li>
                <li>Third Party Offers
                    <input type="checkbox"
                       @if ($user['offers'] == true)
                       checked="checked"
                       @endif
                       disabled="disabled">
                </li>
            </ul>
        </div>
        <div class="col-md-3">
            <a href="{{ Route('user.edit_subscription') }}" class="btn btn-default btn-margin-top">Change Email Settings</a>
        </div>
    </div>
    @if ($user['plan']['name'] !== 'Open')
    <div class="row">
        <div class="col-md-4 col-md-offset-3">
            <p><strong>Billing Details: </strong></p>
            <p>Name on card: {{ $user['billing']['card_name'] }}</p>
            <p>Card No.: {{ $user['billing']['card_number'] }}</p>
            <p>Expiry: {{ date('d-m-Y', strtotime($user['billing']['expiry'])) }}</p>
            <p>CSV: {{ $user['billing']['csv'] }}</p>
        </div>
        <div class="col-md-3">
            <a href="{{ Route('user.edit_billing') }}" class="btn btn-default btn-margin-top">Change Billing Details</a>
        </div>
    </div>
    @endif
@endsection
