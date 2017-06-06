@extends('mail.mail-master')

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Subscription Canceled</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <p>Dear {{ $user['name'] }},</p>
            <p>Thank you for using our service. We're sorry to see you go.</p>
            <p>If you change your mind about cancelling your service, you can re-subscribe by visiting  <a href="{{ route('user.index') }}">your profile</a> and choosing the "Renew" button</p>
        </div>
    </div>
@endsection
