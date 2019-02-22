<?php
/*
Plugin Name: WordPress Edje
Description: Library to helps customize WordPress. Designed to work with Timber and Jetpack.
Plugin URI: http://github.com/hrsetyono/edje-wp
Author: The Syne Studio
Author URI: http://thesyne.com/
Version: 1.0.1
*/

// exit if accessed directly
if( !defined('ABSPATH') ) { exit; }

// Constant
define( 'H_VERSION', '0.9.6' );
define( 'H_URL', plugin_dir_url(__FILE__) );
define( 'H_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'H_BASE', basename(dirname(__FILE__) ).'/'.basename(__FILE__) );

run_wp_edje();

function run_wp_edje() {
  if( !class_exists('Timber') ) { return false; }

  require_once 'module-helper/_run.php';
  require_once 'module-post-type/_run.php';
  require_once 'module-customizer/_run.php';
  require_once 'module-admin-sidenav/_run.php';
  require_once 'module-change-default/_run.php';

  require_once 'admin/h-on-activate.php';
  new H_OnActivate();
}


/////

/*
  Main portal for calling all static methods

  You can find detailed info and examples here: https://github.com/hrsetyono/wp-edje/wiki/
*/
if( !class_exists('H') ):

class H {
  function __construct() {

  }

  ///// POST TYPE

  static function register_post_type( $post_type, $args = array() ) {
    $pt = new \h\Post_Type( $post_type, $args );
    $pt->init();
  }

  static function register_taxonomy( $post_type, $args ) {
    $tx = new \h\Taxonomy( $post_type, $args );
    $tx->init();
  }

  ///// POST COLUMNS

  /*
    Override all columns in the Post Type table with this one

    @param $post_type (string)
    @param $args (array) - List of columns
  */
  static function override_columns( $post_type, $args ) {
    if( !is_admin() ) { return false; }

    $pc = new \h\Post_Column();
    $pc->override( $post_type, $args );
  }

  // Alias for override_columns
  static function register_columns( $post_type, $args ) {
    self::override_columns( $post_type, $args );
  }

  /*
    Append a column to the Post Type table
    @since 0.9.0

    @param $post_type (string).
    @param $title (string) - Column title, or slug of Custom Fields.
    @param $value (function) - Optional. If $title is already slug of custom fields, this can be null.
  */
  static function add_column( $post_type, $title, $value = null ) {
    if( !is_admin() ) { return false; }

    $pc = new \h\Post_Column();
    $pc->add( $post_type, $title, $value );
  }


  ///// ACTIONS
  // TODO: still not working

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


  ///// ADMIN SIDENAV

  static function remove_menu( $args ) {
    if( !is_admin() ) { return false; }

    $menu = new \h\Sidenav( $args );
    $menu->remove();
  }

  static function add_menus( $args ) {
    if( !is_admin() ) { return false; }

    $menu = new \h\Sidenav( $args );
    $menu->add();
  }

  static function add_menu( $title, $args ) {
    $new_args = array(
      $title => $args
    );

    H::add_menus( $new_args );
  }

  static function add_submenu( $parent_title, $args ) {
    H::add_menus( array(
      $parent_title => array(
        'position' => "on $parent_title",
        'submenu' => $args
      )
    ) );
  }

  static function add_menu_counter( $parent_title, $count_cb ) {
    H::add_menus( array(
      $parent_title => array(
        'position' => "on $parent_title",
        'counter' => $count_cb,
      )
    ) );
  }



  ///// CUSTOMIZER

  /*
    Inititate Edje customizer object
    @param $wp_customize (Obj) - WP_Customize object from customize_register action.
  */
  static function customizer( $wp_customize ) {
    return new \h\Customizer( $wp_customize );
  }


  ///// WEB PUSH

  static function send_push( $payload, $target = null ) {
    if( !class_exists('H_WebPush') ) {
      var_dump( 'ERROR: Edje Web-Push plugin is not installed.' );
      return false;
    }

    $push = new \h\WebPush_Send();
    $push->send( $payload, $target );
  }

}

endif; // class_exists