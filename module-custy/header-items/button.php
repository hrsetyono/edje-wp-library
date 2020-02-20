<?php

$button_options = [
  'text' => [
    'label' => __( 'Label' ),
    'type' => 'text',
  ],
  'link' => [
    'label' => __( 'URL' ),
    'type' => 'text',
    'design' => 'block'
  ],
  'target' => [
    'label' => __( 'Open in a new tab' ),
    'type'  => 'ct-switch',
  ],

  custy_rand_id() => [ 'type' => 'ct-divider' ],
  
  'headerButtonBackground' => [
    'label' => __( 'Background' ),
    'type'  => 'ct-color-picker',
    'pickers' => [
      'default' => __( 'Default' ),
      'hover' => __( 'Hover' ),
    ],
    'css' => [
      '--background' => 'default',
      '--backgroundHover' => 'hover',
    ],
    
    'responsive' => [ 'tablet' => false ],
    'design' => 'block',
  ],

  'headerButtonColor' => [
    'label' => __( 'Color' ),
    'type'  => 'ct-color-picker',
    'pickers' => [
      'default' => __( 'Default' ),
    ],
    'css' => [
      '--color' => 'default.color',
    ],
  ],

];

$items = [
  'button' => [
    'title' => __( 'Button 1' ),
    'css_selector' => '[data-id="button"]',
    'options' => $button_options,
  ],
  'button2' => [
    'title' => __( 'Button 2' ),
    'css_selector' => '[data-id="button2"]',
    'options' => $button_options,
  ],
];