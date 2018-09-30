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
    // If Jetpack is installed, use its SEO tag
    elseif( \_H::is_plugin_active('jetpack') ) {
      add_filter( 'wp_title', array($this, 'set_wp_title'), 10, 3 );
      add_filter( 'jetpack_open_graph_tags', array($this, 'jetpack_meta_tags') );
      add_filter( 'jetpack_open_graph_output', array($this, 'jetpack_meta_output') );
    }
    // Else, use custom SEO tag
    else {
      add_filter( 'wp_title', array($this, 'set_wp_title'), 10, 3 );
      add_action( 'wp_head', array($this, 'add_seo_tag'), 2 );
    }

  }

  /*
    Modify "title" tag in head

    @filter wp_title

    @param string $title - Current title
    @param string $sep - Separator
    @param string $seplocation
    @return string - Modified title
  */
  function set_wp_title($title, $sep, $seplocation) {
    // use site name if on front+posts page
    if( is_front_page() && is_home() ) {
      return get_bloginfo();
    }
    // use frontpage title if on frontpage
    elseif( is_front_page() ) {
      global $post;
      return $post->post_title;
    }
    // reposition the tax name
    elseif( is_tax() ) {
      $term_title = single_term_title( '', false );
      $tax = get_taxonomy( get_query_var('taxonomy') );

      $title = $term_title . ' - ' . $tax->labels->singular_name;

      return $title . ' | ' . get_bloginfo();
    }
    // use post title + site name if on other page
    else {
      return $title . ' | ' . get_bloginfo();
    }
  }

  /*
    Add custom SEO tag
    @filter wp_head
  */
  function add_seo_tag() {
    global $post;
    $description = '';

    // if not front page, use excerpt from content
    if( !is_front_page() && $post ) {
      $excerpt = $post->post_excerpt ? $post->post_excerpt : \_H::trim_content( $post->post_content );
      $description = $excerpt ? $excerpt : $description;
    } else {
      $description = get_bloginfo( 'description' );
    }

    echo "<meta name='description' content='$description'>";
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
    Add a new tag to Jetpack's list. If og:description doesn't exist, do not add any new tag

    @filter jetpack_open_graph_tags
    @param array $tags - Existing list
    @return array - Added list
  */
  function jetpack_meta_tags($tags) {
    if ( isset( $tags['og:description'] ) ) {
      $tags['description'] = $tags['og:description'];
    }
    return $tags;
  }

  /*
    Replace property="description" by name="description" in the new tag.

    @filter jetpack_open_graph_output
    @param string $og_tag - The description tag
    @return string - The modified description tag
  */
  function jetpack_meta_output($og_tag) {
    $og_tag = str_replace( 'property="description"', 'name="description"', $og_tag );
    return $og_tag;
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
