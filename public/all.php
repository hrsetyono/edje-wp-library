<?php
/*
  Controller for functions that need to be called
*/
require_once 'h.php';
require_once 'post-type/all.php';
require_once 'customizer/all.php';

// only on admin
if( is_admin() ) {
  require_once 'h-sidepanel.php';
}
// only frontend
else {
  require_once 'h-twig.php';
  new H_Twig();
}

// must be upon init
add_filter( 'init', 'public_all_init' );
function public_all_init() {
  if( !is_admin() ) {
    require_once 'h-shortcode.php';
    new H_Shortcode();
  }
}
