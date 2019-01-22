<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 22.01.19
 * Time: 0:11
 */

namespace App\Servises\JsonService;


use App\Servises\JsonService\Contracts\JsonSserviceInterface;
use Illuminate\Support\Collection;

/**
 * Class JsonService
 * @package App\Servises\JsonService
 */
class JsonService implements JsonSserviceInterface
{
    /**
     * @param $path
     * @return false|string
     */
    private function getFileContent($path)
    {
        return file_get_contents($path);
    }

    /**
     * @param $file
     * @return mixed
     */
    private function decode($file)
    {
        return  json_decode($file, true);
    }

    private function collectFromArray($data)
    {
        return collect($data);
    }

    /**
     * @param $path
     * @return mixed
     */
    public function getFile($path):Collection
    {
        $file = $this->getFileContent($path);
        return $this->collectFromArray($this->decode($file));
    }

}
