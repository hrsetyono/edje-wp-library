<?php

/**
 * 
 */
class H_Widget_Toggle_Offcanvas extends H_Widget { 
  function __construct() {
    parent::__construct( 'h_toggle', __( '- Toggle' ), [
      'description' => __( 'Button to open Offcanvas' )
    ] );
  }

  function widget( $args, $instance ) {
    $fields = [
      'label' => get_field( 'label', 'widget_' . $args['widget_id'] ),
    ];

    $content = "<a href='#menu'>
      <svg xmlns='http://www.w3.org/2000/svg' width='30' height='27' viewBox='0 0 448 512'><path d=\"M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z\"/></svg>
      <span>{$fields['label']}</span>
    </a>";

    $content = apply_filters( 'h_widget_toggle', $content, $fields );
    echo $args['before_widget'] . $content . $args['after_widget'];
  }
}