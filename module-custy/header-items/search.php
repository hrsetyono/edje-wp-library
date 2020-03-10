<?php
 
$item = [
  'title' => __( 'Search' ),
  'css_selector' => '[data-id="search"]',
  'options' => [

    'style' => [
      'label' => __( 'Style' ),
      'desc' => __( 'On mobile it is always set to Expanding' ),
      'type' => 'ct-radio',
      'choices' => [
        'full' => __( 'Full' ),
        'expanding' => __( 'Expanding' ),
      ],
    ],

    'placeholder' => [
      'label' => __( 'Placeholder Text' ),
      'type' => 'text',
    ],

    'searchBackground' => [
      'label' => __( 'Search Background' ),
      'type'  => 'ct-color-picker',
      'pickers' => [
        'default' => __( 'Default' ),
        'focus' => __( 'Focus' ),
      ],
      'css' => [
        '--searchBg' => 'default',
        '--searchBgFocus' => 'focus',
      ],
    ],

    custy_rand_id() => [ 'divider' => 'SUBMIT BUTTON' ],

    'submit_text' => [
      'label' => __( 'Submit Text' ),
      'desc' => __( 'Can be a simple text or SVG Icon' ),
      'type' => 'textarea',
    ],

    'submitColor' => [
      'label' => __( 'Submit Color' ),
      'type'  => 'ct-color-picker',
      'pickers' => [
        'default' => __( 'Default' ),
        'hover' => __( 'Hover' ),
      ],
      'css' => [
        '--submitColor' => 'default',
        '--submitColorHover' => 'hover',
      ],
    ],

    'submitBackground' => [
      'label' => __( 'Submit Background' ),
      'type'  => 'ct-color-picker',
      'pickers' => [
        'default' => __( 'Default' ),
        'hover' => __( 'Hover' ),
      ],
      'css' => [
        '--submitBg' => 'default',
        '--submitBgHover' => 'hover'
      ],
    ],

  ]
];
