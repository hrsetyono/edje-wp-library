<?php

add_filter( 'custy_header_items', function( $items ) {
return wp_parse_args( [
  
  'menu' => [ 'title' => __( 'Menu 1' ), 'options' => [

    'menu' => [
      'label' => __( 'Select Menu' ),
      'type' => 'ct-select',
      'placeholder' => __( 'Select menu...' ),
      'choices' => blocksy_get_menus_items(),
      'desc' => sprintf(
        __( 'Manage your menus in the <a href="%s" target="_blank">Menus screen</a>.' ),
        admin_url('/nav-menus.php')
      ), 
    ],

  ] ],

], $items );
});