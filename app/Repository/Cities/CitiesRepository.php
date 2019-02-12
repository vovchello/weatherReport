<?php

class CitiesRepository
{
    private $cities;
    private $name;
    private $city_id;
    private $country;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCityId()
    {
        return $this->city_id;
    }

    /**
     * @param mixed $city_id
     */
    public function setCityId($city_id): void
    {
        $this->city_id = $city_id;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }


    /**
     * CitiesRepository constructor.
     * @param Cities $cities
     */
    public function __construct(Cities $cities)
    {
        $this->cities = $cities;
    }
    public function save()
    {
        $this->cities->save();
    }


}
