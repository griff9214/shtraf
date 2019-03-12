<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 012 12.03.19
 * Time: 10:43
 */

namespace classes;


class Car
{
    public $id;
    public $number;
    public $region;
    public $stsNumber;

    public function __construct($id, $number, $region, $stsNumber)
    {
        $this->id = trim($id);
        $this->number = trim($number);
        $this->region = trim($region);
        $this->stsNumber = trim($stsNumber);

    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getStsNumber()
    {
        return $this->stsNumber;
    }
}
