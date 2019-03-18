<?php

namespace classes;

class Fine
{
    public $id;
    public $koapSt;
    public $koapText;
    public $fineDate;
    public $sum;
    public $billId;
    public $hasDiscount;
    public $hasPhoto;
    public $divId;
    public $discountSum;
    public $discountUntil;
    public $car_id;
    public $parseDate;

    public function __construct($koapSt = null, $koapText = null, $fineDate = null, $sum = null, $billId = null, $hasDiscount = null, $hasPhoto = null, $divId = null, $discountSum = null, $discountUntil = null, $parseDate = null, $car_id = null, $id = null)
    {
        $this->id = $id;
        $this->koapSt = $koapSt;
        $this->koapText = $koapText;
        $this->fineDate = $fineDate;
        $this->sum = $sum;
        $this->billId = $billId;
        $this->hasDiscount = $hasDiscount;
        $this->hasPhoto = $hasPhoto;
        $this->divId = $divId;
        $this->discountSum = $discountSum;
        $this->discountUntil = $discountUntil;
        $this->car_id = $car_id;
        $this->parseDate = $parseDate;
    }

    public function toString()
    {
        return "Статья: {$this->koapSt} Нарушение: {$this->koapText} Дата штрафа: {$this->fineDate} Сумма без скидки: {$this->koapSt} № постановления: {$this->billId}";
    }

    public function isNew()
    {
        return (strtotime($this->parseDate) >= time() - 86400) ? 1 : 0;
    }

    public function hasPhoto(): bool
    {
        return ($this->hasPhoto == 1) ? true : false;
    }
}