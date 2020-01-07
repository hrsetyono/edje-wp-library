<?php
/*
Plugin Name: Edje WP Library
Description: Simplify WordPress complicated functions. Designed to work with Timber.
Plugin URI: http://github.com/hrsetyono/edje-wp-library
Author: Pixel Studio
Author URI: https://pixelstudio.id
Version: 4.0.0-beta
*/

if( !defined( 'WPINC' ) ) { die; } // exit if accessed directly

// Constant
define( 'H_VERSION', '4.0.0' );
define( 'H_BASE', basename(dirname(__FILE__) ).'/'.basename(__FILE__) );

define( 'H_DIR', __DIR__ ); // for require
define( 'H_URL', plugin_dir_url( __FILE__ ) ); // for linking assets
define( 'BLOCKSY_DIR', H_DIR . '/module-blocksy' );
define( 'BLOCKSY_URL', H_URL . 'module-blocksy' ); 


if( !class_exists('Edje_WP_Library') ):

require_once "helper/_index.php";

require_once "module-modify/_index.php";
require_once "module-vendor/_index.php";
  
require_once "module-post-type/_index.php";
require_once "module-admin-sidenav/_index.php";
require_once "module-customizer/_index.php";
require_once "module-api/_index.php";

require_once "module-editor/_index.php";
require_once "module-editor-faq/_index.php";
require_once "module-blocksy/_index.php";
  

class Edje_WP_Library {
  function __construct() {
    // Run activation hook only if EDJE is set to true in wp-config.
    if( defined( 'EDJE' ) ) {  
      require_once 'activation-hook.php';
      register_activation_hook( H_BASE, [$this, 'register_activation_hook'] );
    }
  }

  /**
   * Register activation and deactivation hook
   */
  function register_activation_hook() {
    $hook = new H_Hook();
    $hook->on_activation();
  }
}

new Edje_WP_Library();
endif;


/////

if( !class_exists('H') ):

/**
 * Alternate way to call Edje functions from each module's `_load.php`  
 * Example: to call `h_register_post_type()`, we can use `H::register_post_type()`
 */
class H {
  static function __callStatic( $name, $args ) {
    $func_name = "h_$name";

    if( is_callable( $func_name ) ) {
      return call_user_func_array( "h_$name", $args );
    } else {
      trigger_error( "The function H::$name does not exist.", E_USER_ERROR );
    }
  }
}

endif; // class_exists