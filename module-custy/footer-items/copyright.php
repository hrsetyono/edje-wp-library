<?php

$item = [
  'title' => __( 'Copyright' ),
  'options' => [
    
    'copyright_text' => [
      'label' => __( 'Copyright text' ),
      'desc' => __( 'Available tags: [current-year] and [site-title]' ),
      'type' => 'wp-editor',
      
      'disableRevertButton' => true,
      'quicktags' => false,
      'mediaButtons' => false,
      'tinymce' => [
        'toolbar1' => 'bold,italic,link,undo,redo',
      ],
    ],
  ]
  
];