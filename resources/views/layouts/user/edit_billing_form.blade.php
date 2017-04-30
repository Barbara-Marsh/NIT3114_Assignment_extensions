@extends('master')

@section('title')
    Change Billing Details
@endsection

@section('content-header')
<div class="row content-header">
    <div class="col-md-12">
        <h1>Change Billing Details</h1>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form action="" method="">
            {{ csrf_field() }}

            <p style="text-align: right">
                <a href="" class="btn btn-default">Change Billing Method</a>
                <a href="{{ Route('user.index') }}" class="btn btn-default">Cancel</a>
            </p>
        </form>
    </div>
</div>
@endsection
