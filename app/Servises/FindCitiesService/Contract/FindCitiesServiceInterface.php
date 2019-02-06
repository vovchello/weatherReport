<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 06.02.19
 * Time: 9:14
 */

namespace App\Servises\FindCitiesService\Contract;


interface FindCitiesServiceInterface
{
    public function findCity(string $data);
    public function getCityById($id);
}
