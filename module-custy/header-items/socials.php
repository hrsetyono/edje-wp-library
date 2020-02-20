<?php

$item = [
  'title' => __( 'Socials' ),
  'css_selector' => '[data-id="socials"]',
  'options' => [

    'social_links' => [
      'label' => __( 'Social Links' ),
      'type' => 'ct-layers',
      'manageable' => true,
      'desc' => __( 'You can configure social links in Customizer > Social Accounts.' ),
      'settings' => custy_get_social_list(),
    ],

    custy_rand_id() => [ 'divider' => '' ],

    'icon_color' => [
      'label' => __( 'Icon Color' ),
      'type' => 'ct-radio',
      'choices' => [
        'custom' => __( 'Custom' ),
        'official' => __( 'Official' ),
      ],
    ],

    custy_rand_id() => [ 'condition' => [ 'icon_color' => 'custom' ], 'options' => [
      'customColor' => [
        'label' => __( 'Custom Color' ),
        'type'  => 'ct-color-picker',
        'pickers' => [
          'default' => __( 'Default' ),
        ],
        'css' => [
          '--iconColor' => 'default'
        ],
      ],
    ] ],

    custy_rand_id() => [ 'divider' => '' ],

    'icon_style' => [
      'label' => __( 'Icon Style' ),
      'type' => 'ct-radio',
      'choices' => [
        'none' => __( 'Icon Only' ),
        'circle' => __( 'Circle' ),
        'square' => __( 'Square' ),
      ],
    ],

    'show_text' => [
      'label' => __( 'Show Text?' ),
      'type' => 'ct-switch',
    ],

  ]
];