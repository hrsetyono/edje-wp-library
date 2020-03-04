<?php


// 
$item = [
  'title' => __( 'Logo' ),
  'options' => [

    'logo_type' => [
      'label' => __( 'Logo Type' ),
      'type' => 'ct-radio',
      'view' => 'text',
      'choices' => [
        'text' => __( 'Text' ),
        'image' => __( 'Image' ),
        'svg' => __( 'SVG' )
      ],
    ],

    // TEXT LOGO
    custy_rand_id() => [ 'condition' => [ 'logo_type' => 'text' ], 'options' => [

      'text' => [
        'label' => __( 'Text' ),
        'type' => 'text',
      ],

      'textSize' => [
        'label' => __( 'Text Size' ),
        'type' => 'ct-select/text',
        'css' => '--textSize'
      ],

    ] ],

    // SVG LOGO
    custy_rand_id() => [ 'condition' => [ 'logo_type' => 'svg' ], 'options' => [

      'svg_code' => [
        'label' => __( 'SVG Code' ),
        'desc' => __( 'Paste in raw SVG Code here' ),
        'type' => 'textarea',
        'disableRevertButton' => true,
        'attr' => [ 'placeholder' => '<svg> ... </svg>' ]
      ],

    ] ],

    // IMAGE LOGO
    custy_rand_id() => [ 'condition' => [ 'logo_type' => 'image' ], 'options' => [

      'image' => [
        'label' => __( 'Image' ),
        'type' => 'ct-image-uploader',
        'disableRevertButton' => true,
        'attr' => [ 'data-height' => 'small' ],
      ],

      'has_mobile_image' => [
        'label' => __( 'Has Mobile Image?' ),
        'type' => 'ct-switch',
      ],

      custy_rand_id() => [ 'condition' => [ 'has_mobile_image' => 'yes' ], 'options' => [

        'mobile_image' => [
          'label' => __( 'Mobile Image' ),
          'type' => 'ct-image-uploader',
          // 'switchDeviceOnChange' => 'mobile',
          'disableRevertButton' => true,
          'attr' => [ 'data-height' => 'small' ],
        ],
        

      ] ],

    ] ],

    custy_rand_id() => [ 'divider' => '' ],

    // COLOR
    custy_rand_id() => [ 'condition' => [ 'logo_type' => 'text|svg' ], 'options' => [

      'logoColor' => [
        'label' => __( 'Color' ),
        'type'  => 'ct-color-picker',
        'pickers' => [
          'default' => __( 'Default' ),
          'hover' => __( 'Hover' ),
        ],
        'css' => [
          '--logoColor' => 'default',
          '--logoColorHover' => 'hover'
        ]
      ],

    ] ],

    // MAX WIDTH
    custy_rand_id() => [ 'condition' => [ 'logo_type' => 'svg' ], 'options' => [
      'logoMaxWidth' => [
        'label' => __( 'Max Width' ),
        'type' => 'ct-slider',
        'responsive' => true,
        'units' => [
          'px' => [ 'min' => 40, 'max' => 320 ]
        ],
        'css' => '--logoMaxWidth'
      ]
    ] ],

    // MAX HEIGHT
    custy_rand_id() => [ 'condition' => [ 'logo_type' => 'image|svg' ], 'options' => [
      'logoMaxHeight' => [
        'label' => __( 'Max Height' ),
        'type' => 'ct-slider',
        'responsive' => true,
        'units' => [
          'px' => [ 'min' => 20, 'max' => 160 ],
        ],
        'css' => '--logoMaxHeight'
      ],
    ] ],

    custy_rand_id() => [ 'divider' => '' ],

    
    // TAGLINE
    'has_tagline' => [
      'label' => __( 'Has Tagline?' ),
      'type' => 'ct-switch',
    ],

    custy_rand_id() => [ 'condition' => [ 'has_tagline' => 'yes' ], 'options' => [

      'tagline' => [
        'label' => __( 'Tagline' ),
        'type' => 'text',
      ],

      'taglineColor' => [
        'label' => __( 'Color' ),
        'type'  => 'ct-color-picker',
        'pickers' => [
          'default' => __( 'Default' ),
        ],
        'css' => [
          '--taglineColor' => 'default',
        ]
      ],

      'taglineSize' => [
        'label' => __( 'Size' ),
        'type' => 'ct-select/text',
        'css' => '--taglineSize'
      ],

      'tagline_visibility' => [
        'label' => __( 'Visibility' ),
        'type' => 'ct-visibility',
      ],

    ] ],


    
  ]
  
];