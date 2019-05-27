<?php
/*
Plugin Name: Edje WP Library
Description: Simplify WordPress complicated functions. Designed to work with Timber.
Plugin URI: http://github.com/hrsetyono/edje-wp-library
Author: Pixel Studio
Author URI: https://pixelstudio.id
Version: 3.1.5
*/

if( !defined( 'WPINC' ) ) { die; } // exit if accessed directly

// Constant
define( 'H_VERSION', '3.1.4' );
define( 'H_URL', plugin_dir_url(__FILE__) );
define( 'H_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'H_BASE', basename(dirname(__FILE__) ).'/'.basename(__FILE__) );


if( !class_exists('Edje_WP_Library') ):
  
class Edje_WP_Library {
  function __construct() {
    add_action( 'plugins_loaded' , [$this, 'load_modules'] );

    // Run activation hook only if EDJE is set to true in wp-config.
    if( defined( 'EDJE' ) ) {  
      require_once 'activation-hook.php';
      register_activation_hook( H_BASE, [$this, 'register_activation_hook'] );
    }
  }

  /**
   * Load all modules
   * @action plugins_loaded
   */
  function load_modules() {
    $this->module_helper();
    $this->module_post_type();
    $this->module_customizer();
    $this->module_admin_sidenav();
    $this->module_vendor();
    $this->module_gutenberg();

    $this->module_modify();
  }

  /**
   * Register activation and deactivation hook
   */
  function register_activation_hook() {
    $hook = new H_Hook();
    $hook->on_activation();
  }

  //

  private function module_helper() {
    require_once 'module-helper/h-helper.php';
    require_once 'module-helper/custom-shortcode.php';
    new H_Shortcode();

    if( class_exists('Timber') ) {
      require_once 'module-helper/twig-helper.php';
      new \h\Twig_Helper();
    }
  }


  private function module_post_type() {
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

  /**
   * Gutenberg modules
   */
  private function module_gutenberg() {
    require_once 'module-gutenberg/mod.php';
    new \h\Modify_Gutenberg();

    add_action( 'template_redirect', function() {
      // if post content
      if( is_single() || is_page() ) {
        require_once 'module-gutenberg/block-more.php';
        new \h\Block_More();

        // require_once 'module-gutenberg/block-pagebreak.php';
        // new \h\Block_Pagebreak();
      }
    } );
  }


  private function module_vendor() {
    require_once 'module-vendor/inflector.php';
    require_once 'module-vendor/parsedown.php';
  }


  private function module_modify() {
    // admin
    if( is_admin() ) {
      require_once 'module-modify/admin.php';
      new \h\Modify_Admin();

      if( defined('DISALLOW_FILE_EDIT') && !DISALLOW_FILE_EDIT ) {
        require_once 'module-modify/code-editor.php';
        new \h\Modify_Code_Editor();
      }
    }
    // frontend
    else {
      require_once 'module-modify/login.php';
      require_once 'module-modify/head-footer.php';
      require_once 'module-modify/seo.php';

      new \h\Modify_Login();
      new \h\Modify_Head_Footer();
      new \h\Modify_SEO();

      if( _H::is_plugin_active('jetpack') ) {
        require_once 'module-modify/jetpack.php';
        new \h\Modify_Jetpack();
      }
    }

    // both
    require_once 'module-modify/adminbar.php';
    new \h\Modify_Adminbar();
  }
}

new Edje_WP_Library();
endif;


/////

if( !class_exists('H') ):
/**
 * Portal for all H's shortcut methods
 */
class H {
  /// POST TYPE

  /**
   * Register Custom Post Type (CPT)
   */
  static function register_post_type( string $name, array $args = [] ) {
    require_once 'module-post-type/post-type.php';

    $pt = new \h\Post_Type( $name, $args );
    $pt->register();
  }

  /**
   * Register Custom Taxonomy
   */
  static function register_taxonomy( string $name, array $args ) {
    require_once 'module-post-type/taxonomy.php';

    $tx = new \h\Taxonomy( $name, $args );
    $tx->register();
  }


  /// GUTENBERG

  /**
   * Register ACF Block, only usable in action "acf/init"
   * - After that, you need to set a Field Group to be displayed when Block is equal to this.
   */
  static function register_block( string $name, array $args ) {
    if( !function_exists('acf_register_block') ) { return; }
    require_once 'module-gutenberg/acf-blocks.php';

    $block = new \h\ACF_Block( $name, $args );
    $block->register();
  }

  /**
   * Register ACF Block for Post Listing
   * - You need to create a TWIG file in views/blocks named `h-$pt-list.twig`. Replace $pt with post type
   * - In the template, you can use `posts` object to loop through.
   */
  static function register_post_block( string $post_type ) {
    if( !function_exists('acf_register_block') ) { return; }
    require_once 'module-gutenberg/block-acf-post-list.php';

    $block = new \h\Block_Post_List( $post_type );
    $block->register();
  }


  /**
   * Output CSS classes for Gutenberg palette
   * 
   * @return array - Formatted colors array suitable for theme_support.
   */
  static function register_colors( array $colors ) : array {
    // output the style in head
    add_action( 'wp_head', function() use ( $colors ) {
      $styles = '<style>';
      foreach( $colors as $c ) {
        $styles .= ".has-$c-background-color { --bgColor: var(--$c); }";
        $styles .= ".has-$c-color { --textColor: var(--$c); }";
      }
      $styles .= '</style>';
      
      echo $styles;
    } );

    // format the array
    $parsed_colors = [];
    foreach( $colors as $name => $slug ) {
      $parsed_colors[] = [
        'name' => $name,
        'slug' => $slug,
        'color' => "var(--$slug)"
      ];
    }

    return $parsed_colors;
  }

  //// POST TABLE

  /**
   * Override all columns in the Post Type table with this one.
   */
  static function override_columns( string $post_type, array $args ) {
    if( !is_admin() ) { return; }

    $pc = new \h\Post_Column();
    $pc->override( $post_type, $args );
  }

  /**
   * Alias for H::override_columns
   */
  static function register_columns( string $post_type, array $args ) {
    self::override_columns( $post_type, $args );
  }

  
  /**
   * Append a column to the Post Type table
   * 
   * @param string $post_type
   * @param $args - Column keywords or arguments with callable
   */
  static function add_column( string $post_type, $args ) {
    if( !is_admin() ) { return; }

    $pc = new \h\Post_Column();
    $pc->add( $post_type, $args );
  }


  /// ACTIONS - TODO: still not working

  static function add_actions( $post_type, $actions ) {
    if( !is_admin() ) { return; }

    $pa = new \h\Post_Action( $post_type, $actions );
    $pa->add();
  }

  static function replace_actions( $post_type, $actions ) {
    if( !is_admin() ) { return false; }

    $pa = new \h\Post_Action( $post_type, $actions );
    $pa->replace();
  }


  ///// ADMIN SIDENAV

  /**
   * Remove sidenav link
   * 
   * @deprecated Needs rework to be easier to use
   */
  static function remove_menu( array $args ) {
    if( !is_admin() ) { return; }

    $menu = new \h\Sidenav( $args );
    $menu->remove();
  }

  /**
   * Add menu links in sidebar
   * 
   * @deprecated Needs rework to be easier to use
   */
  static function add_menus( array $args ) {
    if( !is_admin() ) { return; }

    $menu = new \h\Sidenav( $args );
    $menu->add();
  }

  /**
   * Add a menu link in sidebar. Alias for H::add_menus but only for 1 link.
   */
  static function add_menu( string $title, array $args ) {
    H::add_menus( [
      $title => $args
    ] );
  }

  /**
   * Add a submenu in sidebar
   * 
   * @deprecated Needs rework to be easier to use
   */
  static function add_submenu( string $parent_title, array $args ) {
    H::add_menus( [
      $parent_title => [
        'position' => "on $parent_title",
        'submenu' => $args
      ]
    ] );
  }

  /**
   * Add a number counter beside the sidebar's menu link
   * 
   * @param Callable():int $get_number
   */
  static function add_menu_counter( string $parent_title, Callable $get_number ) {
    H::add_menus( [
      $parent_title => [
        'position' => "on $parent_title",
        'counter' => $get_number,
      ]
    ] );
  }



  /// CUSTOMIZER

  /**
   * Inititate Edje customizer object. Only use this in "customize_register" action.
   */
  static function customizer( WP_Customize_Manager $wp_customize ) {
    return new \h\Customizer( $wp_customize );
  }


  ///// WEB PUSH

  /**
   * @deprecated Too complicated, just use plugin like "Subscribers.com"
   */
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