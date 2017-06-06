@extends('mail.mail-master')

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Plan Updated</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <p>Dear {{ $user['name'] }},</p>
            <p>Your plan has been successfully updated.</p>
        </div>
    </div>
@endsection
