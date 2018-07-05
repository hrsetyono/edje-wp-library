<?php
/*
Plugin Name: WordPress Edje
Description: Library to helps customize WordPress. Designed to work with Timber and Jetpack.
Plugin URI: http://github.com/hrsetyono/edje-wp
Author: The Syne Studio
Author URI: http://thesyne.com/
Version: 0.9.0
*/

// exit if accessed directly
if( !defined('ABSPATH') ) { exit; }

// Constant
define( 'H_VERSION', '0.8.1' );
define( 'H_URL', plugin_dir_url(__FILE__) );
define( 'H_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'H_BASE', basename(dirname(__FILE__) ).'/'.basename(__FILE__) );

run_wp_edje();

function run_wp_edje() {
  require_once 'module-helper/_run.php';

  require_once 'module-seo/_run.php';
  require_once 'module-post-type/_run.php';
  require_once 'module-customizer/_run.php';
  require_once 'module-admin-sidepanel/_run.php';
  require_once 'module-change-default/_run.php';

  require_once 'admin/h-on-activate.php';
  new H_OnActivate();
}


/////

/*
  Main portal for calling all static methods
*/
class H {
  function __construct() {

  }

  ///// POST TYPE

  static function register_post_type( $name, $args = array() ) {
    $pt = new \h\Post_Type( $name, $args );
    $pt->init();
  }

  static function register_taxonomy( $name, $args ) {
    $tx = new \h\Taxonomy( $name, $args );
    $tx->init();
  }

  static function register_columns( $name, $args ) {
    if( !is_admin() ) { return false; }

    $pc = new \h\Post_Column( $name, $args );
    $pc->init();
  }

  ///// ACTIONS - TODO: still not working

  static function add_actions( $post_type, $actions ) {
    if( !is_admin() ) { return false; }

    $pa = new \h\Post_Action( $post_type, $actions );
    $pa->add();
  }

  static function replace_actions( $post_type, $actions ) {
    if( !is_admin() ) { return false; }

    $pa = new \h\Post_Action( $post_type, $actions );
    $pa->replace();
  }


  ///// WEB PUSH

  static function send_push( $payload, $target = null ) {
    if( !class_exists('H_WebPush') ) {
      throw new Exception("Edje Web-Push plugin hasn't been installed.");
      return false;
    }

    $push = new \h\WebPush_Send();
    $push->send( $payload, $target );
  }



  ///// ADMIN MENU

  static function remove_menu( $args ) {
    if(!is_admin() ) { return false; }

    $menu = new \h\Sidepanel( $args );
    $menu->remove();
  }

  static function add_menus( $args ) {
    if(!is_admin() ) { return false; }

    $menu = new \h\Sidepanel( $args );
    $menu->add();
  }

  static function add_menu($title, $args) {
    if(!is_admin() ) { return false; }

    $new_args = array(
      $title => $args
    );
    H::add_menus( $new_args );
  }

  static function add_submenu( $parent_title, $args ) {
    if(!is_admin() ) { return false; }

    $new_args = array(
      $parent_title => array(
        'position' => "on $parent_title",
        'submenu' => $args
      )
    );
    H::add_menus( $new_args );
  }

  static function add_menu_counter($parent_title, $count_function) {
    if(!is_admin() ) { return false; }

    $new_args = array(
      $parent_title => array(
        'position' => "on $parent_title",
        'counter' => $count_function,
      )
    );

    H::add_menus( $new_args );
  }


  ///// CUSTOMIZER

  /*
    Inititate Edje customizer object
    @param obj $wp_customize - WP_Customize object from customize_register action.
  */
  static function customizer( $wp_customize ) {
    return new \h\Customizer( $wp_customize );
  }
}
