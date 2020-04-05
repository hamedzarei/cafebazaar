<?php

/**
 * Created by PhpStorm.
 * User: zrhm7232
 * Date: 11/10/19
 * Time: 2:59 PM
 */
class Queue
{
    protected static $queue;

    public static function addToQueue($object)
    {
        if (is_array($object)) {
            self::addArrayToQueue($object);
            return;
        }
        self::$queue[] = $object;
    }

    public static function addArrayToQueue($arr)
    {
        foreach ($arr as $item) {
            self::addToQueue($item);
        }
    }

    public static function selectFromQueue()
    {
        $object = array_shift(self::$queue);

        return $object;
    }

    public static function printQueue()
    {
        print_r(self::$queue);
    }
}