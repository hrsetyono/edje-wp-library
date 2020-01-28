<?php

add_filter( 'custy_header_items', function( $items ) {
return wp_parse_args( [
  
  'logo' => [ 'title' => __( 'Logo' ), 'options' => [

    'logo_type' => [
      'label' => __( 'Logo Type' ),
      'type' => 'ct-radio',
      'view' => 'text',
      'allow_empty' => true,
      'choices' => [
        'text' => __( 'Text' ),
        'image' => __( 'Image' ),
      ],
    ],
    blocksy_rand_md5() => [
      'type' => 'ct-condition',
      'condition' => [ 'logo_type' => 'text' ],
      'options' => [

        'blogname' => [
          'label' => __( 'Site Title' ),
          'type' => 'text',
          'design' => 'block',
        ],

      ],
    ],
    blocksy_rand_md5() => [
      'type' => 'ct-condition',
      'condition' => [ 'logo_type' => 'image' ],
      'options' => [

        'custom_logo' => [
          'label' => false,
          'type' => 'ct-image-uploader',
          'attr' => [ 'data-height' => 'small' ],
        ],

      ],
    ],
    
  ] ],

], $items );
});