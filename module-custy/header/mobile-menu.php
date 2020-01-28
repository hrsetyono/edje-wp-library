<?php

$item = [
  'title' => __( 'Mobile Menu' ),
  'options' => [

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

  ]
];