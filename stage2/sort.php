<?php
/**
 * Created by PhpStorm.
 * User: zrhm7232
 * Date: 10/7/19
 * Time: 5:05 PM
 */

$a = [
    [1, "a"],
    [1, "d"]
];

usort($a, function($a1, $a2) {
    if ($a1[0] == $a2[0]) {
//        if ($a1[1] == "a")
            return $a1[1] - $a2[1];
    }
});

var_dump($a);