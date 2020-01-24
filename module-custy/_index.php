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

  
  require_once __DIR__ . '/builder.php';
  require_once __DIR__ . '/builder-items-header.php';
  require_once __DIR__ . '/builder-items-footer.php';
  require_once __DIR__ . '/header-default-values.php';
  require_once __DIR__ . '/footer-default-values.php';

  
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
   * Get Header or Footer markup
   * 
   * @param $type (strng) - 'header' or 'footer'
   * @return string - HTML Markup
   */
  static function get_builder_content( $type = 'header' ) {
    $data = apply_filters( "custy_{$type}_data", $data );
    return apply_filters( "custy_{$type}_header", '', $data );		
  }

  
  /**
   * Get Header or Footer item list
   * 
   * @param $type (string) - 'header' or 'footer'
   */
  static function get_builder_items( $type = 'header' ) {
    if( $type === 'header' ) {
      global $custy_header_items;
      $custy_header_items = $custy_header_items ?? apply_filters( 'custy_header_items', [] );
      return $custy_header_items;
    }
    elseif( $type === 'footer' ) {
      global $custy_footer_items;
      $custy_footer_items = $custy_footer_items ?? apply_filters( 'custy_footer_items', [] );
      return $custy_footer_items;
    }

    return [];
  }

}