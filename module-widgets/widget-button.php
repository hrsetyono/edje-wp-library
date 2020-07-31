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

  function add_acf_fields() {
    acf_add_local_field_group(array(
      'key' => 'group_5f1d380376c97',
      'title' => 'Edje Widget - Button',
      'fields' => array(
        array(
          'key' => 'field_5f1d380870aec',
          'label' => 'Link',
          'name' => 'link',
          'type' => 'link',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'return_format' => 'array',
        ),
        array(
          'key' => 'field_5f1d389b70aed',
          'label' => 'Icon',
          'name' => 'icon',
          'type' => 'textarea',
          'instructions' => 'Paste in SVG code here. Leave empty for no icon',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '<svg> ... </svg>',
          'maxlength' => '',
          'rows' => 6,
          'new_lines' => '',
        ),
        array(
          'key' => 'field_5f1d3bda627a2',
          'label' => 'Extra Classes',
          'name' => 'extra_classes',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
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
            'value' => 'h_button',
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