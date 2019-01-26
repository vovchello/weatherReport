<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 08.01.19
 * Time: 14:41
 */

namespace App\Servises\WeatherService\Contacts;


interface WeatherServiceInterface
{
        public function getWeather($country, $city);
}
