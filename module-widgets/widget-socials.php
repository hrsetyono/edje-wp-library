<?php

/**
 * 
 */
class H_Widget_Socials extends H_Widget {
  function __construct() {
    parent::__construct( 'h_socials', __( '- Socials' ), [
      'description' => __( 'Social Media links' )
    ] );
  }

  function widget( $args, $instance ) {
    $id = $args['widget_id'];

    $items = get_field( 'links', "widget_$id" );
    $title = get_field( 'title', "widget_$id" );
    $title = $title ? $args['before_title'] . $title . $args['after_title'] : '';

    // for extra classes
    $style = get_field( 'style', "widget_$id" );
    $color = get_field( 'color', "widget_$id" );
    $size = get_field( 'size', "widget_$id" );

    $extra_classes = "is-style-{$style} has-{$size}-icon-size has-{$color}-color";

    // Output list of icons
    $icons = '';
    foreach( $items as $i ) {
      $name = $i['icon'];
      $classes = "wp-social-link wp-block-social-link wp-social-link-{$name}";

      $data = H::get_social_icon( $name );
      $svg = $data['svg'];
      // $color = $data['color'];
      $url = $i['link']['url'] ?? '';
      $title = $i['link']['title'] ?? '';

      if( !empty( $title ) ) {
        $svg .= " <span> {$title} </span>";
        $classes .= ' has-label';
      }

      $icons .= "<li class='{$classes}'>
        <a class='wp-block-social-link-anchor' href='{$url}' target='_blank' rel='noopener nofollow'>
          {$svg}
        </a>
      </li>";
    }

    // Output content
    $content = $args['before_widget'] .
      $title .
      "<ul class='wp-block-social-links {$extra_classes}'> {$icons} </ul>" .
    $args['after_widget'];

    $content = apply_filters( 'h_widget_socials', $content, $args );
    echo $content;
  }
}