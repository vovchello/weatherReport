<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 07.01.19
 * Time: 12:25
 */

namespace App\Repositories\WetherReportRepository;


use App\Models\WeatherReport\WeatherReport;
use App\Repositories\WetherReportRepository\Contact\WeatherReportRepositoryInterface;

class WeatherReportRepository implements WeatherReportRepositoryInterface
{
    private $weatherReport;

    public function __construct(WeatherReport $weatherReport)
    {
        $this->weatherReport = $weatherReport;
    }

    public function getAll()
    {
        return $this->weatherReport->getAttributes();
    }

    public function save($data): void
    {
        $this->weatherReport->setTemperature($data['temperature'];
        $this->weatherReport->setMaxtemperature($data['max_temperature']);
        $this->weatherReport->setMinTemperature($data['min_temperature']);
        $this->weatherReport->setWeather($data['weather']);
        $this->weatherReport->setWindSpeed($data['wind_speed']);
        $this->weatherReport->setClouds($data['clouds']);
        $this->weatherReport->setPrecipitationType($data['precipitation_type']);
        $this->weatherReport->setPrecipitationSize($data['precipitation_size']);
        $this->weatherReport->setData($data['data']);
        $this->weatherReport->save();
    }

}
