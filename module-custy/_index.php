<?php
define( 'BLOCKSY_DIR', H_DIR . '/module-custy' );
define( 'BLOCKSY_URL', H_URL . 'module-custy' ); 

add_action( 'after_setup_theme' , '_h_load_custy', 9999 );

function _h_load_custy() {
  require_once __DIR__ . '/inc/_index.php';
  require_once __DIR__ . '/enqueue.php';

  require_once __DIR__ . '/default-sections.php';
  require_once __DIR__ . '/default-values.php';
  require_once __DIR__ . '/output-styles.php';

  require_once __DIR__ . '/format-values.php';
  require_once __DIR__ . '/format-sections.php';
  require_once __DIR__ . '/format-sync.php';

  // require_once __DIR__ . '/builder.php';
  // require_once __DIR__ . '/builder-footer-options.php';
  // require_once __DIR__ . '/header-options.php';
  // require_once __DIR__ . '/header-values.php';
}

/////


class Custy {
  /**
   * Get theme mod that is generated with Blocksy
   * 
   * @param $id (string) - The option ID
   * @return mixed - The mod value or "false" if not found
   */
  static function get_mod( $id ) {
    $value = get_theme_mod( $id );

    // if value not found, return default
    if( !$value ) {
      $defaults = Custy::get_default_values();
      $value = $defaults[ $id ] ?? false;
    }

    return $value;
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
}