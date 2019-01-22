<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 22.01.19
 * Time: 11:33
 */

namespace App\Http\Controllers;


class WeatherController
{
    private function getPath()
    {
        return config('weatherReport.files.cities.path');
    }
}
