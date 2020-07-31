<?php

/**
 * 
 */
class H_Widget_Name extends H_Widget { 
  function __construct() {
    parent::__construct( 'h_name', __( '- Name' ), [
      'description' => __( 'Short description here' )
    ] );
  }

  function widget( $args, $instance ) {
    $content = '';
    $id = $args['widget_id'];

    // do something

    $content = apply_filters( 'h_widget_name', $content, $args );
    echo $args['before_widget'] . $content . $args['after_widget'];
  }

  function add_acf_fields() {
  }
}