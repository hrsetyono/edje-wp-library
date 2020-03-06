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
        'default' => [ 'color' => 'var(--textInvert)' ],
      ],
    ]),
    'row_padding' => 'medium',
  ];

  $menu_values = [
    'menu' => blocksy_get_default_menu(),

    'parentBackground' => [
      'default' => [ 'color' => 'CT_CSS_SKIP_RULE' ],
      'hover' => [ 'color' => 'var(--mainLight)' ],
    ],
    'parentTextColor' => [
      'default' => [ 'color' => 'var(--text)' ],
      'hover' => [ 'color' => 'var(--main)' ],
    ],
    'parentFontSize' => 'var(--fontSize)',

    'dropdownBackground' => [
      'default' => [ 'color' => 'var(--text)' ],
      'hover' => [ 'color' => 'var(--main)' ],
    ],
    'dropdownTextColor' => [
      'default' => [ 'color' => 'var(--textInvert)' ],
      'hover' => [ 'color' => 'var(--textInvert)' ],
    ],
    'dropdownFontSize' => 'var(--smallFontSize)',
  ];

  $mobile_menu_values = [
    'menu' => blocksy_get_default_menu(),
    'mobile_menu_style' => 'default',
    'mobileMenuBackground' => [
      'default' => [ 'color' => 'CT_CSS_SKIP_RULE' ]
    ],
    'mobileMenuTextColor' => [
      'default' => [ 'color' => 'var(--textInvert)' ],
      'hover' => [ 'color' => 'var(--sub)' ],
    ],
    
    'parentFontSize' => 'var(--mediumFontSize)',
    'dropdownFontSize' => 'var(--fontSize)',
  ];

  $button_values = [
    'text' => __( 'Contact Us' ),
    'link' => '',
    'target' => 'no',
    'has_icon' => 'no',
    'png_icon' => [],
    'svg_icon' => '',

    'button_size' => 'small',
    'button_style' => 'outline',
    'buttonBackground' => [
      'default' => [ 'color' => 'var(--main)' ],
      'hover' => [ 'color' => 'var(--mainDark)' ]
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

  $social_values = [
    'social_links' => [
      [ 'id' => 'facebook', 'enabled' => true ],
      [ 'id' => 'twitter', 'enabled' => true ],
      [ 'id' => 'instagram', 'enabled' => true ],
    ],
    'icon_color' => 'official',
    'customColor' => [
      'icon' => [ 'color' => 'var(--textInvert)' ],
      'background' => [ 'color' => 'var(--main)' ]
    ],
    'icon_style' => 'circle',
    'has_text' => 'no',
    'text_visibility' => [
      'desktop' => true,
      'tablet' => false,
      'mobile' => 'false'
    ],
  ];

  $defaults = wp_parse_args( [ 'header' => [
    // ROWS
    'top-row' => $row_values,
    'middle-row' => $row_values,
    'bottom-row' => $row_values,
    
    // OFF CANVAS
    'offcanvas' => [
      'reveal_from' => 'right',
      'offcanvasBackground' => blocksy_background_default_value([
        'backgroundColor' => [
          'default' => [ 'color' => 'var(--text)' ],
        ],
      ]),
      'items_alignment' => 'left',
      'close_button_style' => 'close-circle',
      'closeButtonColor' => [
        'default' => [ 'color' => 'rgba(255,255,255, .5)' ],
        'hover' => [ 'color' => 'white' ],
      ],
    ],

    // MENU
    'menu' => $menu_values,
    'menu2' => $menu_values,

    // LOGO
    'logo' => [
      'logo_type' => 'text',

      // Logo text
      'text' => get_option('blogname'),
      'textSize' => 'var(--mediumFontSize)',
      // Logo Image
      'image' => [ 'attachment_id' => null, 'url' => null ],
      'has_mobile_image' => 'no',
      'mobile_image' => [ 'attachment_id' => null, 'url' => null ],
      // Logo SVG
      'svg_code' => '<svg xmlns="http://www.w3.org/2000/svg" width="70" height="60" viewBox="0 0 452 389"><defs><clipPath id="b"><rect width="452" height="389"/></clipPath></defs><g id="a" clip-path="url(#b)"><rect width="452" height="389" fill="rgba(255,255,255,0)"/><path d="M0-225,225-612,450-225Zm391-32L327.222-368.035,263.406-257ZM59-257H223.1l84.459-145.268L225-546Zm391,32v0Z" transform="translate(1 613)" fill="#fff"/></g></svg>',


      'logoColor' => [
        'default' => [ 'color' => 'var(--text)' ],
        'hover' => [ 'color' => 'var(--main)' ],
      ],
      'logoMaxWidth' => '70px',
      'logoMaxHeight' => '60px',


      'has_tagline' => 'no',
      'tagline' => get_option('blogdescription'),
      'taglineColor' => [
        'default' => [ 'color' => 'var(--textDim)' ]
      ],
      'taglineSize' => 'var(--smallFontSize)',
      'tagline_visibility' => [
        'desktop' => true,
        'tablet' => true,
        'mobile' => false,
      ]
    ],

    // BUTTON
    'button' => $button_values,
    'button2' => $button_values,

    // FREE TEXT
    'free-text' => $free_text_values,
    'free-text2' => $free_text_values,

    // SEARCH
    'search' => [
      'search_style' => 'expanding',
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
    'social' => $social_values,
    
    // MOBILE MENU
    'mobile-menu' => $mobile_menu_values,
    'mobile-menu2' => $mobile_menu_values,

    'trigger' => [
      'trigger_style' => 'trigger-1',
      'triggerColor' => [
        'default' => [ 'color' => 'var(--text)' ],
        'hover' => [ 'color' => 'var(--main)' ],
      ],
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
          [ 'id' => 'social', 'values' => $defaults['header']['social'] ],
          [ 'id' => 'button', 'values' => $defaults['header']['button'] ],
          [ 'id' => 'mobile-menu', 'values' => $defaults['header']['mobile-menu'] ],
          [ 'id' => 'trigger', 'values' => $defaults['header']['trigger'] ],

          [ 'id' => 'top-row', 'values' => [
            'rowBackground' => blocksy_background_default_value([
              'backgroundColor' => [ 'default' => [ 'color' => 'var(--text)' ] ],
            ]),
            'row_padding' => 'small',
          ] ],
          [ 'id' => 'middle-row', 'values' => $defaults['header']['middle-row'] ],
          [ 'id' => 'bottom-row', 'values' => $defaults['header']['bottom-row'] ],
          [ 'id' => 'offcanvas', 'values' => $defaults['header']['offcanvas'] ],
        ],
        'desktop' => [
          [ 'id' => 'top-row', 'placements' => [
            [ 'id' => 'start', 'items' => [ 'social' ] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [ 'button' ] ],
            // [ 'id' => 'start-middle', 'items' => [] ],
            // [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
          [ 'id' => 'middle-row', 'placements' => [
            [ 'id' => 'start', 'items' => [ 'logo' ] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [ 'menu' ] ],
            // [ 'id' => 'start-middle', 'items' => [] ],
            // [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
          [ 'id' => 'bottom-row', 'placements' => [
            [ 'id' => 'start', 'items' => [] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [] ],
            // [ 'id' => 'start-middle', 'items' => [] ],
            // [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
        ],
        'mobile' => [
          [ 'id' => 'top-row', 'placements' => [
            [ 'id' => 'start', 'items' => [] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [ 'social' ] ],
            // [ 'id' => 'start-middle', 'items' => [] ],
            // [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
          [ 'id' => 'middle-row', 'placements' => [
            [ 'id' => 'start', 'items' => [ 'logo' ] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [ 'trigger' ] ],
            // [ 'id' => 'start-middle', 'items' => [] ],
            // [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
          [ 'id' => 'bottom-row', 'placements' => [
            [ 'id' => 'start', 'items' => [] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [] ],
            // [ 'id' => 'start-middle', 'items' => [] ],
            // [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
          [ 'id' => 'offcanvas', 'placements' => [
            [ 'id' => 'start', 'items' => [ 'mobile-menu', 'button' ] ],
          ] ],
        ],
      ],
    ], // sections
  ] ], $defaults );


  return $defaults;
}