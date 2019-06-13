<?php


namespace App\Enum;


use MyCLabs\Enum\Enum;

class HasInvoiceEnum extends Enum
{
    const YES = 1;
    const NO = 2;

    public static function getHasInvoiceEnum($status)
    {
        $array = [
            HasInvoiceEnum::YES => 'yes',
            HasInvoiceEnum::NO => 'no'
        ];

        if ($status){
            return $array[$status];
        }else{
            return $array;
        }
    }
}