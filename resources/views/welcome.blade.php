@extends('master')

@section('title')
    Welcome
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Welcome to Australian Weather Services</h1>
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
            <div class="well well-lg">
                <h3 class="content-header">{{ $plan['name'] }}</h3>
                <p class="text-justify">{{ $plan['features'] }}</p>
                @if($plan['name'] == 'Open')
                    <p>Price: Free</p>
                @else
                    <p>Price: $@php echo number_format($plan['price']/100,2) @endphp</p>
                @endif
                <a href="{{ url('/register') }}" class="btn btn-default">Sign up</a>
            </div>
        </div>
        @endforeach
        @if(Auth::check())
            <script>
                // jQuery function to prevent logged-in users from subscribing to another plan.
                // Redirects to profile page if user clicks on one of the Sign Up buttons.
                $('.btn').click(function ( event ) {
                    event.preventDefault();
                });
            </script>
        @endif
    </div>
@endsection
