<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 009 09.02.17
 * Time: 14:12
 */

namespace includes\controllers\admin\menu;


class JobFinderMainAdminSubMenuController extends JobFinderBaseAdminMenuController
{
    public function action()
    {
        // TODO: Implement action() method.
        $plugin_page = add_submenu_page(
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
        // TODO: Implement render() method.
        _e("Hello world sub menu", JOBFINDER_PlUGIN_TEXTDOMAIN);
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }

}