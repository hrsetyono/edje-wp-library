<?php

add_shortcode( 'button', '_h_shortcode_button' );
add_shortcode( 'h-related-posts', '_h_shortcode_related_posts' );
add_shortcode( 'h-jetpack-sharing', '_h_shortcode_jetpack_sharing' );


/**
 * Add button class to the link inside
 *   [button $class1 $class2] link [/button]
 * 
 * @atts $class1 (string, optional) - Extra class name
 * @atts $class2 (string, optional)
 */
function _h_shortcode_button( $atts, $content = null ) {
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
function _h_shortcode_related_posts( $atts, $content = null ) {
  global $post;

  $atts = shortcode_atts([
    'count' => '3'
  ], $atts);

  $context = [
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
function _h_shortcode_jetpack_sharing() {
  if ( function_exists( 'sharing_display' ) ) {
    sharing_display( '', true );
  }
  
  if ( class_exists( 'Jetpack_Likes' ) ) {
    $custom_likes = new Jetpack_Likes;
    echo $custom_likes->post_likes( '' );
  }
}