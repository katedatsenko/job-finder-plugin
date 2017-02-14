<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 009 09.02.17
 * Time: 13:40
 */

namespace includes\controllers\admin\menu;




class JobFinderMainAdminMenuController extends JobFinderBaseAdminMenuController
{
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
        require_once JOBFINDER_PlUGIN_DIR . '/includes/controllers/admin/views/main-admin.php';


    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }

}