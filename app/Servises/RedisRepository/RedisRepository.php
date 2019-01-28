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

    public function getWeather($cities)
    {
        foreach($cities as $city) {
            $weather = $this->getWeatherByCity($city['country'],$city['name']);

        }
        return $weather;
    }

    /**
     * @param $country
     * @param $city
     * @return \Illuminate\Support\Collection|null
     */
    private function getWeatherByCity($country, $city)
    {
        $data = json_decode($this->redis->get('weather'));
        $result = collect();
        foreach($data as $item) {
            if ($item->city->name === $city)
            {
                $result->push($item);
            }
        }
        if ($result->count() > 0){
            return $result;
        }
        return null;
    }

    public function addWeather($data)
    {
        $weather = json_decode($this->redis->get('weather'));
        $array = collect($weather);
        foreach($data as $item){
            $array->push($item);

        }
        $this->redis->set('weather',$array);
    }



}
