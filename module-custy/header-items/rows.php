<?php

$row_options = [
  'rowBackground' => [
    'label' => __( 'Background' ),
    'type'  => 'ct-background',
    'css' => '--row$',
  ],

  'rowHeight' => [
    'label' => __( 'Min Height' ),
    'type' => 'ct-slider',
    'responsive' => true,
    'units' => [
      'px' => [ 'min' => 20, 'max' => 90 ],
      'rem' => [ 'min' => 1, 'max' => 6 ],
    ],
    'css' => '--rowHeight'
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