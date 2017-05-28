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
    public  $forCity;
    public $temperature;
    public $pressure;
    public $humidity;
    public $sunrise;
    public $time_zone = 'Australia/Melbourne';

    const ABSOLUTE_ZERO = 273.15;

    public function setTemperature($temperature)
    {
        //$this->temperature = $temperature - self::ABSOLUTE_ZERO;
        $temperature = $temperature - self::ABSOLUTE_ZERO;

        //return $this;
        return $temperature;
    }

    public function setSunrise($time)
    {
        $sunrise = Carbon::createFromTimestamp($time, $this->time_zone)->format('h:i A');
        return $sunrise;
    }

    public function setSunset($time)
    {
        $sunset = Carbon::createFromTimestamp($time, $this->time_zone)->format('h:i A');
        return $sunset;
    }
}