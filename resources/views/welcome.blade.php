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
        <div class="col-md-8 col-md-offset-2">
            @foreach($plans as $plan)
                <h3>{{ $plan['name'] }}</h3>
                <p class="text-justified">{{ $plan['features'] }}</p>
                @if($plan['name'] == 'Open')
                    <p>Price: Free</p>
                @else
                    <p>Price: ${{ $plan['price'] }}</p>
                @endif
            @endforeach
        </div>
    </div>
@endsection
