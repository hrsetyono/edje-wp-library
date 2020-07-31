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
    $id = $args['widget_id'];
    $label = get_field( 'label', "widget_$id" );

    $content = "<a href='#menu'>
      <svg xmlns='http://www.w3.org/2000/svg' width='30' height='27' viewBox='0 0 448 512'><path d=\"M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z\"/></svg>
      <span>$label</span>
    </a>";

    $content = apply_filters( 'h_widget_toggle', $content, $args );
    echo $args['before_widget'] . $content . $args['after_widget'];
  }

  function add_acf_fields() {
    acf_add_local_field_group(array(
      'key' => 'group_5f1e27d9215a5',
      'title' => 'Edje Widget - Toggle Offcanvas',
      'fields' => array(
        array(
          'key' => 'field_5f1e27e3d2fa2',
          'label' => 'Label',
          'name' => 'label',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => 'Menu',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'widget',
            'operator' => '==',
            'value' => 'h_toggle',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => true,
      'description' => '',
    ));
  }
}