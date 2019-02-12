<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 08.01.19
 * Time: 14:41
 */

namespace App\Servises\ApiService\Contacts;


/**
 * Interface WeatherServiceInterface
 * @package App\Servises\ApiService\Contacts
 */
interface ApiServiceInterface
{
    /**
     * @param $city
     * @return mixed
     */
    public function getRequest($id, $url);
}
