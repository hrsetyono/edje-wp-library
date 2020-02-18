<?php

$item = [
  'title' => __( 'Button' ),
  'css_selector' => '[data-id="button"]',
  'options' => [

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
        '--background' => 'default.color',
        '--backgroundHover' => 'hover.color',
      ],
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
    
  ],

];