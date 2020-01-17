<?php

add_filter( 'custy_default_values', '_h_header_defaults' );
add_filter( 'custy_default_values', '_h_header_placement_defaults' );

/**
 * Add default values for Header items
 */
function _h_header_defaults( $defaults ) {
  return wp_parse_args( [

    'offcanvas' => [
      'offcanvasBackground' => blocksy_background_default_value([
        'backgroundColor' => [
          'default' => [ 'color' => 'rgba(18, 21, 25, 0.98)' ],
        ],
      ]),
      'offcanvasShadow' => 'var(--shadow2)'
    ],

    'header_menu' => [
      'menu' => blocksy_get_default_menu(),
    ],
  
    'header_logo' => [
      'logo_type' => 'text',
      'blogname' => get_option('blogname'),
      'custom_logo' => '',
      'has_mobile_logo' => 'no',
      'mobile_header_logo' => '',
      'has_tagline' => 'no',
      'blogdescription' => get_option('blogdescription'),
    ],
  
    'header_button' => [
      'size' => 'medium',
      'text' => __( 'Download' ),
      'link' => '',
      'target' => 'no',
    ],
  
  ], $defaults );
}


/**
 * Add default values for Header placement
 */
function _h_header_placement_defaults( $defaults ) {
  $row_value = [
    'headerRowBackground' => blocksy_background_default_value([
      'backgroundColor' => [
        'default' => [ 'color' => '#ffffff' ],
      ],
    ]),
    'headerRowBorder' => [
      'width' => 1,
      'style' => 'none',
      'color' => [ 'color' => 'rgba(44,62,80,0.2)' ],
    ],
    'headerRowPadding' => [
      'top' => '0.25rem',
      'right' => 'auto',
      'bottom' => '0.25rem',
      'left' => 'auto',
      'linked' => true
    ]
  ];

  return wp_parse_args( [
    
    'header_placements' => [
      'current_section' => 'type-1',
      'sections' => [ [
        'id' => 'type-1',
        'mode' => 'placements',
        'items' => [
          [ 'id' => 'menu', 'values' => $defaults['header_menu'] ],
          [ 'id' => 'logo', 'values' => $defaults['header_logo'] ],
          [ 'id' => 'top-row', 'values' => $row_value ],
          [ 'id' => 'middle-row', 'values' => $row_value ],
          [ 'id' => 'bottom-row', 'values' => $row_value ],
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
    ],
  
  ], $defaults );
}