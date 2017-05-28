@extends('master')

@section('title')
    Weather
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Current Weather in Capital Cities</h1>
        </div>
    </div>
@endsection

@inject('weatherDetail', 'App\WeatherDetail')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="well well-lg well-margin-bottom">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection