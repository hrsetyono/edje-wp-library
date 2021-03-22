<?php

add_action( 'plugins_loaded' , '_h_load_vendor', 1 );
add_action( 'wp_enqueue_scripts', '_h_enqueue_vendor' );


/**
 * @action plugins_loaded
 */
function _h_load_vendor() {
  require_once __DIR__ . '/inflector.php';
  require_once __DIR__ . '/parsedown.php';

  if( !class_exists('Timber') ) {
    require_once H_DIR . '/vendor/autoload.php';
    $timber = new \Timber\Timber();
  }
}

/**
 * @action wp_enqueue_scripts
 */
function _h_enqueue_vendor() {
  $css = plugin_dir_url(__FILE__) . 'css';
  $js = plugin_dir_url(__FILE__) . 'js';

  // Register H Library, you need to enqueue it in theme
  wp_register_script( 'h-slider', $js . '/h-slider.min.js', [], false, true );
  wp_register_script( 'h-scroll', $js . '/h-scroll.min.js', [], false, true );
  wp_register_script( 'h-lightbox', $js . '/h-lightbox.min.js', [], false, true );

  wp_register_style( 'h-slider', $css . '/h-slider.css' );
  wp_register_style( 'h-lightbox', $css . '/h-lightbox.css' );
}