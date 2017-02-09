<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 009 09.02.17
 * Time: 16:34
 */

namespace includes\controllers\admin\menu;


class JobFinderMyUsersMenuController extends JobFinderBaseAdminMenuController
{
    public function action()
    {
        // TODO: Implement action() method.

        $pluginPage = add_users_page(
            __('Sub users Job Finder', JOBFINDER_PlUGIN_TEXTDOMAIN),
            __('Sub users Job Finder', JOBFINDER_PlUGIN_TEXTDOMAIN),
            'read',
            'job_finder_control_sub_users_menu',
            array(&$this, 'render')
        );

    }

    public function render()
    {
        // TODO: Implement render() method.
        _e("Hello this page users", JOBFINDER_PlUGIN_TEXTDOMAIN);
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }

}