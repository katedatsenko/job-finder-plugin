<?php

/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 015 15.02.17
 * Time: 0:41
 */
namespace includes\models\site;

use includes\common\JobFinderRequestApi;
use includes\controllers\admin\menu\JobFinderICreatorInstance;

class JobFinderMyExampleShortcodeModel implements JobFinderICreatorInstance
{
    public function __construct() {

    }

    /**
     * Получения данных от кэша если данных нет в кэше запросить от сервера и записать в кэш
     * @param $currency
     * @param $origin
     * @param $destination
     * @param string $month
     * @return array|bool
     */
    public function getData($cityId, $keyWords, $salary, $period){
        $cacheKey = "";
        $data = array();
        $cacheKey = $this->getCacheKey($keyWords, $salary, $cityId);
        if ( false === ($data = get_transient($cacheKey))) {
            //error.log
            error_log("Проверка работы кеша. Будет срабатывать когда нет данных в кеше.");
            $requestAPI = JobFinderRequestApi::getInstance();
            $data = $requestAPI->getVacancies($cityId, $keyWords, $salary, $period);
            set_transient($cacheKey, $data, 100);
        }

        return $data;
    }

    /**
     * Создает ключ для кэша
     */
    public function getCacheKey($keyWords, $salary, $cityId){
        return JOBFINDER_PlUGIN_TEXTDOMAIN
        ."_job_finder_my_example_{$keyWords}_salary_{$salary}_cityId_{$cityId}";
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }
}