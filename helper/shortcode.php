<?php

class H_Shortcode {
  function __construct() {
    add_shortcode( 'grid', [$this, 'grid'] );
    add_shortcode( 'button', [$this, 'button'] );

    add_shortcode( 'h-related-posts', [$this, 'related_posts'] );
    add_shortcode( 'h-jetpack-sharing', [$this, 'shortcode_jetpack_sharing'] );
  }

  /*
    Wrap content with Edje's CSS Grid

      [grid $sizes <$state>] ... [/grid] 

    @atts $sizes - Column size between 1 to 12. Can specify mobile column with dash like 8-6 (meaning 8 on desktop, 6 on mobile).
    @atts $state (optional) - Either "start" or "end".

    Example:
      [grid 8-6 start]
        ...
      [/grid] [grid 4-6 end]
        ...
      [/grid]

    Result:
      <h-grid> <div class="large-8 small-6">
        ...
      </div> <div class="large-4 small-6">
        ...
      </div> </h-grid>
  */
  function grid( $atts, $content = null ) {
    $size = $atts[0] ?? '12';
    $state = $atts[1] ?? 'start';

    preg_match( '/^\d+/', $size, $large_size );
    preg_match( '/-(\d+)$/', $size, $small_size );

    // create opening and closing tag
    $opening = $state == 'start' ? '<h-grid>' : '';
    $closing = $state == 'end' ? '</div> </h-grid>' : '</div>';

    // form the column classes
    $classes = "large-$large_size[0]";
    $classes .= isset( $small_size[1] ) ? " small-$small_size[1]" : '';

    return $opening . "<div class='$classes'>" .  do_shortcode($content) . $closing;
  }


  /**
   * Add button class to the link inside
   *   [button $class1 $class2] link [/button]
   * 
   * @atts $class1 (string, optional) - Extra class name
   * @atts $class2 (string, optional)
   */
  function button( $atts, $content = null ) {
    $class1 = $atts[0] ?? '';
    $class2 = $atts[1] ?? '';

    // if have anchor inside, add button class
    if( preg_match( '/<a (.+?)>/', $content, $match ) ) {
      $content = substr_replace( $content, " class='button $class1 $class2' ", 3, 0 );
    }
    // else, make it into do-nothing button
    else {
      $content = "<a class='button'>" . $content . '</a>';
    }

    return $content;
  }


  /**
   * Show Related Posts
   * 
   * [h-related-posts count="3"]
   */
  function related_posts( $atts, $content = null ) {
    global $post;

    $atts = shortcode_atts([
      'count' => '3'
    ], $atts);

    $context = [
      'style' => 'grid',
      'mods' => Custy::get_mods(),
      'posts' => Timber::get_posts([
        'post_type' => 'post',
        'posts_per_page' => $atts['count'],
        'post__not_in' => [ $post->ID ],
        'category__in' => wp_get_post_categories( $post->ID ),
        'orderby' => 'rand'
      ]),
    ];

    return Timber::compile( '_posts.twig', $context );
  }


  /**
   * Display Jetpack's sharing button
   * 
   * [h-jetpack-sharing]
   */
  function shortcode_jetpack_sharing() {
    if ( function_exists( 'sharing_display' ) ) {
      sharing_display( '', true );
    }
    
    if ( class_exists( 'Jetpack_Likes' ) ) {
      $custom_likes = new Jetpack_Likes;
      echo $custom_likes->post_likes( '' );
    }
  }
}