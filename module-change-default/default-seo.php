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

    // If Yoast installed, use its SEO tag
    if( \_H::is_plugin_active('tsf') || \_H::is_plugin_active('yoast') ) {
      add_filter('jetpack_enable_open_graph', '__return_false');
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
