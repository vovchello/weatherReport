<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 08.01.19
 * Time: 14:41
 */

namespace App\Servises\WeatherService\Contacts;


/**
 * Interface WeatherServiceInterface
 * @package App\Servises\WeatherService\Contacts
 */
interface WeatherServiceInterface
{
    /**
     * @param $city
     * @return mixed
     */
    public function getCurrentWeather($city);

    /**
     * @param $city
     * @return mixed
     */
    public function getWeatherForecast($city);
}
