<?php

namespace App\Servises\FindCitiesService;

use App\Servises\FindCitiesService\Contract\CitiesServiceInterface;
use App\Servises\FindCitiesService\Contract\FindCitiesServiceInterface;
use App\Servises\JsonService\Contracts\JsonSserviceInterface;

/**
 * Class FindCitiesService
 * @package App\Servises\FindCitiesService
 */
class FindCitiesService
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
     * FindCitiesService constructor.
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
    public function getDecodeFile()
    {
        return $this->jsonService->getFile($this->file['path']);
    }

    public function saveFileToTheBase()
    {
        $file = $this->getDecodeFile();

    }




}
