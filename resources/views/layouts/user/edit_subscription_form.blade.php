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

@inject('input','Illuminate\Support\Facades\Input')

@section('content')
<div class="row">
    <div class="col-md-2 sidebar">
        @include('layouts.user-sidebar')
    </div>
    <div class="col-md-8">
        <p>Your current plan is: {{ $user['plan'] }}</p>
    </div>

    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Update plan</div>
            <div class="panel-body">
                <form action="{{ route('user.update_subscription', ['id'=> $input::get('plan_type') == 'true' ? 1 : 0]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @foreach($plans as $plan)
                        <p class="text-justify">
                            <input type="radio" name="plan_id" value="{{ $plan['id'] }}"
                                   @if($user['plan'] == $plan['name'])
                                   checked="checked"
                                    @endif
                            ><strong>{{ $plan['name'] }}</strong><br>
                            {{ $plan['features'] }}<br>
                            @if($plan['name'] == 'Open')
                                Free<br>
                            @else
                                ${{ $plan['price'] }} per month<br>
                            @endif
                        </p>
                    @endforeach
                    <p class="text-justify">
                        <input type="radio" name="plan_id" value="0"><strong>Cancel Plan</strong><br>
                        If you cancel your plan, you will still have access to the service until the end of the billing period.
                    </p>
                    <p style="text-align: right">
                        <button class="btn btn-default">Change Plan</button>
                        <a href="{{ Route('user.index') }}" class="btn btn-default">Cancel</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
