<?php namespace h;
/*
*  Outputs extra meta tags for SEO purposes.
*/

class Default_SEO {
  function __construct() {
    // remove extra rss
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'feed_links_extra', 3 );

    // prevent url guessing
    add_filter('redirect_canonical', array($this, 'redirect_canonical') );

    // add theme_color tag
    add_action( 'wp_head', array($this, 'add_color_tag'), 2 );

    // If Yoast installed, use its SEO tag
    if( \_H::is_plugin_active('tsf') || \_H::is_plugin_active('yoast') ) {
      add_filter('jetpack_enable_open_graph', '__return_false');
    }
  }

  /*
    Add custom meta tag
    @filter wp_head
  */
  function add_color_tag() {
    $color = get_background_color();
    if( $color ) {
      echo "<meta name='theme-color' content='#$color'>";
    }
  }

  /*
    Prevent URL guessing

    @filter redirect_canonical
  */
  function redirect_canonical($url) {
    if( is_404() ) { return false; }
    return $url;
  }
}
