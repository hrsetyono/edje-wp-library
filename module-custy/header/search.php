<?php

add_filter( 'custy_header_items', function( $items ) {
return wp_parse_args( [
  
  'search' => [ 'title' => __( 'Search' ), 'options' => [

    'search_placeholder' => [
      'label' => __( 'Placeholder Text' ),
      'type' => 'text',
    ],
    
  ] ],

], $items );
});

