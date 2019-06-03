<?php

/**
 * @action plugins_loaded
 */
function _h_load_customizer() {
  require_once __DIR__ . '/customizer.php';
  require_once __DIR__ . '/customizer-default.php';

  new \h\Customizer_Default();
}

/**
 * Inititate Edje customizer object. Only use this in "customize_register" action.
 */
function h_customizer( WP_Customize_Manager $wp_customize ) {
  return new \h\Customizer( $wp_customize );
}