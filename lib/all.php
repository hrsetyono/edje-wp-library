<?php

require_once 'h-helper.php';
require_once 'h-default.php';

// admin
if(is_admin() ) {
  require_once 'h-on-install.php';

  require_once 'h-menu.php';
  require_once 'h-menusub.php';
  require_once 'h-editor.php';
}
// public
else {
  require_once 'h-shortcode.php';
  require_once 'h-twig.php';
}
