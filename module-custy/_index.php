<?php
define( 'BLOCKSY_DIR', H_DIR . '/module-custy' );
define( 'BLOCKSY_URL', H_URL . 'module-custy' ); 

add_action( 'after_setup_theme' , '_h_load_custy', 9999 );

function _h_load_custy() {
  require_once __DIR__ . '/inc/_index.php';
  require_once __DIR__ . '/enqueue.php';

  require_once __DIR__ . '/default-sections.php';
  require_once __DIR__ . '/default-values.php';

  require_once __DIR__ . '/stylesheet.php';
  require_once __DIR__ . '/stylesheet-compile.php';
  require_once __DIR__ . '/stylesheet-output.php';

  require_once __DIR__ . '/format-values.php';
  require_once __DIR__ . '/format-sections.php';
  require_once __DIR__ . '/sync-preview.php';

  // require_once __DIR__ . '/builder.php';
  // require_once __DIR__ . '/builder-footer-options.php';
  require_once __DIR__ . '/header-format.php';
  require_once __DIR__ . '/header-options.php';
  require_once __DIR__ . '/header-default-values.php';

  
  add_filter( 'custy_default_values', '_custy_set_default_values' );
  
  add_filter( 'custy_sections', '_custy_set_default_sections', 1 );
  add_filter( 'custy_sections', '_custy_format_sections', 99999 );

  add_action( 'wp_head', '_custy_render_stylesheet', 0 );
  add_action( 'admin_print_styles', '_custy_render_admin_stylesheet', 0 );
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
  static function get_default_values() {
    global $custy_default_values;

    if( empty( $custy_default_values ) ) {
      $custy_default_values = apply_filters( 'custy_default_values', [] );
    }
    
    return $custy_default_values;
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
   * Get header HTML content
   * 
   * @return string - Header's HTML markup
   */
  static function get_header_content() {
    global $custy_header_data; // cache

    if( empty( $custy_header_data ) ) {
      $custy_header_data = apply_filters( 'custy_header_data', $custy_header_data );
    }
		
    return apply_filters( 'custy_render_header', '', $custy_header_data );
  }

  
  /**
   * Get the list of options for theme mods
   */
  static function get_header_sections() {
    global $custy_header_sections; // cache

    if( empty( $custy_header_sections ) ) {
      $custy_header_sections = apply_filters( 'custy_header_sections', [] );
    }

    return $custy_header_sections;
  }
}