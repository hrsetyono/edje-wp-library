<?php

$menu_options = [
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

  'mobile_menu_style' => [
    'label' => __( 'Mobile Menu Style' ),
    'type' => 'ct-radio',
    'choices' => [
      'default' => __( 'Default' ),
      'compact' => __( 'Compact' ),
    ],
  ],

  // PARENT
  custy_rand_id() => [ 'divider' => '' ],

  'mobileMenuBackground' => [
    'label' => __( 'Background' ),
    'type'  => 'ct-color-picker',
    'pickers' => [
      'default' => __( 'Default' ),
    ],
    'css' => [
      '--mobileMenuBackground' => 'default',
    ]
  ],

  'mobileMenuTextColor' => [
    'label' => __( 'Text Color' ),
    'type'  => 'ct-color-picker',
    'pickers' => [
      'default' => __( 'Default' ),
      'hover' => __( 'Hover' ),
    ],
    'css' => [
      '--mobileMenuColor' => 'default',
      '--mobileMenuColorHover' => 'hover'
    ]
  ],

  // DROPDOWN
  custy_rand_id() => [ 'condition' => [ 'mobile_menu_style' => 'default' ], 'options' => [
    
    custy_rand_id() => [ 'divider' => '' ],

    'parentFontSize' => [
      'label' => __( 'Font Size' ),
      'type' => 'ct-select/text',
      'css' => '--parentFontSize'
    ],

    'dropdownFontSize' => [
      'label' => __( 'Dropdown Font Size' ),
      'type' => 'ct-select/text',
      'css' => '--dropdownFontSize'
    ],
  ] ],
];


$items = [
  'mobile-menu' => [
    'title' => __( 'Mobile Menu 1' ),
    'devices' => [ 'mobile' ],
    'css_selector' => '[data-id="mobile-menu"]',
    'allowed_in' => [ 'offcanvas' ],
    'options' => $menu_options
  ],
  'mobile-menu2' => [
    'title' => __( 'Mobile Menu 2' ),
    'devices' => [ 'mobile' ],
    'css_selector' => '[data-id="mobile-menu2"]',
    'allowed_in' => [ 'offcanvas' ],
    'options' => $menu_options
  ]
];