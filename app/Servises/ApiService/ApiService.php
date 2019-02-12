<?php

namespace App\Servises\ApiService;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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


    public function getRequest($id, $url)
    {
        try {
            $request = $this->client->request('get', $url, [
                'query' => [
                    'id' => $id,
                    'units' => 'metric',
                    'appid' => config('weatherReport.weatherservice.appid')
                ]
            ]);
        } catch (GuzzleException $e) {
            dd('lol');
        }
        return $request->getBody()->getContents();
    }

}
