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

{{--@inject('input','Illuminate\Support\Facades\Input')--}}

@section('content')
<div class="row">
    <div class="sidebar">
        @include('layouts.user-sidebar')
    </div>
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Update newsletter subscription details</div>
            <div class="panel-body">
                <p>Please check the options for emails you would like to receive.</p>
                <form action="{{ Route('user.update_newsletter', ['id' => $user_settings['id']]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <ul>
                        <li>Newsletter Subscription
                            <input type="checkbox" name="subscribed_to_newsletter"
                                @if ($user_settings['subscribed_to_newsletter'] == true)
                                    checked="checked"
                                @endif
                            >
                        </li>
                        <li>Third Party Offers
                            <input type="checkbox" name="third_party_offers"
                                @if ($user_settings['third_party_offers'] == true)
                                    checked="checked"
                                @endif
                            >
                        </li>
                    </ul>
                    <p style="text-align: right">
                        <button class="btn btn-default">Update Subscriptions</button>
                        <a href="{{ Route('user.index') }}" class="btn btn-default">Cancel</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
