<?php

$item = [
  'title' => __( 'Copyright' ),
  'options' => [
    
    'copyright_text' => [
      'label' => __( 'Copyright text' ),
      'type' => 'wp-editor',
      'desc' => __( 'You can insert some arbitrary HTML code tags: {current_year}, {site_title} and {theme_author}' ),
      
      'disableRevertButton' => true,
      'quicktags' => false,
      'mediaButtons' => false,
      'tinymce' => [
        'toolbar1' => 'bold,italic,link,undo,redo',
      ],
    ],
  ]
  
];