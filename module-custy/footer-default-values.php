<?php

add_filter( 'custy_footer_default_values', '_custy_footer_default_values' );
add_filter( 'custy_footer_default_values', '_custy_footer_placement_default_values' );

/**
 * Add default values for Footer items
 */
function _custy_footer_default_values( $defaults ) {
  $row_values = [
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

  return wp_parse_args( [
    'top-row' => $row_values,
    'middle-row' => $row_values,
    'bottom-row' => $row_values,

    'menu' => [
      'menu' => blocksy_get_default_menu(),
    ],

    'copyright' => [
      'copyright_text' => __( 'Copyright &copy; {current_year} {site_title} - Powered by {theme_author}' ),
    ],
  
  ], $defaults );
}


/**
 * Add default values for Footer placement
 */
function _custy_footer_placement_default_values( $defaults ) {

  return wp_parse_args( [
    
    'footer_placements' => [
      'current_section' => 'type-1',
      'sections' => [ [
        'id' => 'type-1',
        'mode' => 'placements',
        'items' => [
          [ 'id' => 'menu', 'values' => $defaults['menu'] ],
          [ 'id' => 'copyright', 'values' => $defaults['copyright'] ],
          [ 'id' => 'top-row', 'values' => $defaults['top-row'] ],
          [ 'id' => 'middle-row', 'values' => $defaults['middle-row'] ],
          [ 'id' => 'bottom-row', 'values' => $defaults['bottom-row'] ],
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
          [ 'id' => 'top-row', 'placements' => [] ],
          [ 'id' => 'middle-row', 'placements' => [
            [ 'id' => 'start', 'items' => [ 'logo' ] ],
            [ 'id' => 'middle', 'items' => [] ],
            [ 'id' => 'end', 'items' => [ 'trigger' ] ],
            [ 'id' => 'start-middle', 'items' => [] ],
            [ 'id' => 'end-middle', 'items' => [] ],
          ] ],
          [ 'id' => 'bottom-row', 'placements' => [] ],
        ],
      ] ],
    ],
  
  ], $defaults );
}