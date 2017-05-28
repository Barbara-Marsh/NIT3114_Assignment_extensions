@extends('master')

@section('title')
    Weather
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Weather</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">___</div>
                <div class="panel-body">
                    <img src="https://openweathermap.org/img/w/{{ $weather['weather'][0]['icon'] }}.png">
                </div>
            </div>
        </div>
    </div>
@endsection