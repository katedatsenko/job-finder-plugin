<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 009 09.02.17
 * Time: 14:12
 */

namespace includes\controllers\admin\menu;
use includes\common\JobFinderRequestApi;


class JobFinderMainAdminSubMenuController extends JobFinderBaseAdminMenuController
{
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
        // TODO: Implement render() method.
        _e("Hello world sub menu", JOBFINDER_PlUGIN_TEXTDOMAIN);

        $requestAPI = JobFinderRequestApi::getInstance();
        var_dump($requestAPI->getVacancies( 17, 'developer', 0, 0));
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }

}