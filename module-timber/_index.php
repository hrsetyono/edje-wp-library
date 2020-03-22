<?php

add_action( 'plugins_loaded' , function() {
  if( !class_exists('Timber') ) { return; }

  require_once __DIR__ . '/filters.php';

  new H_TimberFilters();

  // enable password-protected post
  add_filter( 'timber/post/content/show_password_form_for_protected', '__return_true' );
} );


/**
 * Get TimberMenu object using ID
 */
function h_get_timber_menu( $menu_id ) {
  return new Timber\Menu( $menu_id );
}