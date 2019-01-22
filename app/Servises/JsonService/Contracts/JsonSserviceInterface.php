<?php

namespace App\Servises\JsonService\Contracts;

use Illuminate\Support\Collection;

interface JsonSserviceInterface
{
    public function getFile($path):Collection;
}
