<?php

/**
 * 
 */
class H_Widget_Recent_Posts extends H_Widget { 
  function __construct() {
    parent::__construct( 'h_recent_posts', __( '- Recent Posts' ), [
      'description' => __( 'Show latest posts' )
    ] );
  }

  function widget( $args, $instance ) {
    $id = $args['widget_id'];

    $number_of_posts = get_field( 'number_of_posts', "widget_$id" );
    $style = get_field( 'style', "widget_$id" );
    $title = get_field( 'title', "widget_$id" );
    $title = $title ? $args['before_title'] . $title . $args['after_title'] : '';

    // get posts
    $posts = get_posts([
      'posts_per_page' => $number_of_posts,
    ]);

    // output posts
    $list = '';
    foreach( $posts as $p ) {
      $link = get_permalink( $p );
      $title = $p->post_title;
      $thumbnail = in_array( 'show_thumbnail', $style )
        ? "<div class='wp-block-latest-posts__featured-image alignright'><a href='{$link}'>" . get_the_post_thumbnail( $p, 'thumbnail' ) . "</a></div>" : '';
      
      $date = in_array( 'show_date', $style )
        ? '<time class="wp-block-latest-posts__post-date">' . get_the_date( '', $p ) . '</time>' : '';

      $author = in_array( 'show_author', $style )
        ? '<div class="wp-block-latest-posts__post-author">' . get_the_author_meta( 'display_name', $p->post_author ) . '</div>' : '';

      $list .= "<li>
        {$thumbnail}
        <a href='{$link}'>{$title}</a>
        {$author} {$date}
      </li>";
    }

    // output title
    $content = $args['before_widget'] .
      $title .
      "<ul class='wp-block-latest-posts__list columns-1 wp-block-latest-posts'> $list </ul>" .
    $args['after_widget'];

    $content = apply_filters( 'h_widget_recent_posts', $content, $args );
    echo $content;
  }
}