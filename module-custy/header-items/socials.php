<?php
$list = custy_get_social_list();

// TODO: Find a way to hide the social media that's not selected
$links_field = array_map( function( $item ) {
  return [
    'label' => $item['label'],
    'type' => 'text',
    'value' => '',
    'attr' => [ 'placeholder' => $item['default_value'] ],
    'disableRevertButton' => true,
  ];
}, $list );


$links_label = array_reduce( array_keys( $list ), function( $result, $key ) use ( $list ) {
  $item = $list[ $key ];

  $result[ $key . '_label' ] = [
    'label' => $item['label'],
    'design' => 'inline',
    'type' => 'text',
    'value' => $item['label'],
  ];

  return $result;
}, [] );

$links_tab = array_merge( [
  'social_links' => [
    'label' => __( 'Social Links' ),
    'type' => 'ct-layers',
    'manageable' => true,
    'desc' => __( 'Fill in the links below' ),
    'settings' => custy_get_social_list(),
  ],
], $links_field );


$item = [
  'title' => __( 'Socials' ),
  'css_selector' => '[data-id="socials"]',
  'options' => [

    custy_rand_id() => [ 'tab' => 'Links', 'options' => $links_tab ],

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
          'none' => __( 'Icon Only' ),
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
  
      'show_text' => [
        'label' => __( 'Show Text?' ),
        'type' => 'ct-switch',
      ],

      custy_rand_id() => [ 'condition' => [ 'show_text' => 'yes' ], 'options' => $links_label ],

    ] ],

  ]
];