@extends('master')

@section('title')
    Change Newsletter Details
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
    <div class="col-md-2 sidebar">
        @include('layouts.user-sidebar')
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Update newsletter subscription details</div>
            <div class="panel-body">
                <p>Please check the options for emails you would like to receive.</p>
                <form action="{{ Route('user.update_newsletter', ['id' => $user['id']]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <ul>
                        <li>Newsletter Subscription
                            <input type="checkbox" name="subscribed_to_newsletter"
                                @if ($user['subscribed_to_newsletter'] == true)
                                    checked="checked"
                                @endif
                            >
                        </li>
                        <li>Third Party Offers
                            <input type="checkbox" name="third_party_offers"
                                @if ($user['third_party_offers'] == true)
                                    checked="checked"
                                @endif
                            >
                        </li>
                    </ul>
                    <p style="text-align: right">
                        <a href="{{ Route('user.index') }}" class="btn btn-primary">Cancel</a>
                        <button class="btn btn-primary">Update Subscriptions</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
