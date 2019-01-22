<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 22.01.19
 * Time: 11:25
 */

namespace App\Servises\CitiesService\Contract;


interface CitiesServiceInterface
{
    public function findCity(string $data):array;
}
