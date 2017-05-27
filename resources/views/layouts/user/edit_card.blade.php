@extends('master')

@section('title')
    Change Card Details
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Change Card Details</h1>
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
                <div class="panel-heading">Update payment details</div>
                <div class="panel-body">
                    <form action="{{ Route('user.update_card') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="{{ config('services.stripe.key') }}"
                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                            data-name="Australian Weather Services"
                            data-panel-label="Update Card Details"
                            data-label="Update Card Details"
                            data-allow-remember-me=false
                            data-locale="auto"
                            data-zip-code="true"
                            data-email="<?php echo $email; ?>"
                        >
                        </script>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2 sidebar">
            @include('layouts.user-right-sidebar')
        </div>
    </div>
@endsection
