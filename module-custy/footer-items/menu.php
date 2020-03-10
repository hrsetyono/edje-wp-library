<?php

$item = [
  'title' => __( 'Footer Menu' ),
  'css_selector' => '[data-id="footer-menu"]',
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

    custy_rand_id() => [ 'divider' => '' ],

    'menu_style' => [
      'label' => __( 'Menu Style' ),
      'type' => 'ct-radio',
      'desc' => __( 'If Include Children: only up to 2nd level' ),
      'choices' => [
        'only-parent' => __( 'Only Parent' ),
        'include-child' => __( 'Include Children' ),
      ],
    ],

  ]
];