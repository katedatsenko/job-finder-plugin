<?php

/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 026 26.02.17
 * Time: 19:54
 */
namespace includes\ajax;
use includes\controllers\admin\menu\JobFinderICreatorInstance;
use includes\models\admin\menu\JobFinderUpdateDataModel;

class JobFinderVacanciesAjaxHandler implements JobFinderICreatorInstance
{
    public function __construct(){
        if( defined('DOING_AJAX') && DOING_AJAX ){
            add_action('wp_ajax_vacancies', array( &$this, 'ajaxHandler'));
        }
    }
    /**
     * Обработчик для ajax действия vacancies (wp_ajax_vacancies)
     */
    public function ajaxHandler(){
        error_log('ajaxHandler');
        // Проверка наличия данных
        if ($_POST){
            //Добавляем данные
            $model = JobFinderUpdateDataModel::newInstance();
            $return = $model ->updateData ($_POST['city'], $_POST['keywords'],$_POST['nosalary'],$_POST['salary']);
            // Возвращаем ответ
            wp_send_json_success( $return );
        }
        wp_send_json_error();
        wp_die();
    }
    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }
}