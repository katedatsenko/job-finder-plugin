<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 002 02.02.17
 * Time: 21:43
 */

namespace includes;

class JobFinderPlugin
{
    private static $instance = null;
    private function __construct() {
    }
    public static function getInstance() {

        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    static public function activation()
     {
         // debug.log
         error_log('plugin '.JOBFINDER_PlUGIN_NAME.' activation');
     }

    static public function deactivation()
     {
         // debug.log
         error_log('plugin '.JOBFINDER_PlUGIN_NAME.' deactivation');
     }
}
JobFinderPlugin::getInstance();