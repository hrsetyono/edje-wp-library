<?php

add_filter( 'custy_footer_items', '_custy_set_footer_items', 10 );

function _custy_set_footer_items( $items ) {
  $row_options = [
    'rowBackground' => [
      'label' => __( 'Background' ),
      'type'  => 'ct-background',
    ],
    blocksy_rand_md5() => [ 'type' => 'ct-divider' ],
    'rowBorder' => [
      'label' => __( 'Border' ),
      'type' => 'ct-border',
    ],
    'rowPadding' => [
      'label' => __( 'Padding' ),
      'type' => 'ct-spacing',
      'responsive' => true,
    ],
  ];

  $widget_options = [
    'widget' => [
      'type' => 'ct-widget-area',
      'sidebarId' => $sidebarId
    ]
  ];

  return wp_parse_args( [
  // ROWS
  'top-row' => [
    'title' => __( 'Top Row' ),
    'is_primary' => true,
    'options' => $row_options,
  ],
  'middle-row' => [
    'title' => __( 'Middle Row' ),
    'is_primary' => true,
    'options' => $row_options,
  ],
  'bottom-row' => [
    'title' => __( 'Bottom Row' ),
    'is_primary' => true,
    'options' => $row_options,
  ],

  // COPYRIGHT
  'copyright' => [
    'title' => __( 'Copyright' ),
    'options' => [
      'copyright_text' => [
        'label' => __( 'Copyright text' ),
        'type' => 'wp-editor',
        'desc' => __( 'You can insert some arbitrary HTML code tags: {current_year}, {site_title} and {theme_author}' ),
        
        'disableRevertButton' => true,
        'quicktags' => false,
        'mediaButtons' => false,
        'tinymce' => [
          'toolbar1' => 'bold,italic,link,undo,redo',
        ],
      ],
    ]
  ],

  // MENU
  'menu' => [ 
    'title' => __( 'Footer Menu' ),
    'options' => [

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

    ],
  ],

  'widget-area-1' => [
    'title' => __( 'Widget Area 1' ),
    'options' => [
      'widget' => [
        'type' => 'ct-widget-area',
        'sidebarId' => 'ct-footer-sidebar-1'
      ]
    ]
  ],

  'widget-area-2' => [
    'title' => __( 'Widget Area 2' ),
    'options' => [
      'widget' => [
        'type' => 'ct-widget-area',
        'sidebarId' => 'ct-footer-sidebar-2'
      ]
    ],
  ],

  ], $items );
}