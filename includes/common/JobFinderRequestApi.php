<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 014 14.02.17
 * Time: 19:20
 */

namespace includes\common;


class JobFinderRequestApi
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}