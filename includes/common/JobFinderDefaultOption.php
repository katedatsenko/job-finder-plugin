<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 017 17.02.17
 * Time: 0:34
 */

namespace includes\common;


class JobFinderDefaultOption
{
    /**
     * Возвращает массив дефолтных настроек
     * @return array
     */
    public static function getDefaultOptions()
    {
        $defaults = array(
            'vacancies' => array(
                'city' => '',
                'keyWords' => '',
                'noSalary' => '',
                'salary' => ''
            )
        );
        // Фильтр которому можно подключиться и изменить массив дефолтных настроек
        $defaults = apply_filters('job_finder_default_option', $defaults );
        return $defaults;
    }

}