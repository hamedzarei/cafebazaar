<?php
/**
 * Created by PhpStorm.
 * User: zrhm7232
 * Date: 11/10/19
 * Time: 2:25 PM
 */
include_once 'Traverse.php';
include_once 'BFS.php';
include_once 'Car.php';
include_once 'Result.php';

if ($argc != 5) {
    echo "number of args are wrong\n";
    return;
}
// init project
$input = [
    "source" => $argv[1],
    "destination" => $argv[2],
    "departure_time" => $argv[3],
    "passengers" => explode(',', $argv[4])
];


$car = new Car($input['passengers']);
$total_car = $car->getCarCount();

$graph = file_get_contents('roads.json');
$graph = json_decode($graph, true);

// traverse graph
$roads = $graph['road_details'];
$traverse = new Traverse($roads);
$roads = $traverse->traverse();

// find
$bfs = new BFS($roads, $input['source'], $input['destination']);
$roads = $bfs->run();
$path = $bfs->findPath();
// print

$roads_prices = $car->getPriceRoads($roads);
$total_price = $car->getTotalPrice($roads_prices);
$cats = $car->getCats();
//var_dump($car_prices);
$result = new Result($roads, $path, $input['departure_time'], $total_car, $roads_prices, $cats, $total_price);
$result->printResult();