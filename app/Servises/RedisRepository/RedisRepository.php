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

    public function getWeather(string $country, string $city)
    {
        // TODO: Implement getWeather() method.
    }

    public function isExists(string $field)
    {
        // TODO: Implement isExists() method.
    }


}
