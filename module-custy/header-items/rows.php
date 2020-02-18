<?php

$row_options = [
  'rowBackground' => [
    'label' => __( 'Background' ),
    'type'  => 'ct-background',
    'css' => '--row$',
  ],

  custy_rand_id() => [ 'type' => 'ct-divider' ],

  'borderTop' => [
    'label' => __( 'Border Top' ),
    'type' => 'ct-border',
    'responsive' => true,
    'css' => '--borderTop',
  ],
  'borderBottom' => [
    'label' => __( 'Border Bottom' ),
    'type' => 'ct-border',
    'css' => '--borderBottom',
  ],

  custy_rand_id() => [ 'type' => 'ct-divider' ],

  'padding' => [
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
    'css_selector' => '.header-row[data-row="top-row"]',
  ],
  'middle-row' => [
    'title' => __( 'Middle Row' ),
    'is_primary' => true,
    'options' => $row_options,
    'css_selector' => '.header-row[data-row="middle-row"]',
  ],
  'bottom-row' => [
    'title' => __( 'Bottom Row' ),
    'is_primary' => true,
    'options' => $row_options,
    'css_selector' => '.header-row[data-row="bottom-row"]',
  ],
  'offcanvas' => [
    'title' => __( 'Offcanvas' ),
    'is_primary' => true,
    'css_selector' => '.header-row[data-row="offcanvas"]',
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