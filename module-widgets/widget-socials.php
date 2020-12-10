<?php

/**
 * 
 */
class H_Widget_Socials extends H_Widget {
  public $choices = [];

  function __construct() {
    $this->choices = apply_filters( 'h_widget_social_choices', [
      'facebook' => 'Facebook',
      'instagram' => 'Instagram',
      'twitter' => 'Twitter',
      'whatsapp' => 'WhatsApp',
      'youtube' => 'Youtube',
      'pinterest' => 'Pinterest',
      'email' => '- Email',
      'phone' => '- Phone',
      'location' => '- Location',
    ]);

    parent::__construct( 'h_socials', __( '- Socials' ), [
      'description' => __( 'Social Media links' )
    ] );
  }

  function widget( $args, $instance ) {
    $content = '';
    $id = $args['widget_id'];

    $items = get_field( 'items', "widget_$id" );

    foreach( $items as $i ) {
      $classes = 'social-icon';
      $social = H::get_social_icon( $i['icon'] );

      $icon = $social['svg'];
      $color = $social['color'];
      $url = $i['link']['url'] ?? '';
      $title = $i['link']['title'] ?? '';

      if( !empty( $title ) ) {
        $icon .= " <span> {$title} </span>";
        $classes .= ' social-icon--has-label';
      }

      $content .= "<a class='{$classes}' href='{$url}' style='--iconColor:{$color}' target='_blank'>
        {$icon}
      </a>";
    }

    $content = apply_filters( 'h_widget_socials', $content, $args );
    echo $args['before_widget'] . $content . $args['after_widget'];
  }

  function add_acf_fields() {
    acf_add_local_field_group(array(
      'key' => 'group_5f1e8498f248e',
      'title' => 'Edje Widget - Socials',
      'fields' => array(
        array(
          'key' => 'field_5f1e8509cf033',
          'label' => 'Items',
          'name' => 'items',
          'type' => 'repeater',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'collapsed' => '',
          'min' => 1,
          'max' => 0,
          'layout' => 'table',
          'button_label' => '+',
          'sub_fields' => array(
            array(
              'key' => 'field_5f1e8544cf034',
              'label' => 'Icon',
              'name' => 'icon',
              'type' => 'select',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array(
                'width' => '35',
                'class' => '',
                'id' => '',
              ),
              'choices' => $this->choices,
              'default_value' => array(
              ),
              'allow_null' => 0,
              'multiple' => 0,
              'ui' => 0,
              'return_format' => 'value',
              'ajax' => 0,
              'placeholder' => '',
            ),
            array(
              'key' => 'field_5f1e857ecf035',
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
          ),
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'widget',
            'operator' => '==',
            'value' => 'h_socials',
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


  private function get_icon( $slug ) {
    $list = [

    ];


  }
}