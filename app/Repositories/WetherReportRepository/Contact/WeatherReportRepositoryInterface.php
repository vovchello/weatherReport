<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 07.01.19
 * Time: 12:20
 */

namespace App\Repositories\WetherReportRepository\Contact;


/**
 * Interface WeatherReportRepositoryInterface
 * @package App\Repositories\WetherReportRepository\Contact
 */
interface WeatherReportRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $data
     */
    public function save($data):void;
}
