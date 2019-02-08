<?php

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\DataBaseService\DataBaseService;

/**
 * Created by PhpStorm.
 * User: panda
 * Date: 09.02.19
 * Time: 0:39
 */

abstract class WeatherService
{

    /**
     * @var apiServiceInterface
     */
    protected $apiService;

    /**
     * @var DataBaseService
     */
    protected $redisRepository;

    /**
     * @var
     */
    protected $message;

    /**
     *
     */
    private const CONFIG_FILE_PATH = 'weatherReport.weatherservice';

    /**
     * WeatherService constructor.
     * @param ApiServiceInterface $apiService
     * @param DataBaseService $redisRepository
     */
    public function __construct(ApiServiceInterface $apiService, DataBaseService $redisRepository)
    {
        $this->apiService = $apiService;
        $this->redisRepository = $redisRepository;
        $this->config = config(self::CONFIG_FILE_PATH);
    }


    /**
     * @param $id
     * @param $weather
     */
    protected function saveWeather($id, $weather)
    {
        $this->redisRepository->save($id,$weather);
    }
}
