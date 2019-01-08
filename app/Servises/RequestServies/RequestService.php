<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 08.01.19
 * Time: 13:30
 */

namespace App\Servises\RequestServies;


use App\Servises\RequestServies\Contacts\ReqestServiseInterface;
use GuzzleHttp\Client;

class RequestService implements ReqestServiseInterface
{
    private $client;

    /**
     * RequestService constructor.
     * @param $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function getRequiest()
    {
        dd($this->getAppId());
    }

    private function getURI():string
    {
        return config('weatherReport.weatherservice.uri');
    }

    private function getAppId():string
    {
        return config('weatherReport.weatherservice.appid');
    }

}
