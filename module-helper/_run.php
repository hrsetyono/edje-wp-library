<?php
/*
  Third party and custom-made utility functions
  - Can be used in any module
*/

require_once H_PATH . '/module-helper/h-helper.php';
require_once H_PATH . '/module-helper/inflector.php';


if( !is_admin() ) {
  require_once H_PATH . '/module-helper/parsedown.php';
  require_once H_PATH . '/module-helper/h-twig.php';
  require_once H_PATH . '/module-helper/h-shortcode.php';
  new H_Twig();
  new H_Shortcode();
}
