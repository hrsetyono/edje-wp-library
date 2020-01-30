<?php

$row_options = [
  'rowColor' => [
    'label' => __( 'Text Color' ),
    'type' => 'ct-color-picker',
    'pickers' => [
      'default' => __( 'Default' ),
      'hover' => __( 'Hover' ),
    ],
    'css' => [
      '--color' => 'default.color',
      '--colorHover' => 'hover.color'
    ],
  ],

  blocksy_rand_md5() => [ 'type' => 'ct-divider' ],
  
  'rowBackground' => [
    'label' => __( 'Background' ),
    'type'  => 'ct-background',
    'divider' => 'bottom',
    'css' => '--row$',
  ],
  'rowBorder' => [
    'label' => __( 'Border' ),
    'type' => 'ct-border',
    'divider' => 'bottom',
    'css' => '--border',
  ],
  'rowPadding' => [
    'label' => __( 'Padding' ),
    'type' => 'ct-spacing',
    'responsive' => true,
    'css' => '--padding'
  ],
];

$items = [
  'top-row' => [
    'title' => __( 'Top Row' ),
    'is_primary' => true,
    'options' => $row_options,
    'css_selector' => '.site-header [data-row="top-row"]',
  ],
  'middle-row' => [
    'title' => __( 'Middle Row' ),
    'is_primary' => true,
    'options' => $row_options,
    'css_selector' => '.site-header [data-row="middle-row"]',
  ],
  'bottom-row' => [
    'title' => __( 'Bottom Row' ),
    'is_primary' => true,
    'options' => $row_options,
    'css_selector' => '.site-header [data-row="bottom-row"]',
  ],
  'offcanvas' => [
    'title' => __( 'Offcanvas' ),
    'is_primary' => true,
    'css_selector' => '.mobile-header [data-row="offcanvas"]',
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