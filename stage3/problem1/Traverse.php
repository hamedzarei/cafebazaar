<?php

/**
 * Created by PhpStorm.
 * User: zrhm7232
 * Date: 11/10/19
 * Time: 2:41 PM
 */
include_once 'HelperFunctions.php';
class Traverse
{
    public $roads;

    public function __construct($roads)
    {
        $this->roads = $roads;
    }

    public function traverse()
    {
        $helper = new HelperFunctions();
        foreach ($this->roads as $index => $road) {
            $indexes = $helper->searchBySource($this->roads, $road['destination']);
            $this->addConn($index, $indexes);
        }

        return $this->roads;
    }

    protected function addConn($index, $conn)
    {
        $this->roads[$index]['conn'] = $conn;
    }
}