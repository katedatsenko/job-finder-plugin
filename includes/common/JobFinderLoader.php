<?php
/**
 * Created by PhpStorm.
 * User: wp-2-08
 * Date: 04.02.2017
 * Time: 21:15
 */

namespace includes\common;
use includes\controllers\admin\menu\JobFinderMainAdminMenuController;
use includes\controllers\admin\menu\JobFinderMainAdminSubMenuController;
use includes\controllers\admin\menu\JobFinderMyDashboardMenuController;
use includes\controllers\admin\menu\JobFinderMyMediaMenuController;
use includes\controllers\admin\menu\JobFinderMyOptionsMenuController;
use includes\controllers\admin\menu\JobFinderMyPluginsMenuController;
use includes\controllers\admin\menu\JobFinderMyPostsMenuController;
use includes\controllers\admin\menu\JobFinderMyPagesMenuController;
use includes\controllers\admin\menu\JobFinderMyCommentsMenuController;
use includes\controllers\admin\menu\JobFinderMyThemeMenuController;
use includes\controllers\admin\menu\JobFinderMyToolsMenuController;
use includes\controllers\admin\menu\JobFinderMyUsersMenuController;
use includes\controllers\site\shortcodes\JobFinderMyExampleShortcodeController;
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

        JobFinderMainAdminMenuController::newInstance();
        JobFinderMainAdminSubMenuController::newInstance();
        JobFinderMyDashboardMenuController::newInstance();
        JobFinderMyPostsMenuController::newInstance();
        JobFinderMyMediaMenuController::newInstance();
        JobFinderMyPagesMenuController::newInstance();
        JobFinderMyCommentsMenuController::newInstance();
        JobFinderMyThemeMenuController::newInstance();
        JobFinderMyPluginsMenuController::newInstance();
        JobFinderMyUsersMenuController::newInstance();
        JobFinderMyToolsMenuController::newInstance();
        JobFinderMyOptionsMenuController::newInstance();
    }

    /**
     * Метод будет срабатывать когда вы находитесь Сайте. Загрузка классов для Сайта
     */
    public function site(){
        JobFinderMyExampleShortcodeController::newInstance();
    }

    /**
     * Метод будет срабатывать везде. Загрузка классов для Админ панеле и Сайта
     */
    public function all(){
        //Вызов класса includes\common\JobFinderLocalization в загрузчике классов
        JobFinderLocalization::getInstance();
        JobFinderLoaderScript::getInstance();
        //$jobFinderExampleAction = JobFinderExampleAction::newInstance();
        /*$jobFinderExampleFilter = JobFinderExampleFilter::newInstance();
        $jobFinderExampleFilter->callMyFilter("Kate");
        $jobFinderExampleFilter->callMyFilterAdditionalParameter("Kate", "Wordpress", "Softgroup");
        $jobFinderExampleAction = JobFinderExampleAction::newInstance();
        $jobFinderExampleAction->callMyAction();
        $jobFinderExampleAction->callMyActionAdditionalParameter('1', '2', '3');*/
    }
}