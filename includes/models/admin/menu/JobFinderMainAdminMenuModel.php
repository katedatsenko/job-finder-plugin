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

    }

    /**
     * Регистрировать опции
     * Добавлять поля опции
     * Добавлять секции опции

     */
    public function createOption()
    {

        // register_setting( $option_group, $option_name, $sanitize_callback );
        // Регистрирует новую опцию
        register_setting('JobFinderMainSettings', JOBFINDER_PlUGIN_OPTION_NAME, array(&$this, 'saveOption'));
        // add_settings_section( $id, $title, $callback, $page );
        // Добавление секции опций
        add_settings_section( 'job_finder_account_section_id', __('Account', JOBFINDER_PlUGIN_TEXTDOMAIN), '', 'job-finder-plugin' );
        // add_settings_field( $id, $title, $callback, $page, $section, $args );
        // Добавление полей опций
        add_settings_field(
            'job_finder_token_field_id',
            __('Token', JOBFINDER_PlUGIN_TEXTDOMAIN),
            array(&$this, 'tokenField'),
            'job-finder-plugin',
            'job_finder_account_section_id'
        );
        add_settings_field(
            'job_finder_marker_field_id',
            __('Marker', JOBFINDER_PlUGIN_TEXTDOMAIN),
            array(&$this, 'markerField'),
            'job-finder-plugin',
            'job_finder_account_section_id'
        );

    }

    public function tokenField(){
        $option = get_option(JOBFINDER_PlUGIN_OPTION_NAME);
        ?>
        <input type="text"
               name="<?php echo JOBFINDER_PlUGIN_OPTION_NAME; ?>[account][token]"
               value="<?php echo esc_attr( $option['account']['token'] ) ?>" />
        <?php
    }
    public function markerField(){
        $option = get_option(JOBFINDER_PlUGIN_OPTION_NAME);
        ?>
        <input type="text"
               name="<?php echo JOBFINDER_PlUGIN_OPTION_NAME; ?>[account][marker]"
               value="<?php echo esc_attr( $option['account']['marker'] ) ?>" />
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