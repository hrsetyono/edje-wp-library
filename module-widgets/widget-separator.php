<?php

/**
 * Create a separate div for the next set of widgets.
 * 
 * In Header, it will divide the widgets into left / center / right position.
 * In Footer, it will divide them into equal sized div.
 */
class H_Widget_Separator extends H_Widget { 
  function __construct() {
    parent::__construct( 'h_separator',  __( '-----' ), [
        'description' => __( 'Split the widgets' )
    ] );
  }
  public function widget( $args, $instance ) {
    $id = $args['widget_id'];
    $size = get_field( 'size', "widget_$id" );
    $style = '';

    if( $size !== 'auto' ) {
      $style = "style='--columnSize:$size'";
    }

    $content = "</ul><ul class=\"widget-column\" {$style}>";
    $content = apply_filters( 'h_widget_separator', $content, $args );

    echo $content;
  }


  function add_acf_fields() {
    acf_add_local_field_group(array(
      'key' => 'group_5f1bdc5650dd2',
      'title' => 'Separator',
      'fields' => array(
        array(
          'key' => 'field_5f1bdc5a0e2d9',
          'label' => '',
          'name' => '',
          'type' => 'message',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'message' => 'Separate the widgets.
    In Header, it\'s for left / center / right positioning.
    In Footer, it\'s for splitting the grid.',
          'new_lines' => 'wpautop',
          'esc_html' => 0,
        ),
        array(
          'key' => 'field_5f1bdd230e2da',
          'label' => '<strong>Size</strong>',
          'name' => 'size',
          'type' => 'button_group',
          'instructions' => 'The size of next div',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'auto' => 'auto',
            '25%' => '1/4',
            '33%' => '1/3',
            '50%' => '1/2',
            '67%' => '2/3',
            '75%' => '3/4',
          ),
          'allow_null' => 0,
          'default_value' => 'Auto',
          'layout' => 'horizontal',
          'return_format' => 'value',
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'widget',
            'operator' => '==',
            'value' => 'h_separator',
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