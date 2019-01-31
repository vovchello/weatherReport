<?php

namespace App\Servises\RedisRepository;


use App\Servises\RedisRepository\Contracts\RedisRepositoryInterface;
use Illuminate\Support\Facades\Redis;

class RedisRepository implements RedisRepositoryInterface
{
    private $redis;

    /**
     * RedisRepository constructor.
     * @param $redis
     */
    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    public function getWeather($city)
    {
            return $this->getWeatherById($city['id']);
    }


    private function getWeatherById($id)
    {
        return  $this->redis->get($id) ?? null;
    }

    public function addWeather($id,$data)
    {
        $this->redis->set($id,$data);
    }



}
