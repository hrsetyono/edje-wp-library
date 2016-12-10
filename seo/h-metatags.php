<?php
/*
*  Outputs extra meta tags for SEO purposes.
*/

new H_SEO_Meta();
class H_SEO_Meta {
  function __construct() {
    add_filter('wp_title', array($this, 'set_wp_title'), 10, 3);

    if(is_plugin_active('jetpack/jetpack.php') ) {
      add_filter('jetpack_open_graph_tags', array($this, 'jetpack_meta_tags') );
      add_filter('jetpack_open_graph_output', array($this, 'jetpack_meta_output') );
    }
    else {
      add_action('wp_head', array($this, 'custom_meta_tags'), 2);
    }

    // remove extra rss
    remove_action('wp_head', 'feed_links', 2 );
    remove_action('wp_head', 'feed_links_extra', 3 );

    // prevent url guessing
    add_filter('redirect_canonical', array($this, 'redirect_canonical') );
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
    if(is_front_page() && is_home() ) {
      return get_bloginfo();
    }
    // use frontpage title if on frontpage
    elseif(is_front_page() ) {
      global $post;
      return $post->post_title;
    }
    // reposition the tax name
    elseif(is_tax() ) {
      $term_title = single_term_title('', false);
      $tax = get_taxonomy(get_query_var('taxonomy') );

      $title = $term_title . ' - ' . $tax->labels->singular_name;

      return $title . ' | ' . get_bloginfo();
    }
    // use post title + site name if on other page
    else {
      return $title . ' | ' . get_bloginfo();
    }
  }

  /*
    Add description meta tag

    @filter wp_head
  */
  function custom_meta_tags() {
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
    if (is_404() ) { return false; }
    return $url;
  }
}
