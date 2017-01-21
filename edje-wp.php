<?php
/*
Plugin Name: Edje WordPress
Description: Library to helps customize WordPress. Designed to work with Timber and Jetpack.
Plugin URI: http://github.com/hrsetyono/edje-wp
Author: The Syne Studio
Author URI: http://thesyne.com/
Version: 0.5.6
*/

// exit if accessed directly
if(!defined('ABSPATH') ) { exit; }

// Constant
define('H_URL', plugin_dir_url(__FILE__) );
define('H_BASE', basename(dirname(__FILE__) ).'/'.basename(__FILE__) );

require_once 'vendor/all.php';
require_once 'lib/all.php';
require_once 'post-type/all.php';
require_once 'seo/all.php';

/*
  Main portal for calling all static methods
*/
class H {
  function __construct() {

  }

  ///// POST TYPE

  static function register_post_type($name, $args = array() ) {
    $pt = new H_PostType($name, $args);
    $pt->init();
  }

  static function register_taxonomy($name, $args) {
    $tx = new H_Taxonomy($name, $args);
    $tx->init();
  }

  static function register_columns($name, $args) {
    if(!is_admin() ) { return false; }

    $pc = new H_PostColumn($name, $args);
    $pc->init();
  }

  ///// ACTIONS - TODO: still not working

  static function add_actions($post_type, $actions) {
    if(!is_admin() ) { return false; }

    $pa = new H_PostAction($post_type, $actions);
    $pa->add();
  }

  static function replace_actions($post_type, $actions) {
    if(!is_admin() ) { return false; }

    $pa = new H_PostAction($post_type, $actions);
    $pa->replace();
  }

  ///// ADMIN MENU

  static function remove_menu($list) {
    if(!is_admin() ) { return false; }

    $menu = new H_Menu($list);
    $menu->remove();
  }

  static function add_menus($args) {
    if(!is_admin() ) { return false; }

    $menu = new H_Menu($args);
    $menu->add();
  }

  static function add_menu($title, $args) {
    if(!is_admin() ) { return false; }

    $new_args = array(
      $title => $args
    );
    H::add_menus($new_args);
  }

  static function add_submenu($parent_title, $args) {
    if(!is_admin() ) { return false; }

    $new_args = array(
      $parent_title => array(
        'position' => "on $parent_title",
        'submenu' => $args
      )
    );
    H::add_menus($new_args);
  }

  static function add_menu_counter($parent_title, $count_function) {
    if(!is_admin() ) { return false; }

    $new_args = array(
      $parent_title => array(
        'position' => "on $parent_title",
        'counter' => $count_function,
      )
    );

    H::add_menus($new_args);
  }
}