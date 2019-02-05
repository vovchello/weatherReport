<?php

namespace App\Servises\RedisRepository;


use App\Servises\RedisRepository\Contracts\RedisRepositoryInterface;
use Illuminate\Support\Facades\Redis;

/**
 * Class RedisRepository
 * @package App\Servises\RedisRepository
 */
class RedisRepository implements RedisRepositoryInterface
{
    /**
     * @var \Illuminate\Redis\Connections\Connection
     */
    private $redis;

    /**
     * RedisRepository constructor.
     * @param $redis
     */
    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    /**
     * @param $city
     * @return mixed|null
     */
    public function getWeatherForecast($city)
    {
        return $this->getWeatherById($city['id']);
    }

    public function getCurrentWeather($city)
    {
        return $this->getWeatherById('c'.$city['id']);
    }


    /**
     * @param $id
     * @return mixed|null
     */
    private function getWeatherById($id)
    {
        return json_decode($this->redis->get($id),true) ?? null;
    }

    /**
     * @param $id
     * @param $data
     */
    public function save($id, $data)
    {
        $this->redis->set($id,$data);
    }



}
