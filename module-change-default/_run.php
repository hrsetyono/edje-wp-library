<?php
/*
  Change some default behavior on WordPress and other plugins
*/

add_action( 'init', '_run_h_default' );
add_action( 'admin_init', '_run_admin_h_default' );

/////

function _run_h_default() {
  require_once H_PATH . '/module-change-default/h-default.php';
  new H_Default();

  // if not in admin AND jetpack is installed
  if( !is_admin() && _H::is_plugin_active('jetpack') ) {
    require_once H_PATH . '/module-change-default/h-jetpack.php';
    new H_Jetpack();
  }
}

function _run_admin_h_default() {
  require_once H_PATH . '/module-change-default/h-default-admin.php';
  new H_DefaultAdmin();
}
