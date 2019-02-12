<?php

namespace App\Servises\CashService\Contracts;

/**
 * Interface CashServiceInterface
 * @package App\Servises\DataBaseService\Contracts
 */
interface CashServiceInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getDataById($id);

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function save($id, $data);

}
