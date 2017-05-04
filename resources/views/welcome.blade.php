@extends('master')

@section('title')
    Welcome
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Welcome</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col" style="text-align: center">
            <h2>Our Plans</h2>
        </div>
    </div>
    <div class="row">
            @foreach($plans as $plan)
            <div class="col-md-4">
                <h3>{{ $plan['name'] }}</h3>
                <p class="text-justify">{{ $plan['features'] }}</p>
                @if($plan['name'] == 'Open')
                    <p>Price: Free</p>
                @else
                    <p>Price: ${{ $plan['price'] }}</p>
                @endif
                <a href="{{ url("/register?plan_id=".$plan['id']) }}" class="btn btn-default">Sign up</a>
            </div>
            @endforeach
    </div>
@endsection
