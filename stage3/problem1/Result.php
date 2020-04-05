<?php

/**
 * Created by PhpStorm.
 * User: zrhm7232
 * Date: 11/10/19
 * Time: 5:19 PM
 */
include_once 'HelperFunctions.php';

class Result
{
    private $helper;
    private $roads, $path, $departure_time, $car_prices, $total_car, $cats, $total_price;
    public function __construct($roads, $path, $departure_time, $total_car, $car_prices, $cats, $total_price)
    {
        $this->helper = new HelperFunctions();
        $this->roads = $roads;
        $this->path = $path;
        $this->departure_time = $departure_time;
        $this->car_prices = $car_prices;
        $this->total_car = $total_car;
        $this->cats = $cats;
        $this->total_price = $total_price;
    }

    public function printResult()
    {
        echo "result for you query is:\n**************************************************\n";

        $total_duration = 0;
        $total_price = number_format($this->total_price/10);

        foreach ($this->path as $index => $node) {
            $time_in_min = ($this->roads[$node]['length']/$this->roads[$node]['speed_limit'])*60;
            $price = number_format($this->car_prices[$node]/10);
            $total_duration += $time_in_min;
            $end_time = $this->helper->addToTime($this->departure_time, $time_in_min);
            echo "type: Road\nreference: {$this->roads[$node]['road_name']}\nroute: {$this->roads[$node]['source']}({$this->departure_time})".
                "--> {$this->roads[$node]['destination']}({$end_time})\n"
                ."duration: {$time_in_min} minutes\n"
                ."price: infants({$this->cats['infant']}) adults({$this->cats['adult']})\n\t{$this->total_car}"
                ." car(s) required\n\ttotal:  {$price}\n";
            $this->departure_time = $end_time;
            if (array_key_exists($index+1, $this->path))
                echo "**************************************************\n";
        }
        echo "\n************************\nTotal duration: {$total_duration} minutes\n"
        ."Total price: {$total_price}\n";

    }
}