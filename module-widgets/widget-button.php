<?php

/**
 * Button widget
 */
class H_Widget_Button extends H_Widget { 
  function __construct() {
    parent::__construct( 'h_button', __( '- Button' ), [
      'description' => __( 'Create a Button' )
    ] );
  }

  function widget( $args, $instance ) {
    $id = $args['widget_id'];

    $link = get_field( 'link', "widget_$id" );
    $style = get_field( 'style', "widget_$id" );
    $icon = get_field( 'icon', "widget_$id" );

    // Get Link data
    $url = $link['url'] ?? '';
    $target = $link['target'] ?? '_self';
    $title = empty( $link['title'] ) ? '' : '<span>' . $link['title'] . '</span>';
    
    $content = $args['before_widget'] .
      "<div class='wp-block-button is-style-{$style}'>
        <a class='wp-block-button__link' href='{$url}' target='{$target}'>
          {$icon} {$title}
        </a>
      </div>" .
    $args['after_widget'];

    $content = apply_filters( 'h_widget_button', $content, $args );
    echo $content;
  }
}