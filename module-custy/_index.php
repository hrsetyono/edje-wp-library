<?php
define( 'BLOCKSY_ROOT', H_DIR . '/module-custy' );
define( 'BLOCKSY_DIR', H_DIR . '/module-custy/blocksy' );
define( 'BLOCKSY_URL', H_URL . 'module-custy' );
define( 'BLOCKSY_CSS_DIR', plugin_dir_url(__FILE__) . 'blocksy/css' );
define( 'BLOCKSY_JS_DIR', plugin_dir_url(__FILE__) . 'blocksy/js' );


add_action( 'plugins_loaded', '_h_load_custy' );
add_action( 'after_setup_theme' , '_h_setup_custy', 9999 );

function _h_load_custy() {
  require_once BLOCKSY_DIR . '/_index.php';
}

function _h_setup_custy() {
  require_once __DIR__ . '/enqueue.php';

  require_once __DIR__ . '/default-sections.php';
  require_once __DIR__ . '/default-values.php';

  require_once __DIR__ . '/stylesheet.php';
  require_once __DIR__ . '/stylesheet-compile.php';
  require_once __DIR__ . '/stylesheet-output.php';

  require_once __DIR__ . '/format-values.php';
  require_once __DIR__ . '/format-sections.php';
  require_once __DIR__ . '/sync-preview.php';

  
  add_filter( 'custy_default_values', '_custy_set_default_values' );
  add_filter( 'custy_sections', '_custy_set_default_sections', 1 );
  add_filter( 'custy_sections', '_custy_format_sections', 99999 );

  add_action( 'wp_head', '_custy_render_stylesheet', 0 );
  add_action( 'admin_print_styles', '_custy_render_admin_stylesheet', 0 );


  ///// BUILDER
  
  require_once __DIR__ . '/builder-items.php';
  require_once __DIR__ . '/builder-values.php';

  // Require the Header & Footer items
  $header_files = glob( __DIR__ . '/header/*.php' );
  $footer_files = glob( __DIR__ . '/footer/*.php' );
  foreach( $header_files as $file ) { require_once $file; }
  foreach( $footer_files as $file ) { require_once $file; }

  add_filter( 'custy_header_items', '_custy_format_builder_items', 9999, 3 );
  add_filter( 'custy_footer_items', '_custy_format_builder_items', 9999, 3 );
  add_filter( 'custy_header_values', '_custy_format_builder_values', 10 );
  add_filter( 'custy_footer_values', '_custy_format_builder_values', 10 );
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
      $custy_mods = wp_parse_args( get_theme_mods(), self::get_default_values() );
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
    return $mods[ $id ] ?? false;
  }


  /**
   * Get the default value of theme mods
   */
  static function get_default_values( $type = '' ) {

    if( $type === 'header' ) {
      global $custy_header_dv;
      $custy_header_dv = $custy_header_dv ?? apply_filters( 'custy_header_default_values', [] );
      return $custy_header_dv;
    }
    elseif( $type === 'footer' ) {
      global $custy_footer_dv;
      $custy_footer_dv = $custy_footer_dv ?? apply_filters( 'custy_footer_default_values', [] );
      return $custy_footer_dv;
    }
    else {
      global $custy_dv;
      $custy_dv = $custy_dv ?? apply_filters( 'custy_default_values', [] );
      return $custy_dv;
    }
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
   * Get Header or Footer options
   * Filters: custy_header_items & custy_footer_items
   */
  static function get_builder_items( $type = 'header', $include = 'all', $require_options = false ) {
    return apply_filters( "custy_{$type}_items", [], $include, $require_options );
  }


  /**
   * Get Header or Footer markup
   * Filters: custy_header_values, custy_footer_values, custy_render_header, & custy_render_footer
   * 
   * @param $type (strng) - 'header' or 'footer'
   * @return string - HTML Markup
   */
  static function get_builder_content( $type = 'header' ) {
    $raw_values = self::get_mod( $type . '_placements' );

    $data = apply_filters( "custy_{$type}_values", $raw_values );
    return apply_filters( "custy_render_{$type}", '', $data );
  }
}