<?php

$section = [
  'title' => __( 'General' ),
  'container' => [ 'priority' => 0 ],
  'css_selector' => ':root',
  'options' => [
    
    custy_rand_id() => [ 'tab' => __( 'General' ), 'options' => [

      'colorPalette' => [
        'label' => false,
        'type'  => 'ct-color-palettes-picker',
        'design' => 'block',
        'css' => [
          '--main' => 'color1.color',
          '--mainDark' => 'color2.color',
          '--mainLight' => 'color3.color',
          '--sub' => 'color4.color',
          '--subLight' => 'color5.color',
        ],
      ],
      
      'textColor' => [
        'label' => __( 'TEXT' ),
        'type'  => 'ct-color-picker',
        'design' => 'inline no-palette',
        'pickers' => [
          'default' => __( 'Text' ),
          'invert' => __( 'Text Invert' ),
        ],
        'css' => [
          '--text' => 'default.color',
          '--textInvert' => 'invert.color',
        ],
      ],

      'extraColor' => [
        'label' => __( 'Extra Color' ),
        'desc' => __( 'Additional colors for Editor on top of Palettes.' ),
        'type'  => 'ct-color-picker',
        'pickers' => [
          'extra1' => __( 'Extra 1' ),
          'extra2' => __( 'Extra 2' ),
          'extra3' => __( 'Extra 3' ),
          'extra4' => __( 'Extra 4' ),
          'extra5' => __( 'Extra 5' ),
        ],
        'css' => [
          '--extra1' => 'extra1.color',
          '--extra2' => 'extra2.color',
          '--extra3' => 'extra3.color',
          '--extra4' => 'extra4.color',
          '--extra5' => 'extra5.color',
        ],
      ],

      custy_rand_id() => [ 'divider' => '' ],

      'siteBackground' => [
        'label' => __( 'Site Background' ),
        'type' => 'ct-background',
        'css' => '--site$',
      ],

      custy_rand_id() => [ 'divider' => __( 'CSS Output' ),
        'desc' => __( 'Adjust the media query for responsive settings' ),
      ],

      'mobile_media' => [
        'label' => __( 'Mobile Media' ),
        'type' => 'ct-slider',
        'units' => [
          'px' => [ 'min' => 320, 'max' => 600 ],
        ],
      ],

      custy_rand_id() => [ 'divider' => __( 'Title' ),
        'desc' => 'Optional description - lorem ipsum dolor sit amet'
      ],

      'tablet_media' => [
        'label' => __( 'Tablet Media' ),
        'type' => 'ct-slider',
        'units' => [
          'px' => [ 'min' => 700, 'max' => 960 ],
        ],
      ],
    ] ],

    custy_rand_id() => [ 'tab' => __( 'Shadow' ), 'options' => [

      'shadow0' => [
        'label' => __( 'Shadow 0' ),
        'type' => 'ct-box-shadow',
        'css' => '--shadow0',
      ],
      'shadow1' => [
        'label' => __( 'Shadow 1' ),
        'type' => 'ct-box-shadow',
        'css' => '--shadow1',
      ],
      'shadow2' => [
        'label' => __( 'Shadow 2' ),
        'type' => 'ct-box-shadow',
        'css' => '--shadow2',
      ],
      'shadow3' => [
        'label' => __( 'Shadow 3' ),
        'type' => 'ct-box-shadow',
        'css' => '--shadow3',
      ],
      'shadow4' => [
        'label' => __( 'Shadow 4' ),
        'type' => 'ct-box-shadow',
        'css' => '--shadow4',
      ],

    ] ],
  ]
];