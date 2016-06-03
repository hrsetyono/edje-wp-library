<?php
/*
Plugin Name: Edje WordPress
Description: Collection of code to help developers customize WordPress into full-fledged CMS.
Plugin URI: http://github.com/hrsetyono/edje-wp
Author: The Syne Studio
Author URI: http://thesyne.com/
Version: 0.4.1
*/

// Constant
define('H_PLUGIN_DIR', basename( dirname( __FILE__ ) ).'/'.basename( __FILE__ ) );

require_once 'lib/all.php';
require_once 'vendor/all.php';

$h_class = new H();

// Main portal for calling all methods
class H {
  function __construct() {
    $install = new H_Install();
    $default = new H_Default();

    if(!is_admin() ) {
      $seo = new H_SEO();
    }
  }

  // ----- POST TYPE -----

  static function register_post_type($name, $args = array() ) {
    $pt = new H_PostType($name, $args);
    $pt->init();
  }

  static function register_taxonomy($name, $args) {
    $tx = new H_Taxonomy($name, $args);
    $tx->init();
  }

  static function register_columns($name, $args) {
    $pc = new H_PostColumn($name, $args);
    $pc->init();
  }

  // ----- ACTIONS -----

  static function add_actions($post_type, $args) {
    $pa = new H_PostAction($post_type, $args);
    $pa->add();
  }

  static function replace_actions($post_type, $args) {
    $pa = new H_PostAction($post_type, $args);
    $pa->replace();
  }

  // ----- MENU -----

  static function remove_menu($list) {
    $menu = new H_Menu($list);
    $menu->remove();
  }

  static function add_menus($args) {
    $menu = new H_Menu($args);
    $menu->add();
  }

  static function add_menu($title, $args) {
    $new_args = array(
      $title => $args
    );
    H::add_menus($new_args);
  }

  static function add_submenu($parent_title, $args) {
    $new_args = array(
      $parent_title => array(
        'position' => "on $parent_title",
        'submenu' => $args
      )
    );
    H::add_menus($new_args);
  }

  static function add_menu_counter($parent_title, $count_function) {
    $new_args = array(
      $parent_title => array(
        'position' => "on $parent_title",
        'counter' => $count_function,
      )
    );

    H::add_menus($new_args);
  }
}

// ---------------
// Github updater
// ---------------

// add_action('admin_init', 'h_updater');
function h_updater() {
  require_once 'updater.php';

  $plugin_repo = 'hrsetyono/edje-wp';
  $config = array(
    'slug' => plugin_basename(__FILE__),
    'proper_folder_name' => 'edje-wp',
    'api_url' => "https://api.github.com/repos/$plugin_repo",
    'raw_url' => "https://raw.github.com/$plugin_repo/master",
    'github_url' => "https://github.com/$plugin_repo",
    'zip_url' => "https://github.com/$plugin_repo/archive/master.zip",
    'sslverify' => true,
    'requires' => '4.4.0',
    'tested' => '4.5.0',
    'readme' => 'README.md',
    'access_token' => '', // for private repo, authorize under Appearance > Github Update
   );
   new WP_GitHub_Updater($config);
}
