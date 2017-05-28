<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeatherController extends Controller
{
    private function buildApiUrl($url_base, $parameters = null)
    {
        if (strpos($url_base, '?') !== FALSE) {
            $url_base .= '&';
        } else {
            $url_base .= '?';
        }

        $api_key = config('services.weather_api.key');
        $api_id = config('services.weather_api.id');

        $parameters[$api_id] = $api_key;

        return $url_base . http_build_query($parameters);
    }

    public function getCityWeather($cityId)
    {
        $api_location_url = config('services.weather_api.weather_url_base');
        $url = $this->buildApiUrl($api_location_url, ['id' => $cityId]);
        $results = json_decode(file_get_contents($url), TRUE);

        return $results;
    }

    public function getCityForecast($cityId)
    {
        $api_location_url = config('services.weather_api.forecast_url_base');
        $url = $this->buildApiUrl($api_location_url, ['id' => $cityId]);
        $results = json_decode(file_get_contents($url), TRUE);

        return $results;
    }

    public function index()
    {
        $user = Auth::user();
        $weather = $this->getCityWeather('2158177');
        $forecast = $this->getCityForecast('2158177');

        var_dump($weather);
        var_dump($forecast);

        return view('layouts.user.weather')->with(['weather' => $weather, 'forecast' => $forecast]);
    }
}
