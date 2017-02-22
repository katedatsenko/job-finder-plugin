<?php

/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 017 17.02.17
 * Time: 1:13
 */
namespace includes\models\admin\menu;

use includes\controllers\admin\menu\JobFinderICreatorInstance;

class JobFinderMainAdminMenuModel implements JobFinderICreatorInstance
{
    public function __construct(){
        add_action( 'admin_init', array( &$this, 'createOption' ) );
        error_log(1);
    }

    /**
     * Регистрировать опции
     * Добавлять поля опции
     * Добавлять секции опции

     */
    public function createOption()
    {
        error_log(2);
        // register_setting( $option_group, $option_name, $sanitize_callback );
        // Регистрирует новую опцию
        register_setting('JobFinderMainSettings', JOBFINDER_PlUGIN_OPTION_NAME, array(&$this, 'saveOption'));
        // add_settings_section( $id, $title, $callback, $page );
        // Добавление секции опций
        add_settings_section( 'job_finder_vacancies_section_id', __('Vacancies', JOBFINDER_PlUGIN_TEXTDOMAIN), '', 'job-finder-plugin' );
        // add_settings_field( $id, $title, $callback, $page, $section, $args );
        // Добавление полей опций
        add_settings_field(
            'job_finder_city_field_id',
            __('City', JOBFINDER_PlUGIN_TEXTDOMAIN),
            array(&$this, 'cityField'),
            'job-finder-plugin',
            'job_finder_vacancies_section_id'
        );
        add_settings_field(
            'job_finder_keyWords_field_id',
            __('KeyWords', JOBFINDER_PlUGIN_TEXTDOMAIN),
            array(&$this, 'keyWordsField'),
            'job-finder-plugin',
            'job_finder_vacancies_section_id'
        );
        add_settings_field(
            'job_finder_noSalary_field_id',
            __('NoSalary', JOBFINDER_PlUGIN_TEXTDOMAIN),
            array(&$this, 'noSalaryField'),
            'job-finder-plugin',
            'job_finder_vacancies_section_id'
        );
        add_settings_field(
            'job_finder_salary_field_id',
            __('Salary', JOBFINDER_PlUGIN_TEXTDOMAIN),
            array(&$this, 'salaryField'),
            'job-finder-plugin',
            'job_finder_vacancies_section_id'
        );


    }

    public function cityField(){
        $option = get_option(JOBFINDER_PlUGIN_OPTION_NAME);
        ?>
        <input type="text"
               name="<?php echo JOBFINDER_PlUGIN_OPTION_NAME; ?>[vacancies][city]"
               value="<?php echo esc_attr( $option['vacancies']['city'] ) ?>" />
        <?php
    }
    public function keyWordsField(){
        $option = get_option(JOBFINDER_PlUGIN_OPTION_NAME);
        ?>
        <input type="text"
               name="<?php echo JOBFINDER_PlUGIN_OPTION_NAME; ?>[vacancies][keyWords]"
               value="<?php echo esc_attr( $option['vacancies']['keyWords'] ) ?>" />
        <?php
    }
    public function noSalaryField(){
        $option = get_option(JOBFINDER_PlUGIN_OPTION_NAME);
        ?>
        <input type="checkbox"
               name="<?php echo JOBFINDER_PlUGIN_OPTION_NAME; ?>[vacancies][noSalary]"
               value="<?php echo esc_attr( $option['vacancies']['noSalary'] ) ?>" />
        <?php
    }
    public function salaryField(){
        $option = get_option(JOBFINDER_PlUGIN_OPTION_NAME);
        ?>
        <input type="number"
               name="<?php echo JOBFINDER_PlUGIN_OPTION_NAME; ?>[vacancies][salary]"
               value="<?php echo esc_attr( $option['vacancies']['salary'] ) ?>" />
        <?php
    }


    /**
     * Сохранение опции
     * @param $input
     */
    public function saveOption($input)
    {
        return $input;
    }
    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }

}