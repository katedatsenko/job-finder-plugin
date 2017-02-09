<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 009 09.02.17
 * Time: 14:52
 */

namespace includes\controllers\admin\menu;


class JobFinderMyDashboardMenuController extends JobFinderBaseAdminMenuController
{
    public function action()
    {
        // TODO: Implement action() method.

        $pluginPage = add_dashboard_page(
            JOBFINDER_PlUGIN_TEXTDOMAIN,
            _x(
                'Sub dashboard Job Finder',
                'admin menu page' ,
                JOBFINDER_PlUGIN_TEXTDOMAIN
            ),
            _x(
                'Sub dashboard Job Finder',
                'admin menu page' ,
                JOBFINDER_PlUGIN_TEXTDOMAIN
            ),
            'manage_options',
            'job_finder_control_sub_dashboard_menu',
            array(&$this, 'render'));
    }

    public function render()
    {
        // TODO: Implement render() method.
        _e("Hello this page dashboards", JOBFINDER_PlUGIN_TEXTDOMAIN);
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }

}