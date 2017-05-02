@extends('master')

@section('title')
    Change Subscription Details
@endsection

@section('content-header')
<div class="row content-header">
    <div class="col-md-12">
        <h1>Change Subscription Details</h1>
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
            <div class="panel-heading">Update subscription details</div>
            <div class="panel-body">
                <p>Please check the options for emails you would like to receive.</p>
                <form action="" method="">
                    {{ csrf_field() }}
                    <ul>
                        <li>Newsletter Subscription
                            <input type="checkbox"
                                @if ($user_settings['subscribed_to_newsletter'] == true)
                                    checked="checked"
                                @endif
                            >
                        </li>
                        <li>Third Party Offers
                            <input type="checkbox"
                                @if ($user_settings['third_party_offers'] == true)
                                    checked="checked"
                                @endif
                            >
                        </li>
                    </ul>
                    <p style="text-align: right">
                        <a href="" class="btn btn-default">Update Subscriptions</a>
                        <a href="{{ Route('user.index') }}" class="btn btn-default">Cancel</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
