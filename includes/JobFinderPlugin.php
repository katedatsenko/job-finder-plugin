<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 002 02.02.17
 * Time: 21:43
 */

namespace includes;

use includes\common\JobFinderLoader;
use includes\example\JobFinderExampleFilter;
use includes\example\JobFinderExampleAction;

class JobFinderPlugin
{
    private static $instance = null;
    private function __construct() {
        JobFinderLoader::getInstance();

        //$jobFinderExampleFilter = JobFinderExampleFilter::newInstance();
        //$jobFinderExampleFilter->callMyFilter("Kate");
        //$jobFinderExampleAction = JobFinderExampleAction::newInstance();
        //$jobFinderExampleAction->callMyAction();


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