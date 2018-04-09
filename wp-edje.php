<?php
/*
Plugin Name: WordPress Edje
Description: Library to helps customize WordPress. Designed to work with Timber and Jetpack.
Plugin URI: http://github.com/hrsetyono/edje-wp
Author: The Syne Studio
Author URI: http://thesyne.com/
Version: 0.7.2
*/

// exit if accessed directly
if( !defined('ABSPATH') ) { exit; }

// Constant
define( 'H_URL', plugin_dir_url(__FILE__) );
define( 'H_BASE', basename(dirname(__FILE__) ).'/'.basename(__FILE__) );

require_once 'lib/h-helper.php';

require_once 'vendor/all.php';
require_once 'seo/all.php';

require_once 'admin/all.php';
require_once 'public/all.php';
