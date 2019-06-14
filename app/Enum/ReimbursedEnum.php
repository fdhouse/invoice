<?php


namespace App\Enum;


use MyCLabs\Enum\Enum;

class ReimbursedEnum extends Enum
{
    const YES = 1;
    const NO = 2;

    public static function getReimbursedEnum($status = null)
    {
        $array = [
            self::YES => 'yes',
            self::NO => 'no'
        ];

        if ($status){
            return $array[$status];
        }else{
            return $array;
        }
    }
}