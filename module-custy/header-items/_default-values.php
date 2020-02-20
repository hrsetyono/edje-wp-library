<?php

/**
 * Add default values for Header items
 * 
 * @filter custy_default_values
 */
function _custy_header_default_values( $defaults ) {
  $row_values = [
    'rowBackground' => blocksy_background_default_value([
      'backgroundColor' => [
        'default' => [ 'color' => '#ffffff' ],
      ],
    ]),
    'rowHeight' => '48px',
  ];

  $menu_values = [
    'menu' => blocksy_get_default_menu(),
    'header_menu_type' => 'type-1',
  ];

  $button_values = [
    'text' => __( 'Download' ),
    'link' => '',
    'target' => 'no',

    'headerButtonBackground' => [
      'desktop' => [
        'default' => [ 'color' => 'var(--main)' ],
        'hover' => [ 'color' => 'var(--mainDark)' ]
      ],
      'mobile' => [
        'default' => [ 'color' => 'var(--main)' ],
        'hover' => [ 'color' => 'var(--mainDark)' ]
      ],
    ],
    'headerButtonColor' => [
      'default' => [ 'color' => 'var(--textInvert)' ]
    ],
  ];


  $defaults = wp_parse_args( [ 'header' => [
    // ROWS
    'top-row' => $row_values,
    'middle-row' => $row_values,
    'bottom-row' => $row_values,
    
    // OFF CANVAS
    'offcanvas' => [
      'offcanvasBackground' => blocksy_background_default_value([
        'backgroundColor' => [
          'default' => [ 'color' => 'rgba(18, 21, 25, 0.98)' ],
        ],
      ]),
      'offcanvasShadow' => 'var(--shadow2)'
    ],

    // MENU
    'menu' => $menu_values,
    'menu2' => $menu_values,

    // LOGO
    'logo' => [
      'logo_type' => 'text',
      'site_title' => get_option('blogname'),
      'site_description' => get_option('blogdescription'),
      'custom_logo' => '',
      'has_mobile_logo' => 'no',
      'mobile_header_logo' => '',
      'has_tagline' => 'no',
    ],

    // BUTTON
    'button' => $button_values,
    'button2' => $button_values,

    // SEARCH
    'search' => [
      'search_placeholder' => __( 'Search...' ),
      'searchPadding' => [
        'top' => '10px',
        'right' => '5px',
        'bottom' => '10px',
        'left' => '5px',
      ],
      'searchBackground' => [
        'default' => [ 'color' => 'var(--textInvert)' ],
        'focus' => [ 'color' => 'var(--mainLight)' ],
      ]
    ],

    // SOCIAL ACCOUNTS
    'socials' => [
      'social_links' => [
        [ 'id' => 'facebook', 'enabled' => true ],
        [ 'id' => 'twitter', 'enabled' => true ],
        [ 'id' => 'instagram', 'enabled' => true ],
      ],
      'icon_color' => 'custom',
      'customColor' => [
        'default' => [ 'color' => 'var(--text)' ]
      ],
      'icon_style' => 'none',
      'show_text' => 'no'
    ],

    ///// MOBILE
    
    'mobile-menu' => [
      'menu' => blocksy_get_default_menu(),
    ],

    'trigger' => [
      'mobile_menu_trigger_type' => 'type-1'
    ],
  
  ] ], $defaults );


  // PLACEMENTS
  $defaults = wp_parse_args( [ 'header_placements' => [
    'current_section' => 'main',
    'sections' => [
      [
        'id' => 'main',
        'label' => 'Main Header',
        'mode' => 'placements',
        'items' => [
          [ 'id' => 'menu', 'values' => $defaults['header']['menu'] ],
          [ 'id' => 'logo', 'values' => $defaults['header']['logo'] ],
          [ 'id' => 'top-row', 'values' => $defaults['header']['top-row'] ],
          [ 'id' => 'middle-row', 'values' => $defaults['header']['middle-row'] ],
          [ 'id' => 'bottom-row', 'values' => $defaults['header']['bottom-row'] ],
          [ 'id' => 'offcanvas', 'values' => $defaults['header']['offcanvas'] ],
          [ 'id' => 'mobile-menu', 'values' => $defaults['header']['mobile-menu'] ],
          [ 'id' => 'trigger', 'values' => $defaults['header']['trigger'] ],
        ],
        'desktop' => [
          [ 'id' => 'top-row', 'placements' => [
            [ 'id' => 'start', 'items' => [] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [] ],
            [ 'id' => 'start-middle', 'items' => [] ],
            [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
          [ 'id' => 'middle-row', 'placements' => [
            [ 'id' => 'start', 'items' => [ 'logo' ] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [ 'menu' ] ],
            [ 'id' => 'start-middle', 'items' => [] ],
            [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
          [ 'id' => 'bottom-row', 'placements' => [
            [ 'id' => 'start', 'items' => [] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [] ],
            [ 'id' => 'start-middle', 'items' => [] ],
            [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
        ],
        'mobile' => [
          [ 'id' => 'top-row', 'placements' => [
            [ 'id' => 'start', 'items' => [] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [] ],
            [ 'id' => 'start-middle', 'items' => [] ],
            [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
          [ 'id' => 'middle-row', 'placements' => [
            [ 'id' => 'start', 'items' => [ 'logo' ] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [ 'trigger' ] ],
            [ 'id' => 'start-middle', 'items' => [] ],
            [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
          [ 'id' => 'bottom-row', 'placements' => [
            [ 'id' => 'start', 'items' => [] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [] ],
            [ 'id' => 'start-middle', 'items' => [] ],
            [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
          [ 'id' => 'offcanvas', 'placements' => [
            [ 'id' => 'start', 'items' => [ 'mobile-menu' ] ],
          ] ],
        ],
      ],
    ], // sections
  ] ], $defaults );


  return $defaults;
}