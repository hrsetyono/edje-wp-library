<?php
/*
  Modify Jetpack modules
*/

if(H_elper::is_plugin_active('jetpack') ) {
  new H_Jetpack();
}

class H_Jetpack {

  function __construct() {
    add_filter('wp', array($this, 'remove_related_posts'), 20);
    add_action('wp_head', array($this, 'enqueue_script'), 1);

    // add woocommerce to sitemap
    if(H_elper::is_plugin_active('woocommerce') ) {
      add_filter('jetpack_sitemap_post_types', array($this, 'add_woocommerce_to_sitemap') );
    }
  }

  /*
    Remove Jetpack Related Post from default position

    @filter wp
  */
  function remove_related_posts() {
    if(class_exists('Jetpack_RelatedPosts') ) {
      $jprp = Jetpack_RelatedPosts::init();
      $callback = array($jprp, 'filter_add_target_to_dom');
      remove_filter('the_content', $callback, 40);
    }
  }

  /*
    Add WooCommerce's product to Sitemap

    @filter jetpack_sitemap_post_types
    @param array $post_types
    @return array
  */
  function add_woocommerce_to_sitemap($post_types) {
    $post_types[] = 'product';
    return $post_types;
  }

  /*
    Enqueue additional script when Jetpack is active
  */
  function enqueue_script() {
    // add social logos in all pages
    wp_enqueue_style('social-logos');
  }
}
