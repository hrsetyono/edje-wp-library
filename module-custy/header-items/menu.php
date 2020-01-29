<?php

$item = [
  'title' => __( 'Menu 1' ),
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
    'header_menu_type' => [
      'label' => __( 'Design' ),
      'type' => 'ct-image-picker',
      'attr' => [ 'data-type' => 'background' ],
      'switchDeviceOnChange' => 'desktop',
      'choices' => [
        'type-1' => [
          'src'   => blocksy_image_picker_url( 'menu-type-1.svg' ),
          'title' => __( 'Type 1' ),
        ],
        'type-2' => [
          'src'   => blocksy_image_picker_url( 'menu-type-2.svg' ),
          'title' => __( 'Type 2' ),
        ],
        'type-3' => [
          'src'   => blocksy_image_picker_url( 'menu-type-3.svg' ),
          'title' => __( 'Type 3' ),
        ],
        'type-4' => [
          'src'   => blocksy_image_picker_url( 'menu-type-4.svg' ),
          'title' => __( 'Type 4' ),
        ],
      ],
    ],

  ]

];