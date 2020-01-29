<?php

$item = [
  'title' => __( 'Button' ),
  'options' => [

    'size' => [
      'label' => __( 'Size' ),
      'type' => 'ct-radio',
      'view' => 'text',
      'divider' => 'bottom',
      'choices' => [
        'small' => __( 'Small' ),
        'medium' => __( 'Medium' ),
        'large' => __( 'Large' ),
      ],
    ],
    'text' => [
      'label' => __( 'Label' ),
      'type' => 'text',
    ],
    'link' => [
      'label' => __( 'URL' ),
      'type' => 'text',
      'design' => 'block'
    ],
    'target' => [
      'label' => __( 'Open in a new tab' ),
      'type'  => 'ct-switch',
      'divider' => 'bottom',
    ],
    
  ],

];