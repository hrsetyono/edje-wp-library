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
}