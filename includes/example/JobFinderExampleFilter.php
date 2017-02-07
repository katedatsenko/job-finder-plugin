<?php

/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 007 07.02.17
 * Time: 13:50
 */
class JobFinderExampleFilter
{
    public function __construct() {
        //Прикрепляем функцию к фильтру
        add_filter('my_filter', array(&$this, 'myFiterFunction'));
    }

    public static function newInstance(){
        $instance = new self;
        return $instance;
    }

    /**
    * Функция которую вызовет фильтер
    * @param $str
    * @return string
    */
    public function myFiterFunction( $str ){
        $str = "Hello {$str}";
        return $str;
    }

    public function callMyFilter( $name ){
        $name = apply_filters('my_filter', $name);
        //Выводим результат в debug.log
        error_log($name);
    }
}