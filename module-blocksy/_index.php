<?php

add_action( 'plugins_loaded' , '_h_load_blocksy' );

function _h_load_blocksy() {
  require_once __DIR__ . '/inc/_index.php';

  require_once __DIR__ . '/helpers.php';
  require_once __DIR__ . '/enqueue.php';
  require_once __DIR__ . '/defaults.php';
  require_once __DIR__ . '/styles.php';
  require_once __DIR__ . '/format-styles.php';
  require_once __DIR__ . '/format-options.php';
}