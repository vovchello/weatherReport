<?php

namespace App\Servises\CashService;

use App\Servises\CashService\Contracts\CashServiceInterface;
use Illuminate\Support\Facades\Redis;

/**
 * Class CashService
 * @package App\Servises\CashService
 */
class CashService implements CashServiceInterface
{
    /**
     * @var \Illuminate\Redis\Connections\Connection
     */
    private $redis;

    /**
     * CashService constructor.
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
