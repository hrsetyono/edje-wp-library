<?php
/*
  Function wrapper for modifiying Customizer panel
*/

add_action( 'init', '_run_h_customizer' );
add_action( 'admin_init', '_run_admin_h_customizer' );

function _run_h_customizer() {
  require_once H_PATH . '/module-customizer/customizer.php';
  require_once H_PATH . '/module-customizer/customizer-default.php';
  require_once H_PATH . '/module-customizer/customizer-tinymce.php';

  new \h\Customizer_Default();
}

function _run_admin_h_customizer() {
  //
}
