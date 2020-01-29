<?php

$items = [];

for( $i = 1; $i <= 4; $i++ ) {
  $items[ "widget-area-$i" ] = [
    'title' => __( 'Widget Area ' ) . $i,
    'options' => [
      'widget' => [
        'type' => 'ct-widget-area',
        'sidebarId' => "ct-footer-sidebar-$i"
      ]
    ]
  ];
}