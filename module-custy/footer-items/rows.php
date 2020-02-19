<?php

$row_options = [
  custy_rand_id() => [ 'tab' => __( 'Columns' ), 'options' => [

    'items_per_row' => [
      'label' => __( 'Items per Row' ),
      'type' => 'ct-radio',
      'design' => 'block',
      'allow_empty' => true,
      'choices' => [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
      ],
    ],

    custy_rand_id() => [ 'condition' => [ 'items_per_row' => '2' ], 'options' => [

      '2_columns_layout' => [
        'label' => __( 'Columns Layout' ),
        'type' => 'ct-image-picker',
        'attr' => [
          'data-type' => 'background',
          'data-columns' => '2',
        ],
        'responsive' => [
          'desktop' => true,
          'tablet' => true,
          'mobile' => false
        ],
        'divider' => 'top',
        'disabledDeviceMessage' => __( 'All columns on mobile are stacked and have 100% width.' ),
        
        'choices' => [
          'repeat(2, 1fr)' => [
            'src' => blocksy_image_picker_file( '1-1' ),
          ],
          '2fr 1fr' => [
            'src' => blocksy_image_picker_file( '2-1' ),
          ],
          '1fr 2fr' => [
            'src' => blocksy_image_picker_file( '1-2' ),
          ],
          '3fr 1fr' => [
            'src' => blocksy_image_picker_file( '3-1' ),
          ],
          '1fr 3fr' => [
            'src' => blocksy_image_picker_file( '1-3' ),
          ],
        ],

        'tabletChoices' => [
          'initial' => [
            'src' => blocksy_image_picker_file( 'stacked' ),
            'title' => __( 'Stacked' ),
          ],

          'repeat(2, 1fr)' => [
            'src' => blocksy_image_picker_file( '1-1' ),
            'title' => __( 'Two Columns' ),
          ],
        ],

        'mobileChoices' => [],
      ] ],
    ],

    custy_rand_id() => [ 'condition' => [ 'items_per_row' => '3' ], 'options' => [

      '3_columns_layout' => [
        'label' => __( 'Columns Layout' ),
        'type' => 'ct-image-picker',
        'attr' => [
          'data-type' => 'background',
          'data-columns' => '2',
        ],
        'responsive' => [
          'desktop' => true,
          'tablet' => true,
          'mobile' => false,
        ],
        'divider' => 'top',
        'disabledDeviceMessage' => __( 'All columns on mobile are stacked and have 100% width.' ),
        'choices' => [
          'repeat(3, 1fr)' => [
            'src' => blocksy_image_picker_file( '1-1-1' ),
          ],
          '1fr 2fr 1fr' => [
            'src' => blocksy_image_picker_file( '1-2-1' ),
          ],
          '2fr 1fr 1fr' => [
            'src' => blocksy_image_picker_file( '2-1-1' ),
          ],
          '1fr 1fr 2fr' => [
            'src' => blocksy_image_picker_file( '1-1-2' ),
          ],
        ],

        'tabletChoices' => [
          'initial' => [
            'src' => blocksy_image_picker_file( 'stacked' ),
            'title' => __( 'Stacked'  ),
          ],
          'repeat(2, 1fr)' => [
            'src' => blocksy_image_picker_file( '1-1' ),
            'title' => __( 'Two Columns' ),
          ],
        ],

        'mobileChoices' => [],
      ] ],
    ],

    custy_rand_id() => [ 'condition' => [ 'items_per_row' => '4' ], 'options' => [

      '4_columns_layout' => [
        'label' => __( 'Columns Layout' ),
        'type' => 'ct-image-picker',
        'attr' => [
          'data-type' => 'background',
          'data-columns' => '2',
        ],
        'responsive' => [
          'mobile' => false
        ],
        'divider' => 'top',
        'disabledDeviceMessage' => __( 'All columns on mobile are stacked and have 100% width.' ),
        'choices' => [
          'repeat(4, 1fr)' => [
            'src'   => blocksy_image_picker_file( '1-1-1-1' ),
          ],

          '2fr 1fr 1fr 1fr' => [
            'src'   => blocksy_image_picker_file( '2-1-1-1' ),
          ],

          '1fr 1fr 1fr 2fr' => [
            'src'   => blocksy_image_picker_file( '1-1-1-2' ),
          ],
        ],

        'tabletChoices' => [
          'initial' => [
            'src' => blocksy_image_picker_file( 'stacked' ),
            'title' => __( 'Stacked' ),
          ],
          'repeat(2, 1fr)' => [
            'src' => blocksy_image_picker_file( '1-1' ),
            'title' => __( 'Two Columns' ),
          ],
        ],

        'mobileChoices' => [],
      ] ],
    ],

    custy_rand_id() => [ 'divider' => '' ],

    'footerItemsGap' => [
      'label' => __( 'Items Gap' ),
      'type' => 'ct-slider',
      'responsive' => [
        'tablet' => false
      ],
      'desc' => __( 'Space between columns, elements and widgets.' ),
      'units' => [
        'px' => [ 'min' => 0, 'max' => 50 ],
        'rem' => [ 'min' => 0, 'max' => 4 ]
      ],
      'css' => '--footerItemsGap'
    ],

  ] ]
];

$items = [
  'top-row' => [
    'title' => __( 'Top Row' ),
    'is_primary' => true,
    'css_selector' => '[data-footer-row="top-row"]',
    'options' => $row_options,
  ],
  'middle-row' => [
    'title' => __( 'Middle Row' ),
    'is_primary' => true,
    'css_selector' => '[data-footer-row="middle-row"]',
    'options' => $row_options,
  ],
  'bottom-row' => [
    'title' => __( 'Bottom Row' ),
    'is_primary' => true,
    'css_selector' => '[data-footer-row="bottom-row"]',
    'options' => $row_options,
  ],
];