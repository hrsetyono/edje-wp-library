<?php

/**
 * Add default values for Footer items
 * 
 * @filter custy_default_values
 */
function _custy_footer_default_values( $defaults ) {

  $row_values = [
    'items_per_row' => '2',
    '2_columns_layout' => [
      'desktop' => 'repeat(2, 1fr)',
      'tablet' => 'stacked',
    ],
    '3_columns_layout' => [
      'desktop' => 'repeat(3, 1fr)',
      'tablet' => 'stacked',
    ],
    '4_columns_layout' => [
      'desktop' => 'repeat(4, 1fr)',
      'tablet' => 'stacked',
    ],
    'row_visibility' => [
      'desktop' => true,
      'tablet' => true,
      'mobile' => true
    ],

    //
    'rowBackground' => blocksy_background_default_value([
      'background_type' => 'color',
      'backgroundColor' => [
        'default' => [ 'color' => 'var(--text)' ],
      ],
    ]),
    'rowTextColor' => [
      'default' => [ 'color' => 'var(--textInvert)' ],
      'hover' => [ 'color' => 'var(--mainLight)' ]
    ],
    'rowTextSize' => 'var(--fontSize)',
    'row_padding' => 'small',
    'row_alignment' => 'left'

  ];

  
  $defaults = wp_parse_args( [ 'footer' => [
    'top-row' => wp_parse_args( [
      'items_per_row' => 1,
      'row_alignment' => 'center'
    ], $row_values ),
    
    'middle-row' => wp_parse_args( [
      'items_per_row' => 2,
      '2_columns_layout' => [
        'desktop' => '1fr 2fr',
        'tablet' => 'stacked',
      ],
      'row_padding' => 'large',
    ], $row_values ),
    
    'bottom-row' => wp_parse_args( [
      'items_per_row' => 1,
      'rowTextSize' => 'var(--smallFontSize)',
      'row_alignment' => 'center'
    ], $row_values ),

    'menu' => [
      'menu' => blocksy_get_default_menu(),
      'menu_style' => 'only-parent',
    ],

    'copyright' => [
      'copyright_text' => __( 'Copyright &copy; [current-year] - [site-title]' ),
    ],

    'widget-area-1' => [
      'widget' => 'ct-footer-sidebar-1',
      'widgetTextColor' => [
        'default' => [ 'color' => 'var(--text)' ],
        'hover' => [ 'color' => 'var(--mainLight)' ],
      ]
    ],
    'widget-area-2' => [
      'widget' => 'ct-footer-sidebar-2',
    ],
    'widget-area-3' => [
      'widget' => 'ct-footer-sidebar-3',
    ],
    'widget-area-4' => [
      'widget' => 'ct-footer-sidebar-4',
    ],

    'social' => [
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
      'has_label' => 'no',
      'label_visibility' => [
        'desktop' => true,
        'tablet' => false,
        'mobile' => false
      ],
    ],
  
  ] ], $defaults );

  // FOOTER PLACEMENTS
  $defaults = wp_parse_args([ 'footer_placements' => [
    'current_section' => 'main',
    'sections' => [ [
      'id' => 'main',
      'label' => __( 'Main Footer' ),
      'mode' => 'columns',
      'settings' => [],
      'items' => [
        [ 'id' => 'menu', 'values' => $defaults['footer']['menu'] ],
        [ 'id' => 'social', 'values' => $defaults['footer']['social'] ],
        [ 'id' => 'copyright', 'values' => $defaults['footer']['copyright'] ],
        
        [ 'id' => 'top-row', 'values' => $defaults['footer']['top-row'] ],
        [ 'id' => 'middle-row', 'values' => $defaults['footer']['middle-row'] ],
        [ 'id' => 'bottom-row', 'values' => $defaults['footer']['bottom-row'] ],
      ],
      'rows' => [
        [ 'id' => 'top-row', 'columns' => [
          [ 'social' ]
        ] ],
        [ 'id' => 'middle-row', 'columns' => [
          [ 'widget-area-1' ],
          [ 'menu' ],
        ] ],
        [ 'id' => 'bottom-row', 'columns' => [
          [ 'copyright' ]
        ] ],
      ],
    ] ],
  ] ], $defaults );

  return $defaults;
}