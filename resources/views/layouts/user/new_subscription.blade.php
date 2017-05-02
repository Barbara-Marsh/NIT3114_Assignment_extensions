@extends('master')

@section('title')
    Plan Details
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Choose a Plan</h1>
        </div>
    </div>
@endsection

@inject('input','Illuminate\Support\Facades\Input')

@section('content')
    <div class="row">
        <div class="sidebar">
            @include('layouts.user-sidebar')
        </div>
        <div class="col-md-8 col-md-offset-2">
            <p>Which plan would you like to subscribe to?</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update plan</div>
                <div class="panel-body">
                    <form action="{{ route('user.store_subscription') }}" method="post">
                        {{ csrf_field() }}
                        @foreach($plans as $plan)
                            <p class="text-justify">
                                <input type="radio" name="plan_id" value="{{ $plan['id'] }}"
                                       @if(old('plan_id') == $plan['id'])
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
                        <p style="text-align: right">
                            <button class="btn btn-default">Choose Plan</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
