<?php

/**
 * Created by PhpStorm.
 * User: zrhm7232
 * Date: 11/10/19
 * Time: 2:52 PM
 */

include_once 'HelperFunctions.php';
include_once 'Queue.php';

class BFS
{
    private $roads;
    private $start;
    private $end;
    private $helper;

    public function __construct($roads, $start, $end)
    {
        $this->helper = new HelperFunctions();
        $this->roads = $roads;
        $this->start = $start;
        $this->end = $end;
    }

    public function run()
    {
        $source_indexes = $this->helper->searchBySource($this->roads, $this->start);
        Queue::addToQueue($source_indexes);
//        Queue::printQueue();
        $temp = null;
        $index = true;
        while ($index != null) {
            $index = Queue::selectFromQueue();
            Queue::addToQueue($this->roads[$index]['conn']);
//            Queue::printQueue();
            $this->addTrace($index, $temp);
            $temp = $index;
            if ($this->roads[$index]['source'] == $this->end) break;
        }

        return $this->roads;
    }

    protected function addTrace($index, $trace)
    {
        if ($trace == null) return;
        $this->roads[$index]['trace'][] = $trace;
    }

    public function findPath()
    {
        $path = [];
        $index = $this->helper->searchByDestinationHasTrace($this->roads, $this->end);

        while (true) {
            array_unshift($path, $index);
            if ($this->roads[$index]['source'] == $this->start) break;
            $index = $this->roads[$index]['trace'][0];
        }

        return $path;

    }
}