<?php
/*
  Change some default behavior on WordPress and other plugins
*/

_h_module_default();

function _h_module_default() {
  require_once H_PATH . '/module-change-default/default-public.php';
  new \h\Default_Public();

  // if in admin
  if( is_admin() ) {
    require_once H_PATH . '/module-change-default/default-codemirror.php';
    require_once H_PATH . '/module-change-default/default-admin.php';
    new \h\Default_Admin();
    new \h\Default_Codemirror();
  }
  // if not in admin
  else {
    require_once H_PATH . '/module-change-default/default-jetpack.php';
    new \h\Default_Jetpack();
  }
}
