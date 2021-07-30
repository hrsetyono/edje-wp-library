<?php
/**
 * Plugin Name: Edje WP Library
 * Description: Simplify WordPress complicated functions. Designed to work with Timber.
 * Plugin URI: http://github.com/hrsetyono/edje-wp-library
 * Requires at least: 5.3
 * Requires PHP: 7.0
 * License: MIT
 * Author: Pixel Studio
 * Author URI: https://pixelstudio.id
 * Version: 6.1.7
 */

if( !defined( 'WPINC' ) ) { die; } // exit if accessed directly

// Constant
define( 'H_VERSION', '6.1.6' );
define( 'H_BASE', basename(dirname(__FILE__) ).'/'.basename(__FILE__) );

define( 'H_DIR', __DIR__ ); // for require
define( 'H_URL', plugin_dir_url( __FILE__ ) ); // for linking assets


if( !class_exists('Edje_WP_Library') ):

require_once 'helper/_index.php';

require_once 'module-modify/_index.php';
require_once 'module-vendor/_index.php';
  
require_once 'module-post-type/_index.php';
require_once 'module-admin-sidenav/_index.php';
require_once 'module-comment/_index.php';
require_once 'module-widgets/_index.php';
// require_once 'module-customizer/_index.php; // deprecated

require_once 'module-gutenberg/_index.php';
require_once 'module-block-faq/_index.php';
require_once 'module-block-icon/_index.php';
  


class Edje_WP_Library {
  function __construct() {
    // Run activation hook only if EDJE is set to true in wp-config.
    if( defined( 'EDJE' ) ) {  
      require_once 'activation-hook.php';
      register_activation_hook( H_BASE, [$this, 'register_activation_hook'] );
    }

    add_filter( 'plugin_row_meta', [$this, 'add_doc_links'], 10, 2 );
  }

  /**
   * Register activation and deactivation hook
   */
  function register_activation_hook() {
    $hook = new H_Hook();
    $hook->on_activation();
  }

  /**
   * Add "Documentation" link in the plugin listing (besides the Deactivate link)
   * 
   * @action plugin_row_meta 10
   */
  function add_doc_links( $links, $file ) {
    if( $file === plugin_basename(__FILE__) ) {
      $links[] = '<a target="_blank" rel="noopener noreferrer" href="https://github.com/hrsetyono/edje-wp-library/wiki/"> View Documentation » </a>';
    }

    return $links;
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
      return call_user_func_array( $func_name, $args );
    } else {
      trigger_error( "The function H::$name does not exist.", E_USER_ERROR );
    }
  }
}

endif; // class_exists