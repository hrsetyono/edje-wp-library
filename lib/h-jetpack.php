<?php
/*
  Modify Jetpack modules
*/

if(is_plugin_active('jetpack/jetpack.php') ) {
  new H_Jetpack();
}

class H_Jetpack {

  function __construct() {
    add_filter('wp', array($this, 'remove_related_posts'), 20);

    // if woocommerce active
    if(is_plugin_active('woocommerce/woocommerce.php') ) {
      add_filter('jetpack_sitemap_post_types', 'add_woocommerce_to_sitemap');
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
}
