<?php

require_once 'h-helper.php';
require_once 'h-default.php';

// admin
if(is_admin() ) {
  require_once 'h-on-install.php';

  require_once 'h-admin-default.php';
  require_once 'h-menu.php';
  require_once 'h-menusub.php';
}
// public
else {
  require_once 'h-shortcode.php';
  require_once 'h-jetpack.php';
  require_once 'h-timber.php';

  // need to run after init to wait for theme_support to run
  // TODO: might need to wrap the other codes in INIT too
  add_filter('init', function() {
    if(is_dynamic_sidebar() ) { require_once 'h-widget.php'; }
  });
}
