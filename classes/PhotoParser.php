<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 012 12.03.19
 * Time: 10:45
 */

namespace classes;

use classes;

class PhotoParser
{
    private $billId;

    public function __construct(classes\Fine $fine)
    {
        $this->billId = $fine->billId;
    }


    function getPhotoIds()
    {
        return json_decode($this->photoRequest(), true)['pics'];
//        return array_reduce($photosArr, function ($res, $item) {
//            $res[] = $item['r'];
//            return $res;
//        });
    }
}