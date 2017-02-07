<?php
/**
 * Created by PhpStorm.
 * User: wp-2-08
 * Date: 04.02.2017
 * Time: 21:15
 */

namespace includes\common;
use includes\example\JobFinderExampleAction;
use includes\example\JobFinderExampleFilter;


class JobFinderLoader
{
    private static $instance = null;

    private function __construct(){
        // is_admin() Условный тег. Срабатывает когда показывается админ панель сайта (консоль или любая
        // другая страница админки).
        // Проверяем в админке мы или нет
        if ( is_admin() ) {
            // Когда в админке вызываем метод admin()
            $this->admin();
        } else {
            // Когда на сайте вызываем метод site()
            $this->site();
        }
        $this->all();


    }

    public static function getInstance(){
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Метод будет срабатывать когда вы находитесь в Админ панеле. Загрузка классов для Админ панели
     */
    public function admin(){
        add_action('plugins_loaded', function(){ error_log(__('Hello', JOBFINDER_PlUGIN_TEXTDOMAIN)); }, 1000);
    }

    /**
     * Метод будет срабатывать когда вы находитесь Сайте. Загрузка классов для Сайта
     */
    public function site(){

    }

    /**
     * Метод будет срабатывать везде. Загрузка классов для Админ панеле и Сайта
     */
    public function all(){
        //Вызов класса includes\common\JobFinderLocalization в загрузчике классов
        JobFinderLocalization::getInstance();
        $jobFinderExampleAction = JobFinderExampleAction::newInstance();
        /*$jobFinderExampleFilter = JobFinderExampleFilter::newInstance();
        $jobFinderExampleFilter->callMyFilter("Kate");
        $jobFinderExampleFilter->callMyFilterAdditionalParameter("Kate", "Wordpress", "Softgroup");
        $jobFinderExampleAction = JobFinderExampleAction::newInstance();
        $jobFinderExampleAction->callMyAction();
        $jobFinderExampleAction->callMyActionAdditionalParameter('1', '2', '3');*/
    }
}