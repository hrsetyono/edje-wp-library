<?php
/**
 * @deprecated - Replaced with Custy (https://github.com/hrsetyono/wp-custy/)
 */
add_action( 'plugins_loaded' , '_h_load_customizer' );
add_action( 'customize_controls_print_styles', '_h_enqueue_customizer' );

/**
 * @action plugins_loaded
 */
function _h_load_customizer() {
  require_once __DIR__ . '/customizer-default.php';
  new \h\Customizer_Default();
}

/**
 * @action customize_controls_print_styles
 */
function _h_enqueue_customizer() {
  $asset_dir = plugin_dir_url(__FILE__) . 'assets';

	wp_enqueue_style( 'h-customizer', $asset_dir . '/h-customizer.css', [], '1.0', 'all' );
}


/////


/**
 * Inititate Edje customizer object. Only use this in "customize_register" action.
 */
function h_customizer( $wp_customize ) {
  require_once __DIR__ . '/customizer.php';
  return new \h\Customizer( $wp_customize );
}