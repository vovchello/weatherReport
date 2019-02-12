<?php

namespace App\Servises\ApiService;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use GuzzleHttp\Client;


 class ApiService implements ApiServiceInterface
 {
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

     public function getRequest(string $uri, array $params)
     {
         $request = $this->client->request('get',$uri,$params);
         return $request->getBody()->getContents();
     }
}
