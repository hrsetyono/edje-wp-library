<?php

add_action( 'plugins_loaded' , '_h_load_vendor' );
add_action( 'wp_enqueue_scripts', '_h_enqueue_vendor' );


/**
 * @action plugins_loaded
 */
function _h_load_vendor() {
  require_once __DIR__ . '/inflector.php';
  require_once __DIR__ . '/parsedown.php';
}

/**
 * @action wp_enqueue_scripts
 */
function _h_enqueue_vendor() {
  $assets = plugin_dir_url(__FILE__) . 'assets';

  // Register H Library, you need to enqueue it in theme
  wp_register_script( 'h-slider', $assets . '/h-slider.min.js', [], false, true );
  wp_register_script( 'h-scroll', $assets . '/h-scroll.min.js', [], false, true );
  wp_register_script( 'h-lightbox', $assets . '/h-lightbox.min.js', [], false, true );

  wp_register_style( 'h-slider', $assets . '/h-slider.css' );
  wp_register_style( 'h-lightbox', $assets . '/h-lightbox.css' );
}