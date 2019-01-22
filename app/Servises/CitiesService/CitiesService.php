<?php

namespace App\Servises\CitiesService;

use App\Servises\CitiesService\Contract\CitiesServiceInterface;
use App\Servises\JsonService\Contracts\JsonSserviceInterface;

/**
 * Class CitiesService
 * @package App\Servises\CitiesService
 */
class CitiesService implements CitiesServiceInterface
{

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    private $file;

    /**
     * @var JsonSserviceInterface
     */
    private $jsonService;

    /**
     * CitiesService constructor.
     * @param $file
     */
    public function __construct(JsonSserviceInterface $jsonService)
    {
        $this->file = config('weatherReport.files.cities');
        $this->jsonService = $jsonService;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getCities()
    {
        return $this->jsonService->getFile($this->file['path']);
    }

    /**
     * @param string $data
     * @return \Illuminate\Support\Collection
     */
    public function findCity(string $data)
    {
        $cities = $this->getCities();
        return $cities->where('name', $data);
    }



}
