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
                        <p><strong>Price:</strong> $@php echo number_format($plan['price']/100,2) @endphp&ast;</p>
                        <form action="{{ route('user.create_subscription') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="plan_id" value="{{ $plan['id'] }}">
                            <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ config('services.stripe.key') }}"
                                data-amount="{{ $plan['price'] }}"
                                data-name="Australian Weather Services"
                                data-description="Payment for {{ $plan['name'] }} Subscription"
                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                data-locale="auto"
                                data-zip-code="true"
                                data-billing-address="false"
                                data-currency="aud"
                                data-label="Subscribe"
                                data-email="{{ $email }}"
                            >
                            </script>
                        </form>
                        <p class="smaller"><em>&ast;Includes GST</em></p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
