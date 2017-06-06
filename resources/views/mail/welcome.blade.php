@extends('mail.mail-master')

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Welcome</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <p>Dear {{ $user['name'] }},</p>
            <p>Thank you for registering with us.</p>
            <p>You can view your invoices at any time by going to <a href="{{ route('user.index') }}">your profile.</a></p>
        </div>
    </div>
@endsection
