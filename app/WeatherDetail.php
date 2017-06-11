<?php
/**
 * Created by PhpStorm.
 * User: Barbara
 * Date: 24/05/2017
 * Time: 3:20 PM
 */

namespace App;

use Carbon\Carbon;

class WeatherDetail
{
    /*public  $forCity;
    public $temperature;
    public $pressure;
    public $humidity;
    public $sunrise;*/
    public $time_zone = 'Australia/Melbourne';

    const ABSOLUTE_ZERO = 273.15;

    public function setTemperature($temperature)
    {
        $temperature = $temperature - self::ABSOLUTE_ZERO;
        $temperature = round($temperature, 1);
        return $temperature;
    }

    public function setSunrise($time)
    {
        $sunrise = Carbon::createFromTimestamp($time, $this->time_zone)->format('h:i a');
        return $sunrise;
    }

    public function setSunset($time)
    {
        $sunset = Carbon::createFromTimestamp($time, $this->time_zone)->format('h:i a');
        return $sunset;
    }

    public function setForecastDate($time)
    {
        $forecastDate = Carbon::createFromTimestamp($time, $this->time_zone)->format('d-m-Y');
        return $forecastDate;
    }

    public function setForecastTime($time)
    {
        $forecastTime = Carbon::createFromTimestamp($time, $this->time_zone)->format('h:i a');
        return $forecastTime;
    }
}