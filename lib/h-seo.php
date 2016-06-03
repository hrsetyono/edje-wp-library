<?php

class H_SEO {
  function __construct() {
    add_filter('wp_title', array($this, 'set_wp_title'), 100);
    add_action('wp_head', array($this, 'add_meta_tags'), 2);

    // add_action('admin_init', array($this, 'add_meta_boxes') );

    // remove extra rss
    remove_action('wp_head', 'feed_links', 2 );
    remove_action('wp_head', 'feed_links_extra', 3 );

    // prevent url guessing
    add_filter('redirect_canonical', array($this, 'redirect_canonical') );
  }

  function set_wp_title($title) {
    // use site name if on front+posts page
    if(is_front_page() && is_home() ) {
      return get_bloginfo();
    }
    // use frontpage title if on frontpage
    elseif(is_front_page() ) {
      global $post;
      return $post->post_title;
    }
    // use post title + site name if on other page
    else {
      return $title . ' | ' . get_bloginfo();
    }
  }

  /*
    Add description meta tag
  */
  function add_meta_tags() {
    global $post;

    $content = get_bloginfo('description');

    // if not front page, use excerpt from content
    if(!is_front_page() && $post) {
      $excerpt = $post->post_excerpt ? $post->post_excerpt : H_Elper::trim_content($post->post_content);
      $content = $excerpt ? $excerpt : $content;
    }

    echo "<meta name='description' content='$content'>";
  }

  /*
    Create SEO Sidebox on all post edit
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

  function add_seo_box($post) {
    echo "<p><strong>Description</strong></p>";
    echo "<textarea name='excerpt' rows='4'></textarea>";
  }

  function redirect_canonical($url) {
    if (is_404() ) { return false; }
    return $url;
  }
}
