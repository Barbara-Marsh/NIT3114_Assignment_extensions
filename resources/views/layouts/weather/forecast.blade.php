@extends('master')

@section('title')
    Weather Forecast
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>5 Day Forecast for {{ $name }}</h1>
            <h2>(in 3 hourly intervals)</h2>
        </div>
    </div>
@endsection

@inject('weatherDetail', 'App\WeatherDetail')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="jcarousel-wrapper">
                <div class="jcarousel">
                    <ul>
                        @foreach($lists as $list)
                        <li>
                            <div class="well well-lg well-margin-bottom well-reduce-padding">
                                <div class="text-center">
                                    <p><strong>@php echo $weatherDetail->setForecastDate($list['dt']); @endphp</strong></p>
                                    <p><strong>@php echo $weatherDetail->setForecastTime($list['dt']); @endphp</strong></p>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <p><strong>{{ $list['weather'][0]['main'] }}</strong></p>
                                    <img src="https://openweathermap.org/img/w/{{ $list['weather'][0]['icon'] }}.png">
                                    <p>{{ $list['weather'][0]['description'] }}</p>
                                    <p><strong>@php echo $weatherDetail->setTemperature($list['main']['temp']); @endphp&deg;</strong></p>
                                </div>
                                <hr>
                                <div class="sm-text">
                                    <p>
                                        <strong>Pressure: </strong>{{ $list['main']['pressure'] }} hPa<br>
                                        <strong>Humidity: </strong>{{ $list['main']['humidity'] }}%<br>
                                        <strong>Cloudiness: </strong>{{ $list['clouds']['all'] }}%<br>
                                        <strong>Wind Speed: </strong>{{ $list['wind']['speed'] }} m/sec<br>
                                    @if(isset($list['rain']['3h']))
                                        <strong>Rain: </strong>{{ round($list['rain']['3h'], 2) }} mm
                                    @else
                                        <strong>Rain: </strong>0 mm
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                <a href="#" class="jcarousel-control-next">&rsaquo;</a>
            </div>
        </div>
    </div>
@endsection