<?php
/*
  Controller for handling Theme Customizer
*/
require_once 'customizer.php';
require_once 'customizer-default.php';
// require_once 'customizer-tinymce.php';

new H_Customizer_Default();

add_action( 'init', 'customizer_all_init' );
function customizer_all_init() {
  require_once 'customizer-tinymce.php';
}
