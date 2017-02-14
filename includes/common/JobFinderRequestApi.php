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
    const JOBFINDER_API = "https://api.rabota.ua/vacancy/search";
    const JOBFINDER_TOKEN = "b2f8bef81735323aecb33e285da8e694";
    const JOBFINDER_MARKER = "17942";

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