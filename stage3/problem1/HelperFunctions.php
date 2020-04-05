<?php

/**
 * Created by PhpStorm.
 * User: zrhm7232
 * Date: 11/10/19
 * Time: 2:43 PM
 */
class HelperFunctions
{
    public function searchBySource($roads, $name)
    {
        $indexes = [];
        foreach ($roads as $index => $road) {
            if ($road['source'] == $name) {
                $indexes[] = $index;
            }
        }

        return $indexes;
    }

    public function searchByDestinationHasTrace($roads, $name)
    {
        $result = null;

        foreach ($roads as $index => $road) {
            if ($road['destination'] == $name && array_key_exists('trace', $road)) {
                $result = $index;
            }
        }

        return $result;
    }

    public function addToTime($time, $addInMin)
    {
        $parts = explode(':', $time);
        $hours = $parts[0];
        $mins = $parts[1];
        $hours += floor(($mins+$addInMin)/60);
        $mins = ($mins+$addInMin)%60;
//        var_dump($time, $hours, floor($addInMin/60));
        if ($hours < 10) $hours = "0$hours";
//        var_dump("{$hours}:{$mins}");
        return "{$hours}:{$mins}";

    }
}