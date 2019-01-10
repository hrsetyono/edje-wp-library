<?php
/*
  Third party and custom-made utility functions
  - Can be used in any module
*/

require_once H_PATH . '/module-helper/h-helper.php';
require_once H_PATH . '/module-helper/inflector.php';
require_once H_PATH . '/module-helper/parsedown.php';

// only if not in admin
if( !is_admin() ) {
  require_once H_PATH . '/module-helper/h-shortcode.php';
  new H_Shortcode();
}

// If Timber is activated
if( _H::is_plugin_active('timber') ) {
  require_once H_PATH . '/module-helper/h-twig.php';
  require_once H_PATH . '/module-helper/timber-block.php';

  new H_Twig();
}
