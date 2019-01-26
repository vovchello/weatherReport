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
    public function getWeather(string $country,string $city);

    public function isExists(string $field);
}
