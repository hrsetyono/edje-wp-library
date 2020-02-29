<?php

add_action( 'plugins_loaded' , function() {
  require_once __DIR__ . '/h-helper.php';
  require_once __DIR__ . '/custom-shortcode.php';

  new H_Shortcode();
} );