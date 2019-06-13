<?php


namespace App\Enum;


use MyCLabs\Enum\Enum;

class InvoiceTypeEnum extends Enum
{
    const DINING = 1;
    const SNACKS = 2;
    const TRAFFIC = 3;

    public static function getInvoiceType($type = null)
    {
        $array = [
            InvoiceTypeEnum::DINING => 'dining',
            InvoiceTypeEnum::SNACKS => 'snacks',
            InvoiceTypeEnum::TRAFFIC => 'traffic'
        ];

        if ($type){
            return $array[$type];
        }else{
            return $array;
        }
    }

}