<?php

$item = [
  'title' => __( 'Copyright' ),
  'css_selector' => '[data-id="copyright"]',
  'options' => [
    
    'copyright_text' => [
      'label' => __( 'Copyright Text' ),
      'desc' => __( 'Available tags: [current-year] and [site-title]' ),
      'type' => 'wp-editor',
      
      'disableRevertButton' => true,
      'quicktags' => false,
      'mediaButtons' => false,
      'tinymce' => [
        'toolbar1' => 'bold,italic,link,undo,redo',
        'toolbar2' => ''
      ],
    ],

    custy_rand_id() => [ 'divider' => '' ],

    'textSize' => [
      'label' => __( 'Text Size' ),
      'type' => 'ct-select/text',
      'css' => '--textSize'
    ],

    'textColor' => [
      'label' => __( 'Text Color' ),
      'type'  => 'ct-color-picker',
      'pickers' => [
        'default' => __( 'Default' )
      ],
      'css' => [
        '--textColor' => 'default'
      ]
    ],

    custy_rand_id() => [ 'divider' => '' ],
    
    'textAlignment' => [
      'label' => __( 'Text Alignment' ),
      'type' => 'ct-radio/alignment',
      'css' => '--textAlignment'
    ],

  ]
];