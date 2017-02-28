<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 009 09.02.17
 * Time: 14:12
 */

namespace includes\controllers\admin\menu;
use includes\common\JobFinderRequestApi;
use includes\models\admin\menu\JobFinderMainAdminMenuModel;

class JobFinderMainAdminSubMenuController extends JobFinderBaseAdminMenuController
{
    public $model;
    public function __construct(){
        parent::__construct();
        $this->model = JobFinderMainAdminMenuModel::newInstance();
        // подключаем AJAX обработчики, только когда в этом есть смысл
        if( defined('DOING_AJAX') && DOING_AJAX ){
            add_action('wp_ajax_vacancies', array( &$this, 'ajaxHandler'));
        }
    }
    /**
     * Обработчик для ajax действия guest_book (wp_ajax_guest_book, wp_ajax_nopriv_guest_book)
     */
    public function ajaxHandler(){
    }
    public function action()
    {
        // TODO: Implement action() method.
        $pluginPage = add_submenu_page(
        JOBFINDER_PlUGIN_TEXTDOMAIN,
        _x(
            'Sub Job Finder',
            'admin menu page' ,
            JOBFINDER_PlUGIN_TEXTDOMAIN
        ),
        _x(
            'Sub Job Finder',
            'admin menu page' ,
            JOBFINDER_PlUGIN_TEXTDOMAIN
        ),
        'manage_options',
        'job_finder_control_sub_menu',
        array(&$this, 'render'));
    }

    public function render()
    {
        $pathView = JOBFINDER_PlUGIN_DIR."/includes/views/admin/menu/JobFinderAjax.view.php";
        $this->loadView($pathView);
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }

}