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
                            <p><strong>Current Subscription: </strong></p>
                            @if(!empty($subscriptions[0]))
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $subscription->name }}</td>
                                        <td>
                                            @if ($subscription->cancelled())
                                                Cancelled - expiry date: {{ Carbon\Carbon::parse($subscription->ends_at)->format('d-m-Y') }}
                                            @else
                                                Active
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$subscription->cancelled())
                                                <span class="pull-right">
                                                    <form action="{{ route('user.cancel_subscription') }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                                                        <button type="submit" class="btn  btn-danger btn-sm">
                                                            <span class="glyphicon glyphicon-trash"></span> Delete
                                                        </button>
                                                    </form>
                                                </span>
                                                <span class="pull-right">
                                                    <form action="{{ route('user.edit_subscription') }}" method="get">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                                                        <button type="submit" class="btn  btn-success btn-sm btn-margin-right">
                                                            <span class="glyphicon glyphicon-trash"></span> Change
                                                        </button>
                                                    </form>
                                                </span>
                                            @elseif ($subscription->cancelled())
                                                <span class="pull-right">
                                                    <form action="{{ route('user.resume_subscription') }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                                                        <button type="submit" class="btn  btn-success btn-sm">
                                                            <span class="glyphicon glyphicon-thumbs-up"></span> Reset
                                                        </button>
                                                    </form>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                You have no subscriptions.
                                <span class="pull-right">
                                    <a href="{{ route('user.show_subscription') }}" class="btn btn-default">
                                        <span class="glyphicon glyphicon-new-window"></span> New Subscription
                                    </a>
                                </span>
                            @endif

                        </div>
                    </div>
                    <hr>
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
                </div>
            </div>
        </div>
        <div class="col-md-2 sidebar">
            @include('layouts.user-right-sidebar')
        </div>
    </div>
@endsection
