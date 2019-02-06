<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 06.02.19
 * Time: 9:26
 */

namespace App\Servises\WeatherServise\Contracts;


interface WeatherServiseInterface
{
    public function getWeather($cities);
}
