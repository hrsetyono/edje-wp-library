<?php

$list = custy_get_social_list();

// Without divider
$clean_list = array_filter( $list, function( $item ) {
  return !isset( $item['divider'] );
} );

// Parse each item into Social Link option
$social_links = array_map( function( $item ) {
  if( isset( $item['divider'] ) ) {
    return $item;
  }

  return [
    'label' => $item['label'],
    'type' => 'text',
    'value' => '',
    'attr' => [ 'placeholder' => $item['placeholder'] ],
    'disableRevertButton' => true,
  ];
}, $list );

// Parse each item into Social Label option
$social_texts = array_reduce( array_keys( $list ), function( $result, $key ) use ( $list ) {
  
  if( isset( $list[ $key ]['divider'] ) ) {
    $result[ custy_rand_id() ] = [ 'divider' => '' ];
  }
  else {
    $item = $list[ $key ];

    $result[ $key . '_label' ] = [
      'label' => $item['label'],
      'design' => 'inline',
      'type' => 'text',
      'value' => $item['label'],
    ];  
  }

  return $result;
}, [] );


$social_options = [
  custy_rand_id() => [ 'tab' => 'Links', 'options' => array_merge( [
    'social_links' => [
      'label' => __( 'Social Links' ),
      'type' => 'ct-layers',
      'manageable' => true,
      'desc' => __( 'Fill in the links below' ),
      'settings' => $clean_list,
    ],
  ], $social_links ) ],

  custy_rand_id() => [ 'tab' => 'Design', 'options' => [
    'icon_color' => [
      'label' => __( 'Icon Color' ),
      'type' => 'ct-radio',
      'choices' => [
        'custom' => __( 'Custom' ),
        'official' => __( 'Official' ),
      ],
    ],

    'icon_style' => [
      'label' => __( 'Icon Style' ),
      'type' => 'ct-radio',
      'choices' => [
        'icon-only' => __( 'Icon Only' ),
        'circle' => __( 'Circle' ),
        'square' => __( 'Square' ),
      ],
    ],

    custy_rand_id() => [ 'condition' => [ 'icon_color' => 'custom' ], 'options' => [
      'customColor' => [
        'label' => __( 'Custom Color' ),
        'type'  => 'ct-color-picker',
        'pickers' => [
          'icon' => __( 'Icon' ),
          'background' => [
            'title' => __( 'Background' ),
            'condition' => [ 'icon_style' => '!none' ]
          ],
        ],
        'css' => [
          '--iconColor' => 'icon',
          '--iconBackground' => 'background'
        ],
      ],
    ] ],

    // custy_rand_id() => [ 'condition' => [ 'icon_color' => 'custom' ], 'options' => [
    //   'customColor' => [
    //     'label' => __( 'Custom Color' ),
    //     'type'  => 'ct-color-picker',
    //     'pickers' => [
    //       'default' => __( 'Default' ),
    //     ],
    //     'css' => [
    //       '--iconColor' => 'default'
    //     ],
    //   ],
    // ] ],

    custy_rand_id() => [ 'divider' => '' ],

    'has_text' => [
      'label' => __( 'Has Text?' ),
      'type' => 'ct-switch',
    ],

    custy_rand_id() => [ 'condition' => [ 'has_text' => 'yes' ], 'options' => array_merge( [
      'text_visibility' => [
        'label' => __( 'Text Visibility' ),
        'type' => 'ct-visibility',
      ],
      custy_rand_id() => [ 'divider' => '' ],
    ], $social_texts ) ],

  ] ],
];

$items = [
  'social' => [
    'title' => __( 'Social' ),
    'css_selector' => '[data-id="social"]',
    'options' => $social_options,
  ],
];