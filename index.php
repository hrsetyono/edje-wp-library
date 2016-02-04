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

  // -----------
  // MENU
  // -----------

  public static function remove_menu($list) {
    $menu = new H_Menu($list);
    $menu->remove();
  }

  public static function add_menus($args) {
    $menu = new H_Menu($args);
    $menu->add();
  }

  public static function add_menu($title, $args) {
    $new_args = array(
      $title => $args
    );
    H::add_menus($new_args);
  }

  public static function add_submenu($parent_title, $args) {
    $new_args = array();
    foreach($args as $title => $slug) {
      $new_args[$title] = array(
        "slug" => $slug,
        "position" => "inside {$parent_title}"
      );
    }

    H::add_menus($new_args);
  }

  public static function add_menu_counter($parent_title, $count_function) {
    $new_args = array(
      $parent_title => array(
        "position" => "inside {$parent_title}",
        "counter" => $count_function,
      )
    );

    H::add_menus($new_args);
  }
}
