<?php

/**
 * Show the logo that is set in Customizer or allow overriding with own image.
 */
class H_Widget_Logo extends H_Widget { 
  function __construct() {
    parent::__construct( 'h_logo', __( '- Logo' ), [
      'description' => __( 'Show logo from Customizer' )
    ] );
  }


  function widget( $args, $instance ) {
    $content = '';
    $id = $args['widget_id'];
    
    $logo = get_field( 'logo', "widget_$id" );
    $tagline = get_field( 'tagline', "widget_$id" );

    // if override logo
    if( $logo ) {
      $home_url = get_home_url();
      $image_src = $logo['sizes']['medium'];

      $content = "<a href='{$home_url}' class='custom-logo-link' rel='home'> <img src={$image_src}> </a>";
    }
    elseif ( function_exists( 'the_custom_logo' ) ) {
      $content = get_custom_logo();
    }

    // add tagline
    $content = $tagline ? $content . "<span> $tagline </span>" : $content;

    $content = apply_filters( 'h_widget_logo', $content, $args );
    echo $args['before_widget'] . $content . $args['after_widget'];
  }


  function add_acf_fields() {
    acf_add_local_field_group(array(
      'key' => 'group_5f1ba50b0878b',
      'title' => 'Edje Widget - Logo',
      'fields' => array(
        array(
          'key' => 'field_5f1ba51fba633',
          'label' => 'Logo',
          'name' => 'logo',
          'type' => 'image',
          'instructions' => 'Leave empty to use the logo set in Appearance > Customizer > Site Identity',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'return_format' => 'array',
          'preview_size' => 'medium',
          'library' => 'all',
          'min_width' => '',
          'min_height' => '',
          'min_size' => '',
          'max_width' => '',
          'max_height' => '',
          'max_size' => '',
          'mime_types' => '',
        ),
        array(
          'key' => 'field_5f1be3f98c7c7',
          'label' => 'Tagline',
          'name' => 'tagline',
          'type' => 'text',
          'instructions' => 'Leave empty to disable it',
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
            'value' => 'h_logo',
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