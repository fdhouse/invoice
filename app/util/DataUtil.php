<?php


namespace App\util;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class DataUtil
{

    public static function processDataCollectionPaginate($data, $transformer)
    {
        $dataFlag = $data->toArray();
        $page = [
            'total' => $dataFlag['total'],
            'last_page' => $dataFlag['last_page'],
            'current_page' => $dataFlag['current_page'],
            'page_size' => $dataFlag['per_page']
        ];
        $array = new Collection($data, $transformer);
        $fractal = new Manager();
        return $fractal->createData($array)->toArray() + ['page' => $page];
    }

    public static function processDataCollection($data, $transformer)
    {
        $array = new Collection($data, $transformer);
        $fractal = new Manager();
        return current($fractal->createData($array)->toArray());
    }
}