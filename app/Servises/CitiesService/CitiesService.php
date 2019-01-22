<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 22.01.19
 * Time: 11:24
 */

namespace App\Servises\CitiesService;


use App\Servises\CitiesService\Contract\CitiesServiceInterface;

class CitiesService implements CitiesServiceInterface
{

    public function findCity(string $data): array
    {

    }



    $cities = $this->jsonSservice->getFile($path);
    dd($cities->where('name','Hurzuf'));
}
