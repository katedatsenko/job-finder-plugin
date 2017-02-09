<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 009 09.02.17
 * Time: 16:21
 */

namespace includes\controllers\admin\menu;


class JobFinderMyPagesMenuController extends JobFinderBaseAdminMenuController
{
    public function action()
    {
        // TODO: Implement action() method.

        $pluginPage = add_pages_page(
            __('Sub pages Job Finder', JOBFINDER_PlUGIN_TEXTDOMAIN),
            __('Sub pages Job Finder', JOBFINDER_PlUGIN_TEXTDOMAIN),
            'read',
            'job_finder_control_sub_pages_menu',
            array(&$this, 'render')
        );

    }

    public function render()
    {
        // TODO: Implement render() method.
        _e("Hello this page Pages", JOBFINDER_PlUGIN_TEXTDOMAIN);
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }

}