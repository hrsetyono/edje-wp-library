<?php
define( 'BLOCKSY_ROOT', H_DIR . '/module-custy' );
define( 'BLOCKSY_DIR', H_DIR . '/module-custy/blocksy' );
define( 'BLOCKSY_URL', H_URL . 'module-custy' );
define( 'BLOCKSY_CSS_DIR', plugin_dir_url(__FILE__) . 'blocksy/css' );
define( 'BLOCKSY_JS_DIR', plugin_dir_url(__FILE__) . 'blocksy/js' );


add_action( 'plugins_loaded', '_custy_loaded' );
add_action( 'after_setup_theme' , '_custy_after_theme', 9999 );
add_action( 'init', '_custy_after_init', 9999 );

/**
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
 * @action after_setup_theme 9999
 */
function _custy_after_theme() {
  require_once __DIR__ . '/enqueue.php';
  
  require_once __DIR__ . '/helper-values.php';
  require_once __DIR__ . '/helper-options.php';
  require_once __DIR__ . '/helper-sync.php'; 

  require_once __DIR__ . '/stylesheet.php';
  require_once __DIR__ . '/stylesheet-compile.php';
  require_once __DIR__ . '/stylesheet-output.php';

  add_filter( 'custy_sections', '_custy_set_core_sections', 1 );
  add_filter( 'custy_sections', '_custy_format_sections', 99999 );

  add_action( 'wp_head', '_custy_render_stylesheet', 0 );
  add_action( 'admin_print_styles', '_custy_render_admin_stylesheet', 0 );
  
  // BUILDER
  require_once __DIR__ . '/builder-items.php';
  require_once __DIR__ . '/builder-values.php';

  add_filter( 'custy_header_items', '_custy_set_header_items', 0 );
  add_filter( 'custy_footer_items', '_custy_set_footer_items', 0 );
}


/**
 * @action init 9999
 */
function _custy_after_init() {
  Custy::set_builder_items(); // initiate builder cache
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

  /**
   * Set a cache to Header and Footer items
   */
  static function set_builder_items() {
    global $custy_header_items;
    global $custy_footer_items;

    $custy_header_items = apply_filters( 'custy_header_items', [] );
    $custy_footer_items = apply_filters( 'custy_footer_items', [] );
  }

  /**
   * Get Header or Footer items.
   * 
   * @param $type (string) - 'header' or 'footer'
   * @param $include (string) - 'primary', 'secondary', or 'all'. Primary is rows, Secondary is non-rows.
   * @param $require_options (bool) - include option arg or not.
   * @param $need_format (bool) - return formatted or non-formatted items
   * 
   * @return array
   */
  static function get_builder_items( $type, $include = 'all', $require_options = false, $need_format = true ) {
    global $custy_header_items;
    global $custy_footer_items;

    // get items
    $items = $type === 'header' ? $custy_header_items : $custy_footer_items;

    // format items
    $bi = new Custy_BuilderItems();
    $items = $bi->filter_items( $items, $include );

    if( $need_format ) {
      $items = $bi->format_items( $items, $type, $require_options );
    }

    return $items;
  }


  /**
   * Get Header or Footer markup
   * Filters: custy_header_values, custy_footer_values, custy_render_header, & custy_render_footer
   * 
   * @param $type (string) - 'header' or 'footer'
   * @return string - HTML Markup
   */
  static function get_builder_content( $type = 'header' ) {
    $raw_values = self::get_mod( $type . '_placements' );
    $formatted_values = [];
    $bv = new Custy_BuilderValues();

    switch( $type ) {
      case 'header':
        $formatted_values = $bv->format_header_values( $raw_values );
        break;
      case 'footer':
        $formatted_values = $bv->format_footer_values( $raw_values );
        break;
    }

    return apply_filters( "custy_render_{$type}", '', $formatted_values );
  }
}