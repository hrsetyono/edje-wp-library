<?php
/*
Plugin Name: Edje WP Library
Description: Simplify WordPress complicated functions. Designed to work with Timber.
Plugin URI: http://github.com/hrsetyono/edje-wp-library
Author: Pixel Studio
Author URI: https://pixelstudio.id
Version: 2.0.0
*/

if( !defined( 'WPINC' ) ) { die; } // exit if accessed directly

// Constant
define( 'H_VERSION', '2.0.0' );
define( 'H_URL', plugin_dir_url(__FILE__) );
define( 'H_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'H_BASE', basename(dirname(__FILE__) ).'/'.basename(__FILE__) );



if( !class_exists('Edje_WP_Library') ):
class Edje_WP_Library {
  function __construct() {
    $this->load_modules();
    $this->register_activation_hook();
  }

  /*
    Load all modules
  */
  private function load_modules() {
    add_action( 'plugins_loaded' , function() {
      $this->module_helper();
      $this->module_post_type();
      $this->module_customizer();
      $this->module_admin_sidenav();
      $this->module_change_default();
      $this->module_vendor();
    } );
  }

  /*
    Register activation and deactivation hook
  */
  private function register_activation_hook() {
    if( defined( 'EDJE' ) ) { 
      require_once 'activation-hook.php';

      register_activation_hook( H_BASE, ['H_Hook', 'activation_hook'] );
      register_deactivation_hook( H_BASE, ['H_Hook', 'deactivation_hook'] );
    }
  }

  //

  private function module_helper() {
    require_once 'module-helper/h-helper.php';

    // only if not in admin
    if( !is_admin() ) {
      require_once 'module-helper/h-shortcode.php';
      new H_Shortcode();
    }

    // If Timber is activated
    if( class_exists('Timber') ) {
      require_once 'module-helper/h-twig.php';
      require_once 'module-helper/timber-block.php';

      new H_Twig();
    }
  }


  private function module_post_type() {
    require_once 'module-post-type/post-type.php';
    require_once 'module-post-type/taxonomy.php';

    if( is_admin() ) {
      require_once 'module-post-type/post-column.php';
      require_once 'module-post-type/post-filter.php';
      require_once 'module-post-type/post-action.php';
    }
  }

  
  private function module_customizer() {
    require_once 'module-customizer/customizer.php';
    require_once 'module-customizer/customizer-default.php';

    new \h\Customizer_Default();
  }


  private function module_admin_sidenav() {
    if( is_admin() ) {
      require_once 'module-admin-sidenav/sidenav.php';
      require_once 'module-admin-sidenav/sidenav-sub.php';
    }    
  }


  private function module_change_default() {
    require_once 'module-change-default/default-public.php';
    new \h\Default_Public();

    // if in admin
    if( is_admin() ) {
      require_once 'module-change-default/default-codemirror.php';
      require_once 'module-change-default/default-admin.php';
      new \h\Default_Admin();
      new \h\Default_Codemirror();
    }
    // if not in admin
    else {
      require_once 'module-change-default/default-jetpack.php';
      require_once 'module-change-default/default-seo.php';
      new \h\Default_Jetpack();
      new \h\Default_SEO();
    }
  }


  private function module_vendor() {
    require_once 'module-vendor/inflector.php';
    require_once 'module-vendor/parsedown.php';
  }
}

new Edje_WP_Library();
endif;


/////


/*
  Main portal for calling all static methods
*/
if( !class_exists('H') ):
class H {
  /*
    Register custom post type
  */
  static function register_post_type( string $name, array $args = [] ) {
    $pt = new \h\Post_Type( $name, $args );
    $pt->register();
  }

  /*
    Register custom taxonomy
  */
  static function register_taxonomy( string $name, array $args ) {
    $tx = new \h\Taxonomy( $name, $args );
    $tx->register();
  }


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
    $new_args = [
      $title => $args
    ];

    H::add_menus( $new_args );
  }

  static function add_submenu( $parent_title, $args ) {
    H::add_menus( [
      $parent_title => [
        'position' => "on $parent_title",
        'submenu' => $args
      ]
    ] );
  }

  static function add_menu_counter( $parent_title, $count_cb ) {
    H::add_menus( [
      $parent_title => [
        'position' => "on $parent_title",
        'counter' => $count_cb,
      ]
    ] );
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