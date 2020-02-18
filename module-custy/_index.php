<?php
define( 'BLOCKSY_ROOT', H_DIR . '/module-custy' );
define( 'BLOCKSY_DIR', H_DIR . '/module-custy/blocksy' );
define( 'BLOCKSY_URL', H_URL . 'module-custy' );
define( 'BLOCKSY_CSS_DIR', plugin_dir_url(__FILE__) . 'blocksy/css' );
define( 'BLOCKSY_JS_DIR', plugin_dir_url(__FILE__) . 'blocksy/js' );


add_action( 'plugins_loaded', '_custy_loaded' );
add_action( 'after_setup_theme' , '_custy_after_theme', 9999 );

add_action( 'init', function() {
  CustyBuilder::set_items(); // initiate builder cache
}, 9999 );


/**
 * Load Blocksy and default values
 * 
 * @action plugins_loaded
 */
function _custy_loaded() {
  require_once BLOCKSY_DIR . '/_index.php';
  
  // DEFAULT VALUES
  require_once __DIR__ . '/core-sections/_default-values.php';
  require_once __DIR__ . '/header-items/_default-values.php';
  require_once __DIR__ . '/footer-items/_default-values.php';
  
  add_filter( 'custy_default_values', '_custy_core_default_values' );
  add_filter( 'custy_default_values', '_custy_header_default_values' );
  add_filter( 'custy_default_values', '_custy_footer_default_values' );
}


/**
 * Load all custom functions
 * 
 * @action after_setup_theme 9999
 */
function _custy_after_theme() {
  require_once __DIR__ . '/enqueue.php';
  require_once __DIR__ . '/helper.php';

  require_once __DIR__ . '/format-options.php';
  require_once __DIR__ . '/format-values.php';

  require_once __DIR__ . '/sync-preview.php';

  // Populate options
  require_once __DIR__ . '/core-sections/_index.php';
  require_once __DIR__ . '/header-items/_index.php';
  require_once __DIR__ . '/footer-items/_index.php';

  // Output <style> tags
  require_once __DIR__ . '/stylesheet.php';
  require_once __DIR__ . '/stylesheet-compile.php';
  require_once __DIR__ . '/stylesheet-output.php';
  add_action( 'wp_head', '_custy_render_stylesheet', 0 );
  add_action( 'admin_print_styles', '_custy_render_admin_stylesheet', 0 );
  
  // BUILDER
  require_once __DIR__ . '/builder.php';
  require_once __DIR__ . '/builder-values.php';
}


/////


class Custy {

  /**
   * Get all theme mods and assign default values if doesn't exists
   * 
   * @return array - All the theme mods
   */
  static function get_mods() {
    global $custy_mods;

    if( empty( $custy_mods ) ) {
      $defaults = self::get_default_values();
      $custy_mods = wp_parse_args( get_theme_mods(), $defaults );
    }
    return $custy_mods;
  }

  /**
   * Get theme mod that is generated with Blocksy
   * 
   * @param $id (string) - The option ID
   * @return mixed - The mod value or "false" if not found
   */
  static function get_mod( $id ) {
    $mods = self::get_mods();
    return $mods[ $id ] ?? null;
  }


  /**
   * Get the default value of theme mods
   * 
   * @param $type (string) - Either 'footer', 'header', or 'all'
   */
  static function get_default_values( $type = 'all' ) {
    global $custy_default_values;
    $custy_default_values = $custy_default_values ?? apply_filters( 'custy_default_values', [] );

    if( $type == 'all' ) {
      return $custy_default_values;
    } else {
      return $custy_default_values[ $type ] ?? null;
    }
  }

  /**
   * Get a single default value
   */
  static function get_default_value( $option_id ) {
    $defaults = self::get_default_values();
    return $defaults[ $option_id ] ?? null;
  }


  /**
   * Get the list of sections for theme mods
   */
  static function get_sections() {
    global $custy_sections;

    if( empty( $custy_sections ) ) {
      $custy_sections = apply_filters( 'custy_sections', [] );
    }

    return $custy_sections;
  }
}