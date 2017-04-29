@extends('master')

@section('title')
    Profile
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>User Profile</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="sidebar">
            @include('layouts.user-sidebar')
        </div>
        <div class=" col col-md-9 col-md-offset-3">
            <h2>Current settings</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <p><strong>Name: </strong>{{ $user['name'] }}</p>
            <p><strong>Email: </strong>{{ $user['email'] }}</p>
        </div>
    </div>
    <div class="row row-bottom-margin">
        <div class="col-md-4 col-md-offset-3">
            <p><strong>Current Plan: </strong></p>
        </div>
        <div class="col-md-3">
            <a href="" class="btn btn-default btn-margin-top">Change Plan</a>
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
            <a href="" class="btn btn-default btn-margin-top">Change Newsletter Subscription</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-3">
            <p><strong>Billing Details: </strong></p>
            <p></p>
        </div>
        <div class="col-md-3">
            <a href="" class="btn btn-default btn-margin-top">Change Billing Details</a>
        </div>
    </div>
@endsection
