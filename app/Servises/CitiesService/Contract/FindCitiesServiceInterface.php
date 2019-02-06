<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 06.02.19
 * Time: 9:14
 */

namespace App\Servises\CitiesService\Contract;


interface FindCitiesServiceInterface
{
    public function findCity(string $data);
}
