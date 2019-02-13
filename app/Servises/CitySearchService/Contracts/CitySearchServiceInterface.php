<?php

namespace App\Servises\CitySearchService\Contracts;

/**
 * Interface CitySearchServiceInterface
 */
interface CitySearchServiceInterface
{
    /**
     * @param $cityName
     * @return mixed
     */
    public function search(string $cityName);
}
