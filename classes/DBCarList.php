<?php

namespace classes;

use PDO;

class DBCarList implements CarList
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getCars()
    {
        $carsData = $this->query("SELECT * FROM cars")->fetchAll(PDO::FETCH_NUM);
        $cars = [];
        foreach ($carsData as $carData) {
            $cars[] = new Car(...$carData);
        }
        return $cars;
    }

    public function isUnique(Fine $fine)
    {
        $res = $this->query("SELECT * FROM fines WHERE billId = '$fine->billId' LIMIT 1");
        return ($res->rowCount() == 0) ? 0 : 1;
    }

    public function getAllFines(Car $car)
    {
        return $this->query("SELECT * FROM fines WHERE car_id = {$car->id}")->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "classes\Fine");
    }

    public function getFinesCount(Car $car)
    {
        return $this->query("SELECT COUNT(id) FROM fines WHERE car_id = {$car->id}")->fetch(PDO::FETCH_NUM)[0];
    }

    public function saveFine(Fine $fine, $carId)
    {
        $query = "INSERT INTO fines (koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id) VALUES ('{$fine->koapSt}','{$fine->koapText}', '{$fine->fineDate}', '{$fine->sum}', '{$fine->billId}', '{$fine->hasDiscount}', '{$fine->hasPhoto}', '{$fine->divId}', '{$fine->discountSum}', '{$fine->discountUntil}', '{$carId}')";
        $this->query($query);
        return $this->query("SELECT LAST_INSERT_ID() LIMIT 1")->fetch(PDO::FETCH_NUM)[0];
    }

    public function query($query)
    {
        $result = $this->db->prepare($query);
        $result->execute();
        return $result;
    }
}