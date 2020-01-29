<?php
 
$item = [
  'title' => __( 'Search' ),
  'css_selector' => '.site-header .search',
  'options' => [

    'search_placeholder' => [
      'label' => __( 'Placeholder Text' ),
      'type' => 'text',
    ],

    'searchPadding' => [
      'label' => __( 'padding' ),
      'type' => 'ct-spacing',
      'css' => '--searchPadding'
    ],
  ]
];
