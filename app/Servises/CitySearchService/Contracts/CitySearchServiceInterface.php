<?php

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
