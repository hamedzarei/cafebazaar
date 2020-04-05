<?php

/**
 * Created by PhpStorm.
 * User: zrhm7232
 * Date: 11/10/19
 * Time: 5:10 PM
 */
class Car
{
    private $enter_price = 400000;
    private $cost_per_unit = 6000;
    private $unit = 1;
    private $car_count = 0;
    private $car_capacity = 4;
//    under this age is infant
    private $age_limit = 2;

    private $passengers;

    public function __construct($passengers)
    {
        $this->passengers = $passengers;
    }

    public function getCats()
    {
        $infant_count = 0;
        $adult_count = 0;
        foreach ($this->passengers as $passenger) {
            if ($passenger > $this->age_limit) {
                $adult_count++;
            } else {
                $infant_count++;
            }
        }

        return [
            'infant' => $infant_count,
            'adult' => $adult_count
        ];
    }

    public function getCarCount()
    {
        $passenger_count = 0;

        foreach ($this->passengers as $passenger) {
            if ($passenger > $this->age_limit) $passenger_count++;
        }

        $this->car_count = ceil($passenger_count/$this->car_capacity);

        return $this->car_count;
    }

    public function getPriceRoads($roads)
    {
        $roads_price = [];

        foreach ($roads as $road) {
            $first_part = $this->enter_price;
            $second_part = ($road['length'] - 50) * $this->cost_per_unit;
            $roads_price[] = ($first_part + $second_part)*$this->car_count;
        }

        return $roads_price;
    }

    public function getTotalPrice($roads_price)
    {
        $total_price = 0;

        foreach ($roads_price as $road_price) {
            $total_price += $road_price;
        }

        return $total_price;
    }
}