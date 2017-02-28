<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 009 09.02.17
 * Time: 13:40
 */

namespace includes\controllers\admin\menu;

use includes\models\admin\menu\JobFinderMainAdminMenuModel;
use includes\models\admin\menu\JobFinderUpdateDataModel;


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

        $pathView = JOBFINDER_PlUGIN_DIR."/includes/views/admin/menu/JobFinderMainAdminMenu.view.php";
        $this->loadView($pathView);
        echo '<div><h4>Шорткод для вставки [job_finder_vacancies]</h4></div>  ';
        echo '<h3>Предварительный просмотр</h3>';
        echo '<hr>';
        $option = get_option(JOBFINDER_PlUGIN_OPTION_NAME);
        $model = JobFinderUpdateDataModel::newInstance();
        $array = $model->updateData($option['vacancies']['city'], $option['vacancies'] ['keywords'], $option['vacancies'] ['nosalary'],
            $option['vacancies'] ['salary']);
        if ($array != false) {
            foreach ($array as $key) {
                echo '<div>';
                echo '<h4>Название вакансии: ' . $key['name']. '</h4> ';
                echo '<label>Компания: ' . $key['companyName']. '</label> <br>';
                echo '<label>Зарплата: ' . $key['salary']. ' грн. </label> <br>';
                echo '<label>Сайт компании: ' . $key['contactURL']. '</label> <br>';
                echo '<a href="https://rabota.ua/company'.$key['notebookId'].'/vacancy'.$key['id'].'">Перейти к вакансии</a><br>' ;
                echo '<hr>';
                echo '</div>';
            }
        }
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }

}