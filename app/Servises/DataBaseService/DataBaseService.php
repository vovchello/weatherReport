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
     * @param $id
     * @return mixed|null
     */
    public function getDataById($id)
    {
        return $this->redis->get($id);
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
