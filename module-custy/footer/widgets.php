<?php

add_filter( 'custy_footer_items', function( $items ) {
return wp_parse_args( [
  
  'widget-area-1' => [
    'title' => __( 'Widget Area 1' ),
    'options' => [
      'widget' => [ 'type' => 'ct-widget-area', 'sidebarId' => 'ct-footer-sidebar-1' ]
    ]
  ],

  'widget-area-2' => [
    'title' => __( 'Widget Area 2' ),
    'options' => [
      'widget' => [ 'type' => 'ct-widget-area', 'sidebarId' => 'ct-footer-sidebar-2' ]
    ]
  ],

  'widget-area-3' => [
    'title' => __( 'Widget Area 3' ),
    'options' => [
      'widget' => [ 'type' => 'ct-widget-area', 'sidebarId' => 'ct-footer-sidebar-3' ]
    ]
  ],

  'widget-area-4' => [
    'title' => __( 'Widget Area 4' ),
    'options' => [
      'widget' => [ 'type' => 'ct-widget-area', 'sidebarId' => 'ct-footer-sidebar-4' ]
    ]
  ],

], $items );
});