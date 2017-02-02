<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 002 02.02.17
 * Time: 23:36
 */
namespace includes\common;
class JobFinderAutoload
 {
    private static $instance = null;
    private function __construct() {
        spl_autoload_register(array($this, 'autoloadNamespace'));
    }

    public static function getInstance(){
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

     /**
      * @param $className
      */
    public function autoloadNamespace($className){
        $fileClass = JOBFINDER_PlUGIN_DIR.'/'.str_replace("\\","/",$className).'.php';
        if (file_exists($fileClass)) {
            if (!class_exists($fileClass, FALSE)) {
                require_once $fileClass;
            }
         }
     }
 }
JobFinderAutoload::getInstance();