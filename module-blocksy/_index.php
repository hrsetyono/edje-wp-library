<?php

// the order must be last
add_action( 'after_setup_theme' , '_h_load_custy', 9999 );

function _h_load_custy() {
  if( !get_theme_support( 'custy-customizer' ) ) { return; }
  
    require_once __DIR__ . '/inc/_index.php';

    require_once __DIR__ . '/enqueue.php';
    require_once __DIR__ . '/core-sections.php';
    require_once __DIR__ . '/core-values.php';
    require_once __DIR__ . '/output-styles.php';

    require_once __DIR__ . '/format-values.php';
    require_once __DIR__ . '/format-sections.php';
    require_once __DIR__ . '/format-sync.php';

    require_once __DIR__ . '/builder.php';
    require_once __DIR__ . '/builder-footer-options.php';
    require_once __DIR__ . '/header-options.php';
    require_once __DIR__ . '/header-values.php';
}

/////

/**
 * Get theme mod that is generated with Blocksy
 * 
 * @param $id (string) - The option ID
 * @return mixed - The mod value or "false" if not found
 */
function h_get_mod( $id ) {
  $value = get_theme_mod( $id );

  // if value not found, return default
  if( !$value ) {
    $defaults = Custy::get_default_values();
    $value = $defaults[ $id ] ?? false;
  }

  return $value;
}


class Custy {

  /**
   * Get the default value of theme mods
   */
  function get_default_values() {
    global $custy_default_values; // cache

    if( empty( $custy_default_values ) ) {
      $custy_default_values = apply_filters( 'custy_default_values', [] );
    }
    
    return $custy_default_values;
  }


  /**
   * Get the list of sections for theme mods
   */
  static function get_sections() {
    global $custy_sections; // cache

    if( empty( $custy_sections ) ) {
      $custy_sections = apply_filters( 'custy_sections', [] );
    }

    return $custy_sections;
  }
}