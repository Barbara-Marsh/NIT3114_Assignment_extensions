@extends('master')

@section('title')
    Change Plan Details
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Change Plan Details</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update plan</div>
                <div class="panel-body">
                    @foreach($plans as $plan)
                        <div class="col-md-4">
                            <h2>{{ $plan['name'] }}</h2>
                            <p><strong>Features:</strong> {{ $plan['features'] }}</p>
                            <p><strong>Price:</strong> $@php echo number_format($plan['price']/100,2) @endphp</p>
                            <form action="{{ route('user.update_subscription') }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="stripe_id" value="{{ $plan['stripe_id'] }}">
                                <input type="hidden" name="name" value="{{ $plan['name'] }}">
                                @if($plan['name'] != $current_plan_name)
                                    <input type="hidden" value="{{ $plan['stripe_id'] }}">
                                    <button class="btn btn-default">Update Subscription</button>
                                @endif
                            </form>
                            <p class="smaller">&ast;Includes GST</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
