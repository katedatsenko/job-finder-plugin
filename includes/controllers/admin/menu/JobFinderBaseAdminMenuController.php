<?php

/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 009 09.02.17
 * Time: 13:31
 */

namespace includes\controllers\admin\menu;

abstract class JobFinderBaseAdminMenuController implements JobFinderICreatorInstance
{
    public function __construct(){
        /*
        * Регистрирует хук-событие. При регистрации указывается PHP функция,
        * которая сработает в момент события, которое вызывается с помощью do_action().
        */
        add_action('admin_menu', array( &$this, 'action'));
    }

    abstract public function action();
    abstract public function render();
}