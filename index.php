<?php
/*
Plugin Name: Edje WP Framework
Description: Collection of code to help developers customize WordPress into full-fledged CMS.
Plugin URI: http://github.com/hrsetyono/edje-wp
Author: The Syne Studio
Version: 0.1.0
Author URI: http://thesyne.com/
*/

require_once "lib/all.php";
require_once "vendor/all.php";

class H {
  public static function register_post_type($name, $args = array() ) {
    $pt = new H_PostType($name, $args);
    // $pt = new CPT($name, $args);
    $pt->init();
  }
}
