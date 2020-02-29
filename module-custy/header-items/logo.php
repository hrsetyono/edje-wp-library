<?php

$item = [
  'title' => __( 'Logo' ),
  'options' => [

    'logo_type' => [
      'label' => __( 'Logo Type' ),
      'type' => 'ct-radio',
      'view' => 'text',
      'choices' => [
        'text' => __( 'Text' ),
        'image' => __( 'Image' ),
      ],
    ],

    custy_rand_id() => [ 'condition' => [ 'logo_type' => 'text' ], 'options' => [

      'site_title' => [
        'label' => __( 'Site Title' ),
        'type' => 'text',
      ],

      'titleColor' => [
        'label' => __( 'Title Color' ),
        'type'  => 'ct-color-picker',
        'pickers' => [
          'default' => __( 'Default' ),
          'hover' => __( 'Hover' ),
        ],
        'css' => [
          '--titleColor' => 'default',
          '--titleColorHover' => 'hover'
        ]
      ],

      'titleSize' => [
        'label' => __( 'Title Size' ),
        'type' => 'ct-select/text',
        'css' => '--titleSize'
      ],

    ] ],

    custy_rand_id() => [ 'condition' => [ 'logo_type' => 'image' ], 'options' => [

      'custom_logo' => [
        'label' => false,
        'type' => 'ct-image-uploader',
        'attr' => [ 'data-height' => 'small' ],
      ],

    ] ],

    custy_rand_id() => [ 'divider' => '' ],

    'has_tagline' => [
      'label' => __( 'Site Tagline' ),
      'type' => 'ct-switch',
    ],

    custy_rand_id() => [ 'condition' => [ 'has_tagline' => 'yes' ], 'options' => [

      'site_tagline' => [
        'label' => false,
        'type' => 'text',
      ],

      'taglineColor' => [
        'label' => __( 'Tagline Color' ),
        'type'  => 'ct-color-picker',
        'pickers' => [
          'default' => __( 'Default' ),
        ],
        'css' => [
          '--taglineColor' => 'default',
        ]
      ],

      'taglineSize' => [
        'label' => __( 'Tagline Size' ),
        'type' => 'ct-select/text',
        'css' => '--taglineSize'
      ],

    ] ],


    
  ]
  
];