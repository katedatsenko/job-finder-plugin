<?php

/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 017 17.02.17
 * Time: 1:13
 */
class JobFinderMainAdminMenuModel
{
    public function __construct(){
        add_action( 'admin_init', array( &$this, 'createOption' ) );

    }

    /**
     * Регистрировать опции
     * Добавлять поля опции
     * Добавлять секции опции

     */
    public function createOption()
    {


    }

    /**
     * Сохранение опции
     * @param $input
     */
    public function saveOption($input)
    {


    }

}