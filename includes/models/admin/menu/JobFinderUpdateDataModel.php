<?php


namespace includes\models\admin\menu;

use includes\common\JobFinderRequestApi;
use includes\controllers\admin\menu\JobFinderICreatorInstance;
use includes\models\admin\menu\JobFinderDataBaseModel;


class JobFinderUpdateDataModel implements JobFinderICreatorInstance
{
    public function __construct() {
        add_action( 'wp_loaded', array( $this, 'updateData' ) );
    }

	public function updateData ($city, $keywords, $nosalary, $salary)
	{
		$cacheKey = "";
        $array = array();
        error_log( print_r(array('city'=>$city, 'keywords'=>$keywords, 'nosalary'=>$nosalary, 'salary'=>$salary,), TRUE) );

        //Создает ключ для кэша
        $cacheKey = $this->getCacheKey($city, $keywords, $nosalary, $salary);
        if ( false === ($array = get_transient($cacheKey))) {

            $requestAPI = JobFinderRequestApi::getInstance();
            $cityid = $requestAPI->getCity($city);

            $array = $requestAPI->getVacancies( $cityid, $keywords, $nosalary, $salary);
            if (false !== $array) {
                JobFinderDataBaseModel::deleteAll();
                foreach ($array as $key) {
                    $id = JobFinderDataBaseModel::insert($key);
                }
            }
            set_transient($cacheKey, $array, 100);
            error_log( print_r($array, TRUE) );
            return $array;
        }
        else {
            error_log( print_r($array, TRUE) );
            return $array;
        }
	}
    public function getCacheKey($city, $keywords, $nosalary, $salary){
        return JOBFINDER_PlUGIN_TEXTDOMAIN
        ."_vacancies_city_{$city}_keywords_{$keywords}_nosalary_{$nosalary}_salary_{$salary}";
    }


	public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }
}
