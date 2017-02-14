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

    public function getToken(){
        return "&token=".self::JOBFINDER_TOKEN;
    }


    public function getVacancies ($cityId, $keyWords, $salary, $period){
        $requestURL = "";
        if ($cityId == false || empty($cityId)){
            $cityId = 0;
        }
        if ($keyWords == false || empty($keyWords)){
            return false;
        }
        if ($salary == false || empty($salary)){
            $salary = false;
        }
        if ($period == false || empty($period)){
            $period = 0;
        }


        $url = self::JOBFINDER_API;

        // параметры запроса
                $body = array(
                    'cityId' => $cityId,
                    'keyWords' => $keyWords,
                    'salary' => $salary,
                    'period' => $period,
                );

        // настройки запроса
        $args = array(
            'body' => $body,
            'timeout' => '5',
        );

        $response = wp_remote_post( $url, $args );
        $json = wp_remote_retrieve_body($response);

        return $json;

    }


}