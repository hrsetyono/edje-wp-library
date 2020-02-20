<?php
 
$item = [
  'title' => __( 'Search' ),
  'css_selector' => '[data-id="search"]',
  'options' => [

    'search_type' => [
      'label' => __( 'Search Type' ),
      'type' => 'ct-radio',
      'choices' => [
        'inline' => __( 'Inline' ),
        'popup' => __( 'Popup' ),
      ],
    ],

    'search_placeholder' => [
      'label' => __( 'Placeholder Text' ),
      'type' => 'text',
    ],

    'searchPadding' => [
      'label' => __( 'padding' ),
      'type' => 'ct-spacing',
      'css' => '--searchPadding'
    ],

    'searchBackground' => [
      'label' => __( 'Background' ),
      'type'  => 'ct-color-picker',
      'pickers' => [
        'default' => __( 'Default' ),
        'focus' => __( 'Focus' ),
      ],
      'css' => [
        '--background' => 'default',
        '--backgroundFocus' => 'focus',
      ],
    ],
  ]
];
