<?php

/**
 * @actions plugins_loaded
 */
function _h_load_modify() {
  // admin
  if( is_admin() ) {
    require_once __DIR__ . '/admin.php';
    new \h\Modify_Admin();

    if( defined('DISALLOW_FILE_EDIT') && !DISALLOW_FILE_EDIT ) {
      require_once __DIR__ . '/code-editor.php';
      new \h\Modify_Code_Editor();
    }
  }
  // frontend
  else {
    require_once __DIR__ . '/login.php';
    require_once __DIR__ . '/head-footer.php';
    require_once __DIR__ . '/seo.php';

    new \h\Modify_Login();
    new \h\Modify_Head_Footer();
    new \h\Modify_SEO();

    if( _H::is_plugin_active('jetpack') ) {
      require_once __DIR__ . '/jetpack.php';
      new \h\Modify_Jetpack();
    }
  }

  // both
  require_once __DIR__ . '/adminbar.php';
  new \h\Modify_Adminbar();
  // TODO: add css to hide adminbar on specific size
}