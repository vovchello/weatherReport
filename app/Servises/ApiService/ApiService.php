<?php

namespace App\Servises\ApiService;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use phpDocumentor\Reflection\DocBlock\Tags\Param;

/**
 * Class ApiService
 * @package App\Servises\ApiService
 */
class ApiService implements ApiServiceInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ApiService constructor.
     * @param $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @param $url
     * @param $params
     * @return mixed|string
     */
    public function getRequest($url, $params)
    {
        try {
            $request = $this->client->request('get', $url, $params);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
        return $request->getBody()->getContents();
    }

}
