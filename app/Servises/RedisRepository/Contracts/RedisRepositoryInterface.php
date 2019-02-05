<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 26.01.19
 * Time: 14:14
 */

namespace App\Servises\RedisRepository\Contracts;


interface RedisRepositoryInterface
{
    public function getWeatherForecast($city);

    public function getCurrentWeather($city);

    public function save($id, $data);

}
