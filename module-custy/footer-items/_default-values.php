<?php

/**
 * Add default values for Footer items
 * 
 * @filter custy_default_values
 */
function _custy_footer_default_values( $defaults ) {
  $row_values = [
    'items_per_row' => '3',
    '2_columns_layout' => [
      'desktop' => 'repeat(2, 1fr)',
      'tablet' => 'initial',
      'mobile' => 'initial'
    ],
    '3_columns_layout' => [
      'desktop' => 'repeat(3, 1fr)',
      'tablet' => 'initial',
      'mobile' => 'initial',
    ],
    '4_columns_layout' => [
      'desktop' => 'repeat(4, 1fr)',
      'tablet' => 'initial',
      'mobile' => 'initial'
    ],
  ];

  $defaults = wp_parse_args( [ 'footer' => [
    'top-row' => $row_values,
    'middle-row' => $row_values,
    'bottom-row' => $row_values,

    'menu' => [
      'menu' => blocksy_get_default_menu(),
    ],

    'copyright' => [
      'copyright_text' => __( 'Copyright &copy; {current_year} {site_title} - Powered by {theme_author}' ),
    ],

    'widget-area-1' => [
      'widget' => null,
    ],
    'widget-area-2' => [
      'widget' => null,
    ],
    'widget-area-3' => [
      'widget' => null,
    ],
    'widget-area-4' => [
      'widget' => null,
    ],

    'socials' => [
      'footer_socials' => [
        [ 'id' => 'facebook', 'enabled' => true ],
        [ 'id' => 'twitter', 'enabled' => true ],
        [ 'id' => 'instagram', 'enabled' => true ],
      ]
    ],
  
  ] ], $defaults );

  // FOOTER PLACEMENTS
  $defaults = wp_parse_args([ 'footer_placements' => [
    'current_section' => 'type-1',
    'sections' => [ [
      'id' => 'type-1',
      'mode' => 'columns',
      'settings' => [],
      'items' => [
        [ 'id' => 'menu', 'values' => $defaults['footer']['menu'] ],
        [ 'id' => 'copyright', 'values' => $defaults['footer']['copyright'] ],
        [ 'id' => 'top-row', 'values' => $defaults['footer']['top-row'] ],
        [ 'id' => 'middle-row', 'values' => $defaults['footer']['middle-row'] ],
        [ 'id' => 'bottom-row', 'values' => $defaults['footer']['bottom-row'] ],
      ],
      'rows' => [
        [ 'id' => 'top-row', 'columns' => [
          [ 'menu' ]
        ] ],
        [ 'id' => 'middle-row', 'columns' => [
          [ 'widget-area-1' ],
          [ 'widget-area-2' ],
          [ 'widget-area-3' ]
        ] ],
        [ 'id' => 'bottom-row', 'columns' => [
          [ 'copyright' ]
        ] ],
      ],
    ] ],
  ] ], $defaults );

  return $defaults;
}