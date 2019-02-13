<?php

namespace App\Servises\ApiService;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


class ApiService implements ApiServiceInterface
 {
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

     /**
      * @param string $uri
      * @param array $params
      * @return mixed|string
      * @throws \GuzzleHttp\Exception\GuzzleException
      */
     public function getRequest(string $uri, array $params)
     {
         try{
             $request = $this->client->request('get',$uri,$params);
             return $request->getBody()->getContents();
         } catch(ClientException $e){
             $e->getMessage();
         }
     }
}
