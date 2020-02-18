<?php

$item = [
  'title' => __( 'Logo' ),
  'options' => [

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
    custy_rand_id() => [
      'type' => 'ct-condition',
      'condition' => [ 'logo_type' => 'text' ],
      'options' => [

        'site_title' => [
          'label' => __( 'Site Title' ),
          'type' => 'text',
          'design' => 'block',
        ],

      ],
    ],
    custy_rand_id() => [
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
    
  ]
  
];