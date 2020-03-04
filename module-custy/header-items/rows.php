<?php

$row_options = [
  'rowBackground' => [
    'label' => __( 'Background' ),
    'type'  => 'ct-background',
    'css' => '--row$',
  ],

  'row_padding' => [
    'label' => __( 'Padding' ),
    'type' => 'ct-radio',
    'choices' => [
      'none' => __( 'None' ),
      'small' => __( 'Small' ),
      'medium' => __( 'Medium' ),
      'large' => __( 'Large' ),
    ],
  ],
];

$items = [
  'top-row' => [
    'title' => __( 'Top Row' ),
    'is_primary' => true,
    'options' => $row_options,
    'css_selector' => '[data-header-row="top-row"]',
  ],

  'middle-row' => [
    'title' => __( 'Middle Row' ),
    'is_primary' => true,
    'options' => $row_options,
    'css_selector' => '[data-header-row="middle-row"]',
  ],

  'bottom-row' => [
    'title' => __( 'Bottom Row' ),
    'is_primary' => true,
    'options' => $row_options,
    'css_selector' => '[data-header-row="bottom-row"]',
  ],

  'offcanvas' => [
    'title' => __( 'Offcanvas' ),
    'is_primary' => true,
    'css_selector' => '[data-header-row="offcanvas"]',
    'options' => [

      'offcanvasBackground' => [
        'label' => __( 'Background' ),
        'type'  => 'ct-background',
      ],
      'offcanvasShadow' => [
        'label' => __( 'Shadow' ),
        'type' => 'ct-select/shadow',
      ],
      
    ],
  ],
];