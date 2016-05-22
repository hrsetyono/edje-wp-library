<?php

class H_SEO {
  function __construct() {
    add_filter('wp_title', array($this, 'set_wp_title'), 100);
    add_action('wp_head', array($this, 'add_meta_tags'), 2);

    // remove extra rss
    remove_action('wp_head', 'feed_links', 2 );
    remove_action('wp_head', 'feed_links_extra', 3 );

    // prevent url guessing
    add_filter('redirect_canonical', array($this, 'redirect_canonical') );
  }

  function set_wp_title($title) {
    // use frontpage title on home
    if(is_front_page() ) {
      global $post;
      return $post->post_title;
    }

    return $title . ' | ' . get_bloginfo();
  }

  /*
    Add SEO Meta tags for description, open graph, and twitter card
  */
  function add_meta_tags() {
    global $post;

    $content = get_bloginfo('description');
    $title = $post->post_title;
    $site_name = get_bloginfo('name');

    $thumbnail = has_post_thumbnail() ? wp_get_attachment_url(get_post_thumbnail_id($post->ID) ) : '';

    // if not front page, use excerpt from content
    if(!is_front_page() ) {
      $excerpt = $post->post_excerpt ? $post->post_excerpt : H_Elper::trim_content($post->post_content);
      $content = $excerpt ? $excerpt : $content;
    }

    echo "<meta name='description' content='$content'>";

    echo "<meta property='og:type' content='article'>";
    echo "<meta property='og:title' content='$title'>";
    echo "<meta property='og:site_name' content='$site_name'>";
    echo "<meta property='og:description' content='$content'>";
    if($thumbnail) { echo "<meta property='og:image' content='$thumbnail'>"; }

    echo "<meta name='twitter:card' value='summary'>";
    echo "<meta name='twitter:title' content='$title'>";
    echo "<meta name='twitter:description' content='$content'>";
    if($thumbnail) { echo "<meta name='twitter:image' content='$thumbnail'>"; }

    // echo "<meta name='twitter:site' content='@publisher_handle'>";
    // echo "<meta name='twitter:creator' content='@author_handle'>";
  }

  function redirect_canonical($url) {
    if (is_404() ) { return false; }
    return $url;
  }
}
