<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 002 02.02.17
 * Time: 23:01
 */
define("JOBFINDER_PlUGIN_DIR", plugin_dir_path(__FILE__));
define("JOBFINDER_PlUGIN_URL", plugin_dir_url( __FILE__ ));
define("JOBFINDER_PlUGIN_SLUG", preg_replace( '/[^\da-zA-Z]/i', '_',  basename(JOBFINDER_PlUGIN_DIR)));
define("JOBFINDER_PlUGIN_TEXTDOMAIN", str_replace( '_', '-', JOBFINDER_PlUGIN_SLUG ));
define("JOBFINDER_PlUGIN_OPTION_VERSION", JOBFINDER_PlUGIN_SLUG.'_version');
define("JOBFINDER_PlUGIN_OPTION_NAME", JOBFINDER_PlUGIN_SLUG.'_options');
define("JOBFINDER_PlUGIN_AJAX_URL", admin_url('admin-ajax.php'));

    if ( ! function_exists( 'get_plugins' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
 $TPOPlUGINs = get_plugin_data(JOBFINDER_PlUGIN_DIR.'/'.basename(JOBFINDER_PlUGIN_DIR).'.php', false, false);

 define("JOBFINDER_PlUGIN_VERSION", $TPOPlUGINs['Version']);
 define("JOBFINDER_PlUGIN_NAME", $TPOPlUGINs['Name']);
define("JOBFINDER_PlUGIN_DIR_LOCALIZATION", plugin_basename(JOBFINDER_PlUGIN_DIR.'/languages/'));