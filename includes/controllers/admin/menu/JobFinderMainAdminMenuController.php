<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 009 09.02.17
 * Time: 13:40
 */

namespace includes\controllers\admin\menu;

use includes\models\admin\menu\JobFinderMainAdminMenuModel;
use includes\common\JobFinderRequestApi;



class JobFinderMainAdminMenuController extends JobFinderBaseAdminMenuController
{
    public $model;
    public function __construct(){
        parent::__construct();
        $this->model = JobFinderMainAdminMenuModel::newInstance();
    }

    public function action()
    {
        // TODO: Implement action() method.
        /**
         * add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
         *
         */
        $pluginPage = add_menu_page(
        _x(
            'Job Finder',
            'admin menu page' ,
            JOBFINDER_PlUGIN_TEXTDOMAIN
        ),
        _x(
            'Job Finder',
            'admin menu page' ,
            JOBFINDER_PlUGIN_TEXTDOMAIN
        ),
        'manage_options',
        JOBFINDER_PlUGIN_TEXTDOMAIN,
        array(&$this,'render'),
        JOBFINDER_PlUGIN_URL .'assets/images/main-menu.png'
        );
    }

     /**
      * Метод отвечающий за контент страницы
      */
    public function render()
    {
        // TODO: Implement render() method.
        if (isset($_POST)){
            $requestAPI = JobFinderRequestApi::getInstance();

        }
        $option = get_option(JOBFINDER_PlUGIN_OPTION_NAME);
        $requestAPI = JobFinderRequestApi::getInstance();
        $cityid = '';
        if (isset($option['vacancies']['city'])) {
            $cityid = $requestAPI->getCity($option['vacancies']['city']);
        }
        $array = $requestAPI->getVacancies( $cityid, $option['vacancies'] ['keyWords'], $option['vacancies'] ['noSalary'],
            $option['vacancies'] ['salary']);
        echo '<pre>';
        var_dump($array);
        echo '</pre>';



        $pathView = JOBFINDER_PlUGIN_DIR."/includes/views/admin/menu/JobFinderMainAdminMenu.view.php";
        $this->loadView($pathView);

    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }

}