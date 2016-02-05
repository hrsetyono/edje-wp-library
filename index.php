<?php
/*
Plugin Name: Edje WP Framework
Description: Collection of code to help developers customize WordPress into full-fledged CMS.
Plugin URI: http://github.com/hrsetyono/edje-wp
Author: The Syne Studio
Version: 0.2.1
Author URI: http://thesyne.com/
*/

require_once "lib/all.php";
require_once "vendor/all.php";

// Main portal for calling all methods
class H {
  public static function register_post_type($name, $args = array() ) {
    $pt = new H_PostType($name, $args);
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

// Github updater
if (is_admin() ) {
  $config = array(
    "slug" => plugin_basename(__FILE__),
    "proper_folder_name" => "edje-wp",
    "api_url" => "https://api.github.com/repos/hrsetyono/edje-wp",
    "raw_url" => 'https://raw.github.com/hrsetyono/edje-wp/master',
    "github_url" => "https://github.com/hrsetyono/edje-wp",
    "zip_url" => "https://github.com/hrsetyono/edje-wp/zipball/master",
    "sslverify" => true,
    "requires" => "4.4.0",
    "tested" => "4.4.0",
    "readme" => "README.md",
    "access_token" => "", // for private repo, authorize under Appearance > Github Update
   );
   new WP_GitHub_Updater($config);
}
