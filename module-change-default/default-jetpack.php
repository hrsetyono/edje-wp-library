<?php namespace h;
/*
  Modify Jetpack modules
*/
class Default_Jetpack {
  function __construct() {
    // if jetpack not installed
    if( !\_H::is_plugin_active('jetpack') ) { return false; }

    add_action( 'init', array($this, 'init') );

    add_action( 'wp_head', array($this, 'wp_head'), 2 );
    add_action( 'wp_footer', array($this, 'wp_footer') );
    add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts') );

    // disable jetpack css
    add_filter( 'jetpack_implode_frontend_css', '__return_false' );
  }

  function init() {
    add_filter( 'wp', array($this, 'remove_related_posts'), 20 );

    // add woocommerce to sitemap
    if( \_H::is_plugin_active('woocommerce') ) {
      add_filter( 'jetpack_sitemap_post_types', array($this, 'add_woocommerce_to_sitemap') );
    }
  }

  /*
    Remove Jetpack Related Post from default position
    @filter wp
  */
  function remove_related_posts() {
    if( class_exists('Jetpack_RelatedPosts') ) {
      $jprp = \Jetpack_RelatedPosts::init();
      $callback = array( $jprp, 'filter_add_target_to_dom' );
      remove_filter( 'the_content', $callback, 40 );
    }
  }

  /*
    Add WooCommerce's product to Sitemap

    @filter jetpack_sitemap_post_types
    @param array $post_types
    @return array
  */
  function add_woocommerce_to_sitemap( $post_types ) {
    $post_types[] = 'product';
    return $post_types;
  }

  /*
    Remove redundant JS and CSS
    @action wp_head 2
  */
  function wp_head() {
    wp_dequeue_script( 'devicepx' );
    wp_dequeue_style( 'sharedaddy' );
  }

  /*
    Enqueue additional JS and CSS
    @action wp_enqueue_scripts
  */
  function enqueue_scripts() {
    wp_enqueue_style( 'social-logos' );  // add social logos in all pages
    wp_enqueue_style( 'h-jetpack', H_URL . '/assets/css/h-jetpack.css' );

    wp_enqueue_script( 'h-jetpack', H_URL . '/assets/js/h-jetpack.js', array('jquery'), false, true );
  }

  /*
    Remove redundant CSS and JS
    @action wp_footer
  */
  function wp_footer() {
    wp_dequeue_style( 'jetpack-responsive-videos-style' );
    wp_dequeue_script( 'jetpack-responsive-videos-script' );

    wp_deregister_script( 'sharing-js' );

    // disable spinner when infinite loading is enabled
    wp_deregister_script( 'jquery.spin' );
    wp_deregister_script( 'spin' );
  }
}
