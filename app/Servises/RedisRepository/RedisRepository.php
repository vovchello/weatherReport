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
    public function getWeather($city)
    {
        return $this->getWeatherById($city['id']);
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
    public function addWeather($id, $data)
    {
        $this->redis->set($id,$data);
    }



}
