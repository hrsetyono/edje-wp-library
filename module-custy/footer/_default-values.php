<?php

/**
 * Add default values for Footer items
 */
add_filter( 'custy_footer_default_values', function( $defaults ) {
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

  $defaults = wp_parse_args( [
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
      'widget' => 10,
    ],
    'widget-area-2' => [
      'widget' => 12,
    ],

    'socials' => [
      'footer_socials' => [
        [
          'id' => 'facebook',
          'enabled' => true,
        ],
        [
          'id' => 'twitter',
          'enabled' => true,
        ],
        [
          'id' => 'instagram',
          'enabled' => true,
        ],
      ]
    ],
  
  ], $defaults );

  // FOOTER PLACEMENTS
  $placements = [ 'footer_placements' => [
    'current_section' => 'type-1',
    'sections' => [ [
      'id' => 'type-1',
      'mode' => 'columns',
      'items' => [
        [ 'id' => 'menu', 'values' => $defaults['menu'] ],
        [ 'id' => 'copyright', 'values' => $defaults['copyright'] ],
        [ 'id' => 'top-row', 'values' => $defaults['top-row'] ],
        [ 'id' => 'middle-row', 'values' => $defaults['middle-row'] ],
        [ 'id' => 'bottom-row', 'values' => $defaults['bottom-row'] ],
      ],
      'rows' => [
        [ 'id' => 'top-row', 'columns' => [] ],
        [ 'id' => 'middle-row', 'columns' => [
          [ 'logo' ],
          [ 'menu' ]
        ] ],
        [ 'id' => 'bottom-row', 'columns' => [
          [ 'copyright' ]
        ] ],
      ],
    ] ],
  ] ];

  return array_merge( $defaults, $placements );
} );