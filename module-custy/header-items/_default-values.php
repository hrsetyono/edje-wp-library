<?php

/**
 * Add default values for Header items
 * 
 * @filter custy_default_values
 */
function _custy_header_default_values( $defaults ) {
  $row_values = [
    'rowColor' => [
      'default' => [ 'color' => 'var(--text)' ],
      'hover' => [ 'color' => 'var(--main)' ]
    ],
    'rowBackground' => blocksy_background_default_value([
      'backgroundColor' => [
        'default' => [ 'color' => '#ffffff' ],
      ],
    ]),
    'rowBorder' => [
      'width' => 1,
      'style' => 'none',
      'color' => [ 'color' => 'rgba(44,62,80,0.2)' ],
    ],
    'rowPadding' => [
      'top' => '0.25rem',
      'right' => 'auto',
      'bottom' => '0.25rem',
      'left' => 'auto',
      'linked' => true
    ]
  ];

  $defaults = wp_parse_args( [
    'top-row' => $row_values,
    'middle-row' => $row_values,
    'bottom-row' => $row_values,
    'offcanvas' => [
      'offcanvasBackground' => blocksy_background_default_value([
        'backgroundColor' => [
          'default' => [ 'color' => 'rgba(18, 21, 25, 0.98)' ],
        ],
      ]),
      'offcanvasShadow' => 'var(--shadow2)'
    ],
    'menu' => [
      'menu' => blocksy_get_default_menu(),
      'header_menu_type' => 'type-1',
    ],

    'logo' => [
      'logo_type' => 'text',
      'site_title' => get_option('blogname'),
      'site_description' => get_option('blogdescription'),
      'custom_logo' => '',
      'has_mobile_logo' => 'no',
      'mobile_header_logo' => '',
      'has_tagline' => 'no',
    ],

    'button' => [
      'size' => 'medium',
      'text' => __( 'Download' ),
      'link' => '',
      'target' => 'no',
    ],

    'search' => [
      'search_placeholder' => __( 'Search...' ),
      'searchPadding' => [
        'top' => '10px',
        'right' => '5px',
        'bottom' => '10px',
        'left' => '5px',
      ],
    ],

    ///// MOBILE
    
    'mobile-menu' => [
      'menu' => blocksy_get_default_menu(),
    ],

    'trigger' => [
      'mobile_menu_trigger_type' => 'type-1'
    ],
  
  ], $defaults );

  // PLACEMENTS
  $defaults = wp_parse_args( [ 'header_placements' => [
    'current_section' => 'type-1',
    'sections' => [ [
      'id' => 'type-1',
      'mode' => 'placements',
      'items' => [
        [ 'id' => 'menu', 'values' => $defaults['menu'] ],
        [ 'id' => 'logo', 'values' => $defaults['logo'] ],
        [ 'id' => 'top-row', 'values' => $defaults['top-row'] ],
        [ 'id' => 'middle-row', 'values' => $defaults['middle-row'] ],
        [ 'id' => 'bottom-row', 'values' => $defaults['bottom-row'] ],
        [ 'id' => 'offcanvas', 'values' => $defaults['offcanvas'] ],
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
    ] ],
  ] ], $defaults );


  return $defaults;
}