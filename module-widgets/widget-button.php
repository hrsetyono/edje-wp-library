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
    $content = '';
    $id = $args['widget_id'];

    $link = get_field( 'link', "widget_$id" );
    $icon = get_field( 'icon', "widget_$id" );
    $extra_classes = get_field( 'extra_classes', "widget_$id" );

    $content = "<a href='{$link['url']}' class='button {$extra_classes}' target='{$link['target']}'>
      {$icon} <span>{$link['title']}</span>
    </a>";

    $content = apply_filters( 'h_widget_button', $content, $args );
    echo $args['before_widget'] . $content . $args['after_widget'];
  }
}