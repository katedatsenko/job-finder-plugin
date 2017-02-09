<?php
/*
Plugin Name: Job Finder Plugin
Plugin URI: https://github.com/katedatsenko/job-finder-plugin
Description: Plugin for obtaining relevant and fresh vacancies.
Version: 1.0
Author: ekaterinadatsenko
Author URI: https://vk.com/kate.datsenko
Text Domain: job-finder-plugin
Domain Path: /languages/
License: A "Slug" license name e.g. GPL2


Copyright 2017  Datsenko Ekaterina  (email: kate.datsenko@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
require_once plugin_dir_path(__FILE__) . '/config-path.php';
require_once JOBFINDER_PlUGIN_DIR.'/includes/common/JobFinderAutoload.php';
require_once JOBFINDER_PlUGIN_DIR.'/includes/JobFinderPlugin.php';

register_activation_hook( __FILE__, array('includes\JobFinderPlugin' ,  'activation' ) );
register_deactivation_hook( __FILE__, array('includes\JobFinderPlugin' ,  'deactivation' ) );



?>