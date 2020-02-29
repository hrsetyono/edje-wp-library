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
    'row_padding' => 'medium',
  ];

  $menu_values = [
    'menu' => blocksy_get_default_menu(),
    'header_menu_type' => 'type-1',
  ];

  $button_values = [
    'text' => __( 'Download' ),
    'link' => '',
    'target' => 'no',
    'has_icon' => 'no',
    'png_icon' => [],
    'svg_icon' => '',

    'button_size' => 'normal',
    'button_style' => 'solid',
    'buttonBackground' => [
      'default' => [ 'color' => 'var(--main)' ],
      'hover' => [ 'color' => 'var(--mainDark)' ]
    ],
    'buttonBorder' => [
      'width' => 2,
      'style' => 'solid',
      'color' => [ 'color' => 'var(--main)' ],
    ],
    'buttonTextColor' => [
      'default' => [ 'color' => 'var(--textInvert)' ],
      'hover' => [ 'color' => 'var(--textInvert)' ],
    ],
  ];

  $free_text_values = [
    'content' => 'Sample Text',
    'textColor' => [
      'default' => [ 'color' => 'var(--text)' ],
      'link' => [ 'color' => 'var(--main)' ],
    ],
    'textSize' => 'var(--smallFontSize)',
    'textMaxWidth' => '100%',
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
      'titleColor' => [
        'default' => [ 'color' => 'var(--text)' ],
        'hover' => [ 'color' => 'var(--main)' ],
      ],
      'titleSize' => 'var(--mediumFontSize)',
      'custom_logo' => '',
      'has_mobile_logo' => 'no',
      'mobile_header_logo' => '',

      'has_tagline' => 'no',
      'site_tagline' => get_option('blogdescription'),
      'taglineColor' => [
        'default' => [ 'color' => 'var(--textDim)' ]
      ],
      'taglineSize' => 'var(--smallFontSize)',
    ],

    // BUTTON
    'button' => $button_values,
    'button2' => $button_values,

    // FREE TEXT
    'free-text' => $free_text_values,
    'free-text2' => $free_text_values,

    // SEARCH
    'search' => [
      'search_style' => 'full',
      'search_placeholder' => __( 'Search...' ),
      
      'submit_button_text' => '<svg viewBox="0 0 512 512"><path d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"/></svg>',
      'submitButtonColor' => [
        'default' => [ 'color' => 'var(--textInvert)' ],
        'hover' => [ 'color' => 'var(--textInvert)' ],
      ],
      'submitButtonBackground' => [
        'default' => [ 'color' => 'var(--text)' ],
        'hover' => [ 'color' => 'var(--main)' ],
      ],

      'searchBackground' => [
        'default' => [ 'color' => 'var(--textInvert)' ],
        'focus' => [ 'color' => 'var(--textInvert)' ],
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
        'icon' => [ 'color' => 'var(--textInvert)' ],
        'background' => [ 'color' => 'var(--main)' ]
      ],
      'icon_style' => 'circle',
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