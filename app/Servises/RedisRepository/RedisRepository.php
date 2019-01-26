<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 26.01.19
 * Time: 11:57
 */

namespace App\Servises\RedisRepository;


use Illuminate\Support\Facades\Redis;
//use Predis\Client;

class RedisRepository
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


}
