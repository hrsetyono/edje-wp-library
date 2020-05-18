<?php
add_action( 'plugins_loaded' , '_h_load_modify' );

/**
 * @actions plugins_loaded
 */
function _h_load_modify() {
  // admin
  if( is_admin() ) {
    require_once __DIR__ . '/admin.php';

    if( defined('DISALLOW_FILE_EDIT') && !DISALLOW_FILE_EDIT ) {
      require_once __DIR__ . '/code-editor.php';
    }
  }
  // frontend
  else {
    require_once __DIR__ . '/login.php';
    require_once __DIR__ . '/seo.php';

    if( class_exists( 'Jetpack' ) ) {
      require_once __DIR__ . '/jetpack.php';
    }
  }

  // both
  require_once __DIR__ . '/head-footer.php';
  require_once __DIR__ . '/adminbar.php';
}