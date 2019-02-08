<?php

namespace App\Servises\DataBaseService;


use App\Servises\DataBaseService\Contracts\DataBaseServiceInterface;
use Illuminate\Support\Facades\Redis;

/**
 * Class DataBaseService
 * @package App\Servises\DataBaseService
 */
class DataBaseService implements DataBaseServiceInterface
{
    /**
     * @var \Illuminate\Redis\Connections\Connection
     */
    private $redis;

    /**
     * DataBaseService constructor.
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
    public function getWeatherForecast($id)
    {
        return $this->getWeatherByIdFromBase($id);
    }

    /**
     * @param $id
     * @return mixed|null
     */
    private function getWeatherByIdFromBase($id)
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
