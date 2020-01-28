<?php

add_filter( 'custy_header_items', function( $items ) {
return wp_parse_args( [

  'button' => [ 'title' => __( 'Button' ), 'options' => [

    'header_button_size' => [
      'label' => __( 'Size' ),
      'type' => 'ct-radio',
      'view' => 'text',
      'divider' => 'bottom',
      'choices' => [
        'small' => __( 'Small' ),
        'medium' => __( 'Medium' ),
        'large' => __( 'Large' ),
      ],
    ],
    'header_button_text' => [
      'label' => __( 'Label' ),
      'type' => 'text',
    ],
    'header_button_link' => [
      'label' => __( 'URL' ),
      'type' => 'text',
      'design' => 'block'
    ],
    'header_button_target' => [
      'label' => __( 'Open in a new tab' ),
      'type'  => 'ct-switch',
      'divider' => 'bottom',
    ],
    
  ] ],

], $items );
});