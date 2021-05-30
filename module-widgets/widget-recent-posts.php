<?php

/**
 * 
 */
class H_Widget_Recent_Posts extends H_Widget { 
  function __construct() {
    parent::__construct( 'h_recent_posts', __( 'Recent Posts' ), [
      'description' => __( 'Show latest posts' )
    ] );
  }

  function widget( $args, $instance ) {
    $content = '';
    $id = $args['widget_id'];

    $title = get_field( 'title', "widget_$id" );
    $number_of_posts = get_field( 'number_of_posts', "widget_$id" );
    $style = get_field( 'style', "widget_$id" );


    // get posts
    $posts = get_posts([
      'posts_per_page' => $number_of_posts,
    ]);

    // output title
    $content .= $args['before_title'] . $title . $args['after_title'];

    // output posts
    $content_posts = '';
    foreach( $posts as $p ) {
      $link = get_permalink( $p );
      $title = $p->post_title;
      $thumbnail = in_array( 'show_thumbnail', $style )
        ? "<div class='wp-block-latest-posts__featured-image'><a href='{$link}'>" . get_the_post_thumbnail( $p, 'thumbnail' ) . "</a></div>" : '';
      
      $date = in_array( 'show_date', $style )
        ? '<time class="wp-block-latest-posts__post-date">' . get_the_date( '', $p ) . '</time>' : '';

      $content_posts .= "<li>
        {$thumbnail}
        <a href='{$link}'>{$title}</a>
        {$date}
      </li>";
    }

    $content .= "<ul class='wp-block-latest-posts__list columns-1 alignwide wp-block-latest-posts'> $content_posts </ul>";

    $content = apply_filters( 'h_widget_recent_posts', $content, $args );
    echo $args['before_widget'] . $content . $args['after_widget'];
  }
}