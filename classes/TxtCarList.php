<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 012 12.03.19
 * Time: 10:46
 */

namespace classes;

class TxtCarList implements CarList
{
    private $fname;
    private $delimiter;

    public function __construct($fnname, $delimiter = ':')
    {
        $this->fname = $fnname;
        $this->delimiter = $delimiter;
    }

    public function getCars()
    {
        foreach (file($this->fname) as $carParams) {
            $cars[] = new Car(...array_map("trim", explode($this->delimiter, $carParams)));
        }
        return $cars;
    }
}