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

  // PARENT
  custy_rand_id() => [ 'tab' => 'Parent', 'options' => [

    'parentBackground' => [
      'label' => __( 'Background' ),
      'type'  => 'ct-color-picker',
      'pickers' => [
        'default' => __( 'Default' ),
        'hover' => __( 'Hover' ),
      ],
      'css' => [
        '--parentBg' => 'default',
        '--parentBgHover' => 'hover'
      ]
    ],

    'parentTextColor' => [
      'label' => __( 'Text Color' ),
      'type'  => 'ct-color-picker',
      'pickers' => [
        'default' => __( 'Default' ),
        'hover' => __( 'Hover' ),
      ],
      'css' => [
        '--parentColor' => 'default',
        '--parentColorHover' => 'hover'
      ]
    ],

    'parentFontSize' => [
      'label' => __( 'Font Size' ),
      'type' => 'ct-select/text',
    ],



  ] ],

  // DROPDOWN
  custy_rand_id() => [ 'tab' => 'Dropdown', 'options' => [

    'dropdown_style' => [
      'label' => __( 'Dropdown Style' ),
      'type' => 'ct-radio',
      'desc' => __( '<strong>Single:</strong> One column straight to bottom. <br> <strong>Mega:</strong> Multiple columns, 2nd-level items become title, 3rd-level items become link (If don\'t have 3rd level, revert to Single Column).' ),
      'choices' => [
        'single' => __( 'Single Column' ),
        'mega' => __( 'Mega Nav' ),
      ],
    ],

    'dropdownBackground' => [
      'label' => __( 'Background' ),
      'type'  => 'ct-color-picker',
      'pickers' => [
        'default' => __( 'Default' ),
        'hover' => __( 'Hover' ),
      ],
      'css' => [
        '--dropdownBg' => 'default',
        '--dropdownBgHover' => 'hover'
      ]
    ],

    'dropdownTextColor' => [
      'label' => __( 'Text Color' ),
      'type'  => 'ct-color-picker',
      'pickers' => [
        'default' => __( 'Default' ),
        'hover' => __( 'Hover' ),
      ],
      'css' => [
        '--dropdownColor' => 'default',
        '--dropdownColorHover' => 'hover'
      ]
    ],

    'dropdownFontSize' => [
      'label' => __( 'Font Size' ),
      'type' => 'ct-select/text',
      'css' => '--dropdownFontSize'
    ],
  ] ],
];


$items = [
  'menu' => [
    'title' => __( 'Menu 1' ),
    'devices' => [ 'desktop' ],
    'css_selector' => '[data-id="menu"]',
    'options' => $menu_options
  ],
  'menu2' => [
    'title' => __( 'Menu 2' ),
    'devices' => [ 'desktop' ],
    'css_selector' => '[data-id="menu2"]',
    'options' => $menu_options
  ],
];