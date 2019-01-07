<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 07.01.19
 * Time: 11:55
 */

namespace App\Models\WeatherReport;


use Illuminate\Database\Eloquent\Model;

/**
 * Class WeatherReport
 * @package App\Models\WeatherReport
 */
class WeatherReport extends Model
{
    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * @param mixed $country_code
     */
    public function setCountryCode($country_code): void
    {
        $this->country_code = $country_code;
    }
    /**
     * @var string
     */
    protected $table = 'weather_report';
    /**
     * @var array
     */
    protected $guarded = ['id'];
    /**
     * @var
     */
    private $city;
    /**
     * @var
     */
    private $country_code;
    /**
     * @var
     */
    private $temperature;
    /**
     * @var
     */
    private $max_temperature;
    /**
     * @var
     */
    private $min_temperature;
    /**
     * @var
     */
    private $weather;
    /**
     * @var
     */
    private $clouds;
    /**
     * @var
     */
    private $wind_speed;
    /**
     * @var
     */
    private $precipitation_type;
    /**
     * @var
     */
    private $precipitation_size;
    /**
     * @var
     */
    private $data;

    /**
     * @return mixed
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param mixed $temperature
     */
    public function setTemperature($temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return mixed
     */
    public function getMaxtemperature()
    {
        return $this->max_temperature;
    }

    /**
     * @param mixed $max_temperature
     */
    public function setMaxtemperature($max_temperature): void
    {
        $this->max_temperature = $max_temperature;
    }

    /**
     * @return mixed
     */
    public function getMinTemperature()
    {
        return $this->min_temperature;
    }

    /**
     * @param mixed $min_temperature
     */
    public function setMinTemperature($min_temperature): void
    {
        $this->min_temperature = $min_temperature;
    }

    /**
     * @return mixed
     */
    public function getWeather()
    {
        return $this->weather;
    }

    /**
     * @param mixed $weather
     */
    public function setWeather($weather): void
    {
        $this->weather = $weather;
    }

    /**
     * @return mixed
     */
    public function getClouds()
    {
        return $this->clouds;
    }

    /**
     * @param mixed $clouds
     */
    public function setClouds($clouds): void
    {
        $this->clouds = $clouds;
    }

    /**
     * @return mixed
     */
    public function getWindSpeed()
    {
        return $this->wind_speed;
    }

    /**
     * @param mixed $wind_speed
     */
    public function setWindSpeed($wind_speed): void
    {
        $this->wind_speed = $wind_speed;
    }

    /**
     * @return mixed
     */
    public function getPrecipitationType()
    {
        return $this->precipitation_type;
    }

    /**
     * @param mixed $precipitation_type
     */
    public function setPrecipitationType($precipitation_type): void
    {
        $this->precipitation_type = $precipitation_type;
    }

    /**
     * @return mixed
     */
    public function getPrecipitationSize()
    {
        return $this->precipitation_size;
    }

    /**
     * @param mixed $precipitation_size
     */
    public function setPrecipitationSize($precipitation_size): void
    {
        $this->precipitation_size = $precipitation_size;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }


}
