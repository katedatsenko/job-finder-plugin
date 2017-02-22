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
    const JOBFINDER_API_CITY = "https://api.rabota.ua/autocomplete/city";

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

    /*public function getToken(){
        return "&token=".self::JOBFINDER_TOKEN;
    }*/


    public function getVacancies ($cityid, $keyWords, $noSalary, $salary ){
        $requestURL = "";
        if ($keyWords == false || empty($keyWords)){
            return false;
        }
        /*if (empty($noSalary)){
            $noSalary = false;
        }*/
        if (empty($salary)){
            $salary = 0;
        }

        $url = self::JOBFINDER_API;

        // параметры запроса
                $body = array(
                    'cityid' => $cityid,
                    'keyWords' => $keyWords,
                    'noSalary' => $noSalary,
                    'salary' => $salary,
                );

        // настройки запроса
        $args = array(
            'body' => $body,
            'timeout' => '20',
        );

        $response = wp_remote_post( $url, $args );
        $json = wp_remote_retrieve_body($response);

        return json_decode($json, true);

    }

    public function getCity ($city) {
        $requestURL = "";
        if ($city == false || empty($city)){
            return false;
        }

        $response = wp_remote_get( self::JOBFINDER_API_CITY."?term={$city}");

        $body = wp_remote_retrieve_body($response);

        $json = json_decode($body, true);
        if (!is_wp_error($json)) {
            return $json[0]['id'];
        } else {
            return false;
        }
    }


}