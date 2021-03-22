<?php

require_once __DIR__ . '/utilities.php';
require_once __DIR__ . '/utilities-private.php';
require_once __DIR__ . '/utilities-deprecated.php';


add_action( 'plugins_loaded' , function() {
  require_once __DIR__ . '/shortcode.php';

  if( class_exists('Timber') ) {
    require_once __DIR__ . '/timber.php';
  }
} );