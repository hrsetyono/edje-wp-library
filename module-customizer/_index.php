<?php

add_action( 'plugins_loaded' , '_h_load_customizer' );

/**
 * @action plugins_loaded
 */
function _h_load_customizer() {
  require_once __DIR__ . '/customizer-default.php';
  new \h\Customizer_Default();
}


/////


/**
 * Inititate Edje customizer object. Only use this in "customize_register" action.
 */
function h_customizer( $wp_customize ) {
  require_once __DIR__ . '/customizer.php';
  return new \h\Customizer( $wp_customize );
}