<?php
/*
  Add SEO metabox on the side
*/

new H_SEO_Metabox();
class H_SEO_Metabox {

  function __construct() {
    add_action('admin_init', array($this, 'add_meta_boxes') );
  }

  /*
    Create SEO Sidebox on all post edit

    @filter admin_init
  */
  function add_meta_boxes() {
    $post_types = array_reduce(get_post_types(), function($result, $i) {
      // exclude some post types, especially from WooCommerce
      $exclude = array('attachment', 'revision', 'nav_menu_item', 'product_variation', 'shop_order', 'shop_order_refund', 'shop_coupon', 'shop_webhook');
      if(in_array($i, $exclude) ) {
        return $result;
      } else {
        $result[] = $i;
        return $result;
      }
    }, array() );

    add_meta_box('h-seo', __('SEO', 'h'), array($this, 'add_seo_box'), $post_types, 'side', 'low');
  }

  /*
    Add SEO metabox on the sidebar

    @param mixed $posst - WP_Post object
  */
  function add_seo_box($post) {
    echo "<p><strong>Description</strong></p>";
    echo "<textarea name='excerpt' rows='4'></textarea>";
  }

}
