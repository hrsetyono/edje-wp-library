<?php

add_action( 'plugins_loaded' , '_h_load_helper' );

/**
 * @action plugins_loaded
 */
function _h_load_helper() {
  require_once __DIR__ . '/h-helper.php';
  require_once __DIR__ . '/custom-shortcode.php';

  new H_Shortcode();

  if( class_exists('Timber') ) {
    require_once __DIR__ . '/twig-helper.php';

    new \h\Twig_Helper();
  }
}