<?php

$row_options = [
  'rowBackground' => [
    'label' => __( 'Background' ),
    'type'  => 'ct-background',
  ],
  blocksy_rand_md5() => [ 'type' => 'ct-divider' ],
  'rowBorder' => [
    'label' => __( 'Border' ),
    'type' => 'ct-border',
  ],
  'rowPadding' => [
    'label' => __( 'Padding' ),
    'type' => 'ct-spacing',
    'responsive' => true,
  ],
];

$items = [
  'top-row' => [
    'title' => __( 'Top Row' ),
    'is_primary' => true,
    'options' => $row_options,
  ],
  'middle-row' => [
    'title' => __( 'Middle Row' ),
    'is_primary' => true,
    'options' => $row_options,
  ],
  'bottom-row' => [
    'title' => __( 'Bottom Row' ),
    'is_primary' => true,
    'options' => $row_options,
  ],
  'offcanvas' => [
    'title' => __( 'Offcanvas' ),
    'is_primary' => true,
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