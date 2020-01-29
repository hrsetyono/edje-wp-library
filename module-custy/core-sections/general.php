<?php

$section = [
  'title' => __( 'General' ),
  'container' => [ 'priority' => 0 ],
  'css_selector' => ':root',
  'options' => [
    
    'colorPalette' => [
      'label' => __( 'COLOR PALETTE' ),
      'type'  => 'ct-color-palettes-picker',
      'css' => [
        '--main' => 'color1.color',
        '--mainDark' => 'color2.color',
        '--mainLight' => 'color3.color',
        '--sub' => 'color4.color',
        '--subLight' => 'color5.color',
      ],
    ],
    
    'textColor' => [
      'label' => __( 'Text Color' ),
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

    blocksy_rand_md5() => [ 'type' => 'ct-divider' ],

    'siteBackground' => [
      'label' => __( 'Site Background' ),
      'type' => 'ct-background',
      'css' => '--site$',
    ],

    blocksy_rand_md5() => [
      'label' => __( 'CSS Output' ),
      'desc' => __( 'Adjust the media query for responsive settings' ),
      'type' => 'ct-title'
    ],

    'mobile_media' => [
      'label' => __( 'Mobile Media' ),
      'type' => 'ct-slider',
      'units' => [
        'px' => [ 'min' => 320, 'max' => 600 ],
      ],
    ],

    'tablet_media' => [
      'label' => __( 'Tablet Media' ),
      'type' => 'ct-slider',
      'units' => [
        'px' => [ 'min' => 700, 'max' => 960 ],
      ],
    ],
  ]
];