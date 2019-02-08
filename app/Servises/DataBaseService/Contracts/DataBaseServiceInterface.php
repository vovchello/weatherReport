<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 26.01.19
 * Time: 14:14
 */

namespace App\Servises\DataBaseService\Contracts;


interface DataBaseServiceInterface
{
    public function getWeatherForecast($city);

    public function save($id, $data);

}
