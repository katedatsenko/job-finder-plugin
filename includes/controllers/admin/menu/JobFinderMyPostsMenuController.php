<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 009 09.02.17
 * Time: 16:10
 */

namespace includes\controllers\admin\menu;


class JobFinderMyPostsMenuController extends JobFinderBaseAdminMenuController
{
    public function action()
    {
        // TODO: Implement action() method.

        $pluginPage = add_posts_page(
            __('Sub posts Job Finder', JOBFINDER_PlUGIN_TEXTDOMAIN),
            __('Sub posts Job Finder', JOBFINDER_PlUGIN_TEXTDOMAIN),
            'read',
            'job_finder_control_sub_posts_menu',
            array(&$this, 'render')
        );

    }

    public function render()
    {
        // TODO: Implement render() method.
        $out = "<div >";
        $out .= "<h5>This is a guest post by <a href='#'>Hello</a></h5>";
        $out .= "<div >Hello world</div></div>";
        _e($out, JOBFINDER_PlUGIN_TEXTDOMAIN);
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }

}