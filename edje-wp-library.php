<?php
/*
Plugin Name: Edje WP Library
Description: Simplify WordPress complicated functions. Designed to work with Timber.
Plugin URI: http://github.com/hrsetyono/edje-wp-library
Author: Pixel Studio
Author URI: https://pixelstudio.id
Version: 3.2.1
*/

if( !defined( 'WPINC' ) ) { die; } // exit if accessed directly

// Constant
define( 'H_VERSION', '3.2.1' );
define( 'H_URL', plugin_dir_url(__FILE__) );
define( 'H_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'H_BASE', basename(dirname(__FILE__) ).'/'.basename(__FILE__) );


if( !class_exists('Edje_WP_Library') ):

require_once 'module-helper/_load.php';
require_once 'module-gutenberg/_load.php';
require_once 'module-post-type/_load.php';
require_once 'module-customizer/_load.php';
require_once 'module-admin-sidenav/_load.php';
require_once 'module-vendor/_load.php';
require_once 'module-modify/_load.php';

  
class Edje_WP_Library {
  function __construct() {
    add_action( 'plugins_loaded' , [$this, 'load_modules'] );
    add_action( 'init', [$this, 'init_modules'] );

    // Run activation hook only if EDJE is set to true in wp-config.
    if( defined( 'EDJE' ) ) {  
      require_once 'activation-hook.php';
      register_activation_hook( H_BASE, [$this, 'register_activation_hook'] );
    }
  }

  /**
   * Load all modules
   * @action plugins_loaded
   */
  function load_modules() {
    _h_load_helper();

    _h_load_gutenberg();
    _h_load_post_type();
    _h_load_admin_nav();
    _h_load_customizer();

    _h_load_vendor();
    _h_load_modify();
  }

  function init_modules() {

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
      call_user_func_array( "h_$name", $args );
    } else {
      trigger_error( "The function H::$name does not exist.", E_USER_ERROR );
    }
  }
}

endif; // class_exists