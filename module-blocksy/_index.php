<?php

add_action( 'after_setup_theme' , '_h_load_blocksy' );

function _h_load_blocksy() {
  require_once __DIR__ . '/helpers.php';
  require_once __DIR__ . '/inc/_index.php';

  require_once __DIR__ . '/enqueue.php';

  require_once __DIR__ . '/default-options.php';
  require_once __DIR__ . '/output-styles.php';
  require_once __DIR__ . '/format-styles.php';
  require_once __DIR__ . '/format-options.php';
}

/////

/**
 * Get theme mod that is generated with Blocksy
 * 
 * @param $id (string) - The option ID
 * @return mixed - The mod value or "false" if not found
 */
function h_get_mod( $id ) {
  $defaults = _h_customizer_get_defaults();
  return $defaults[ $id ] ?? false;
}


/**
 * Get the default value of theme mods
 */
function _h_customizer_get_defaults() {
  global $h_defaults; // cache

  if( empty( $h_defaults ) ) {
    $h_defaults = apply_filters( 'h_customizer_defaults', [] );
  }
  
  return $h_defaults;
}

/**
 * Get the list of options for theme mods
 */
function _h_customizer_get_options() {
  global $h_options; // cache

  if( empty( $h_options ) ) {
    $h_options = apply_filters( 'h_customizer_options', [] );
  }

  return $h_options;
}