<?php
 
$item = [
  'title' => __( 'Search' ),
  'css_selector' => '[data-id="search"]',
  'options' => [

    'search_style' => [
      'label' => __( 'Search Style' ),
      'desc' => __( 'On mobile it is always set to Expanding' ),
      'type' => 'ct-radio',
      'choices' => [
        'full' => __( 'Full' ),
        'expanding' => __( 'Expanding' ),
      ],
    ],

    custy_rand_id() => [ 'divider' => '' ],

    'search_placeholder' => [
      'label' => __( 'Placeholder Text' ),
      'type' => 'text',
    ],

    'searchBackground' => [
      'label' => __( 'Background' ),
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

    custy_rand_id() => [ 'divider' => 'Submit Button' ],

    'submit_button_text' => [
      'label' => __( 'Button Text' ),
      'desc' => __( 'Can be a simple text or SVG Icon' ),
      'type' => 'textarea',
    ],

    'submitButtonColor' => [
      'label' => __( 'Button Text Color' ),
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

    'submitButtonBackground' => [
      'label' => __( 'Button Background' ),
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
