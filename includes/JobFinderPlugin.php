<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 002 02.02.17
 * Time: 21:43
 */

namespace includes;

use includes\common\JobFinderLoader;
use includes\common\JobFinderDefaultOption;
use includes\models\admin\menu\JobFinderDataBaseModel;
use includes\custom_post_type\MusicianPerformerPostType;


class JobFinderPlugin
{
    private static $instance = null;
    private function __construct() {

        JobFinderLoader::getInstance();
        add_action('plugins_loaded', array(&$this, 'setDefaultOptions'));
        // Создаем Custom Post Type Musician Performer
                new MusicianPerformerPostType();

    }
    public static function getInstance() {

        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Если не созданные настройки установить по умолчанию
     */
    public function setDefaultOptions(){
        if( ! get_option(JOBFINDER_PlUGIN_OPTION_NAME) ){
            update_option( JOBFINDER_PlUGIN_OPTION_NAME, JobFinderDefaultOption::getDefaultOptions());
        }
        if( ! get_option(JOBFINDER_PlUGIN_OPTION_VERSION) ){
            update_option(JOBFINDER_PlUGIN_OPTION_VERSION, JOBFINDER_PlUGIN_VERSION);
        }
    }

    static public function activation()
     {
         // debug.log
         error_log('plugin '.JOBFINDER_PlUGIN_NAME.' activation');
         JobFinderDataBaseModel::createTable();
     }

    static public function deactivation()
     {
         // debug.log
         error_log('plugin '.JOBFINDER_PlUGIN_NAME.' deactivation');
         delete_option(JOBFINDER_PlUGIN_OPTION_NAME);
         delete_option(JOBFINDER_PlUGIN_OPTION_VERSION);

     }
}
JobFinderPlugin::getInstance();
