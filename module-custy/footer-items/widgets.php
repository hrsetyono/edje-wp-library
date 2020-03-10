<?php

$items = [];

for( $i = 1; $i <= 4; $i++ ) {
  $items[ "widget-area-$i" ] = [
    'title' => __( 'Widget Area ' ) . $i,
    'css_selector' => "[data-id='widget{$i}']",
    'options' => [
      'widget' => [
        'type' => 'ct-widget-area',
        'sidebarId' => "ct-footer-sidebar-$i"
      ],

      'widgetTextColor' => [
        'label' => __( 'Text Color' ),
        'type'  => 'ct-color-picker',
        'pickers' => [
          'default' => __( 'Default' ),
          'hover' => __( 'Hover' ),
        ],
        'css' => [
          '--widgetColor' => 'default',
          '--widgetColorHover' => 'hover'
        ]
      ],
    ]
  ];
}