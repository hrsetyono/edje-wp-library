<?php
/*
  Controller for functions that run automatically without User notice
*/

// only on admin
if( is_admin() ) {
  require_once 'h-on-activate.php';
  require_once 'h-default-admin.php';

  new H_OnActivate();
  new H_DefaultAdmin();
}
// only frontend
else {
  require_once 'h-default.php';
  new H_Default();

  if( _H::is_plugin_active('jetpack') ) {
    require_once 'h-jetpack.php';
    new H_Jetpack();
  }
}


// must be upon init
add_filter( 'init', 'admin_all_init' );
function admin_all_init() {
  if( !is_admin() && is_dynamic_sidebar() ) {
    require_once 'h-widget.php';
    new H_Widget();
  }
}
