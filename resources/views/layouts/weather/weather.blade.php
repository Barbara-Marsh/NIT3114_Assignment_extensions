@extends('master')

@section('title')
    Weather
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Current Weather in Australian Capital Cities</h1>
        </div>
    </div>
@endsection

@inject('weatherDetail', 'App\WeatherDetail')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                @foreach($weather_data as $weather)
                    <div class="col-md-3">
                        <div class="well well-lg well-margin-bottom">
                            <div class="text-center">
                                <h2>{{ $weather['name'] ?? "" }}</h2>
                                <hr>
                                <h3>{{ $weather['weather'][0]['main'] ?? "" }}</h3>
                                <img src="https://openweathermap.org/img/w/{{ $weather['weather'][0]['icon'] }}.png">
                                <p>{{ $weather['weather'][0]['description'] ?? "" }}</p>
                                <h3>@php echo $weatherDetail->setTemperature($weather['main']['temp']) ?? ""; @endphp&deg; </h3>
                            </div>
                            <hr>
                            <div>
                                <p>
                                    <strong>Pressure: </strong>{{ $weather['main']['pressure'] ?? "" }} hPa<br>
                                    <strong>Humidity: </strong>{{ $weather['main']['humidity'] ?? "" }}%<br>
                                    <strong>Cloudiness: </strong>{{ $weather['clouds']['all'] ?? "" }}%<br>
                                    <strong>Wind Speed: </strong>{{ $weather['wind']['speed'] ?? "" }} m/sec
                                </p>
                            </div>
                            <hr>
                            <div>
                                <p>
                                    <strong>Sunrise: </strong>@php echo $weatherDetail->setSunrise($weather['sys']['sunrise'] ?? ""); @endphp<br>
                                    <strong>Sunset: </strong>@php echo $weatherDetail->setSunset($weather['sys']['sunset'] ?? ""); @endphp
                                </p>
                            </div>
                            @if(isset(Auth::user()->subscription->name) && Auth::user()->subscription->name == 'Pro')
                                <br>
                                <div class="text-center">
                                    <form action="{{ Route('weather.forecast') }}" method="get">
                                        <input type="hidden" name="city_id" value="{{ $weather['id'] }}">
                                        <button class="btn btn-primary">5 Day Forecast</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection