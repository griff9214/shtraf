<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 012 12.03.19
 * Time: 10:46
 */

namespace classes;

use classes;

class JsonResponseDecoder implements ResponseDecoder
{
    public static function checkErrors($response)
    {
        return (json_decode($response)->error) ? 1 : 0;
    }

    public static function checkState($response)
    {
        return (json_decode($response)->state) ? 1 : 0;
    }

    public static function getFines($response)
    {
        $fines = [];
        foreach (json_decode($response, true)["data"]["finesList"] as $item) {
            $fines[] = new classes\Fine(...array_values($item));
        }
        return $fines;
    }

    public static function getSecureCode($response)
    {
        return json_decode($response, true)['key'];
    }

    public static function getPhotoIds($response)
    {
        //{"pics":[{"n":1,"r":1082868573},{"n":2,"r":1912246917}],"count":2}
        return json_decode($response, true)['pics'];
    }
}