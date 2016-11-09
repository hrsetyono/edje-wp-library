<?php

require_once 'h-helper.php';
require_once 'h-default.php';

require_once 'h-post-type.php';
require_once 'h-taxonomy.php';

// admin
if(is_admin() ) {
  require_once 'h-on-install.php';

  require_once 'h-post-column.php';
  require_once 'h-post-filter.php';
  require_once 'h-post-action.php';

  require_once 'h-menu.php';
  require_once 'h-menusub.php';

  require_once 'h-editor.php';
}
// public
else {
  require_once 'h-shortcode.php';
  require_once 'h-twig.php';
}
