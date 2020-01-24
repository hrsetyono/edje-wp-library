<?php
/**
 * Options list for Header
 */
add_filter( 'custy_header_items', '_custy_set_header_items', 10 );
add_filter( 'custy_header_items', '_custy_format_header_items', 9999, 3 );


/**
 * @filter custy_header_items
 */
function _custy_format_header_items( $items, $include = 'all', $require_options = false ) {
  $filtered_items = [];
  $formatted_items = [];

  /**
   * Filter the relevant items
   */
  foreach( $items as $id => $item ) {
    $id = str_replace('_', '-', $id );

    $is_primary = $item['is_primary'] ?? false;

    // Skip if include primary, but item is not primary
    if( $include === 'primary' && !$is_primary ) {
      continue;
    }
    // Skip if looking for secondary, but item is primary
    elseif( $include === 'secondary' && $is_primary ) {
      continue;
    }

    $filtered_items[ $id ] = $item;
  }

  /**
   * Rearrange the filtered items
   */
  foreach( $filtered_items as $id => $item ) {
    $options = ( $require_options && isset( $item['options'] ) ) ? $item['options'] : [];

    $formatted_items[] = [
      'id' => $id,
      'config' => [],
      'options' => $options,
      'is_primary' => $item['is_primary'] ?? false,
    ];
  }

  return $formatted_items;
}


/**
 * @filter custy_header_items
 */
function _custy_set_header_items( $items ) {
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
  'offcanvas' => [
    'title' => __( 'Offcanvas' ),
    'is_primary' => true,
    'options' => [
      'offcanvasBackground' => [
				'label' => __( 'Background' ),
				'type'  => 'ct-background',
      ],
      
      'offcanvasShadow' => [
        'label' => __( 'Shadow' ),
        'type' => 'ct-select/shadow',
      ],
    ],
  ],

  // BUTTON
  'button' => [
    'title' => __( 'Button' ),
    'options' => [

      'header_button_size' => [
        'label' => __( 'Size' ),
        'type' => 'ct-radio',
        'view' => 'text',
        'divider' => 'bottom',
        'choices' => [
          'small' => __( 'Small' ),
          'medium' => __( 'Medium' ),
          'large' => __( 'Large' ),
        ],
      ],

      'header_button_text' => [
        'label' => __( 'Label' ),
        'type' => 'text',
      ],

      'header_button_link' => [
        'label' => __( 'URL' ),
        'type' => 'text',
        'design' => 'block'
      ],

      'header_button_target' => [
        'label' => __( 'Open in a new tab' ),
        'type'  => 'ct-switch',
        'divider' => 'bottom',
      ],
    ],
  ],

  // LOGO
  'logo' => [
    'title' => __( 'Logo' ),
    'options' => [

      'logo_type' => [
        'label' => __( 'Logo Type' ),
        'type' => 'ct-radio',
        'view' => 'text',
        'allow_empty' => true,
        'choices' => [
          'text' => __( 'Text' ),
          'image' => __( 'Image' ),
        ],
      ],

      blocksy_rand_md5() => [
        'type' => 'ct-condition',
        'condition' => [ 'logo_type' => 'text' ],
        'options' => [

          'blogname' => [
            'label' => __( 'Site Title' ),
            'type' => 'text',
            'design' => 'block',
          ],

        ],
      ],

      blocksy_rand_md5() => [
        'type' => 'ct-condition',
        'condition' => [ 'logo_type' => 'image' ],
        'options' => [

          'custom_logo' => [
            'label' => false,
            'type' => 'ct-image-uploader',
            'attr' => [ 'data-height' => 'small' ],
          ],

        ],
      ],
      
    ],
  ],

  // MENU
  'menu' => [
    'title' => __( 'Menu 1' ),
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
      

], $items );
}