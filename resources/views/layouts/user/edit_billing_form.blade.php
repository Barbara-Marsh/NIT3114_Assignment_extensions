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
    <div class="col-md-2 sidebar">
        @include('layouts.user-sidebar')
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Update details</div>
            <div class="panel-body">
                <div class="col-md-6 col-md-offset-3">
                    <form class="form-horizontal" action="{{ route('user.update_billing', ['id' => $user['id']]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{ $user['id'] }}">

                        <div class="form-group{{ $errors->has('card_name') ? ' has-error' : '' }}">
                            <label for="card_name" class="control-label">Name on card: </label>
                            <input type="text" class="form-control" name="card_name" value="{{ $user['card_name'] or old('card_name') }}" autofocus>
                            @if ($errors->has('card_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('card_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                            <label for="card_number" class="control-label">Card number: </label>
                            <input type="text" class="form-control" name="card_number" value="{{ $user['card_number'] or old('card_name') }}">
                            @if ($errors->has('card_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('card_number') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('expiry') ? ' has-error' : '' }}">
                            <label for="expiry" class="control-label">Expiry date: </label>
                            <input type="text" class="form-control" name="expiry" value="{{ $user['expiry'] or old('expiry') }}">
                            @if ($errors->has('expiry'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('expiry') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('csv') ? ' has-error' : '' }}">
                            <label for="csv" class="control-label">CSV: </label>
                            <input type="text" class="form-control" name="csv" value="{{ $user['csv'] or old('csv') }}">
                            @if ($errors->has('csv'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('csv') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-default">Change Billing Method</button>
                            <a href="{{ Route('user.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 sidebar">
        @include('layouts.user-right-sidebar')
    </div>
</div>
@endsection
