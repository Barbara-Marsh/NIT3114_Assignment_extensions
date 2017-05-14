@extends('master')

@section('title')
    Create Subscription Details
@endsection

@section('content-header')
<div class="row content-header">
    <div class="col-md-12">
        <h1>Choose Subscription Details</h1>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Choose newsletter subscription details</div>
            <div class="panel-body">
                <p>Please check the options for emails you would like to receive.</p>
                <form action="{{ Route('user.store_newsletter') }}" method="post">
                    {{ csrf_field() }}
                    <ul>
                        <li>Newsletter Subscription
                            <input type="checkbox" name="subscribed_to_newsletter"
                                @if (old('subscribed_to_newsletter') == true)
                                    checked="checked"
                                @endif
                            >
                        </li>
                        <li>Third Party Offers
                            <input type="checkbox" name="third_party_offers"
                                @if (old('third_party_offers') == true)
                                    checked="checked"
                                @endif
                            >
                        </li>
                    </ul>
                    <p style="text-align: right">
                        <button class="btn btn-default">Update Subscriptions</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
