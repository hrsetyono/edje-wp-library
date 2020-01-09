<?php

/**
 * Values for default options
 */
add_filter( 'h_customizer_defaults', function( $defaults ) {
  return wp_parse_args( [

    'colorPalette' => [
      'color1' => [ 'color' => '#1976d2' ],
      'color2' => [ 'color' => '#0d47a1' ],
      'color3' => [ 'color' => '#bbdefb' ],
      'color4' => [ 'color' => '#546e7a' ],
      'color5' => [ 'color' => '#cfd8dc' ],
    ],
    'textColor' => [
      'default' => [ 'color' => '#2c3e50' ],
      'invert' => [ 'color' => '#ffffff' ],
    ],

    'mobile_media' => '480px',
    'tablet_media' => '767px',

  ], $defaults );
});

/**
 * The default options: Color, Header, and Footer
 */
add_filter( 'h_customizer_options', function( $sections ) {

$footer = new Blocksy_Customizer_Builder_Footer();
$header = new Blocksy_Customizer_Builder_Header();

return wp_parse_args( [

  'general' => [
    'title' => __( 'General' ),
    'container' => [ 'priority' => 0 ],
    'css_selector' => ':root',
    'options' => array_merge([

      'colorPalette' => [
        'label' => __( 'COLOR PALETTE' ),
        'type'  => 'ct-color-palettes-picker',
        'css' => [
          '--main' => 'color1.color',
          '--mainDark' => 'color2.color',
          '--mainLight' => 'color3.color',
          '--sub' => 'color4.color',
          '--subLight' => 'color5.color',
        ],
      ],
      
      'textColor' => [
        'label' => __( 'Text Color' ),
        'type'  => 'ct-color-picker',
        'design' => 'inline no-palette',
        'css' => [
          '--text' => 'default.color',
          '--textInvert' => 'invert.color',
        ],
        'pickers' => [
          'default' => __( 'Text' ),
          'invert' => __( 'Text Invert' ),
        ],
      ],

      h_option_title() => __( 'CSS Output' ),

      'mobile_media' => [
        'label' => __( 'Mobile Media' ),
        'desc' => __( 'This only affect the CSS that is printed with customizer' ),
        'type' => 'ct-slider',
        'units' => [
          'px' => [ 'min' => 360, 'max' => 600 ],
        ],
      ],
  
      'tablet_media' => [
        'label' => __( 'Tablet Media' ),
        'type' => 'ct-slider',
        'units' => [
          'px' => [ 'min' => 600, 'max' => 960 ],
        ],
      ],
  
      h_option_divider() => '',

    ], apply_filters( 'h_customizer_general_options', [] ) ),
  ],

  blocksy_rand_md5() => [
    'type' => 'ct-group-title',
    'title' => __( 'Elements' ),
    'priority' => 9,
  ],

  'header' => [
    'title' => __( 'Header' ),
    'container' => [ 'priority' => 9 ],
    'options' => [

      'header_placements' => [
        'type' => 'ct-header-builder',
        'setting' => ['transport' => 'postMessage'],
        'value' => $header->get_default_value(),
        'selective_refresh' => [
          [
            'id' => 'header_placements_1',
            'fallback_refresh' => false,
            'container_inclusive' => true,
            'selector' => '#main-container > header[data-device="desktop"]',
            'settings' => ['header_placements'],
            'render_callback' => function () {
              $header = new Blocksy_Customizer_Builder_Header();
              echo $header->render('desktop');
            }
          ],

          [
            'id' => 'header_placements_2',
            'fallback_refresh' => false,
            'container_inclusive' => true,
            'selector' => '#main-container > header[data-device="mobile"]',
            'settings' => ['header_placements'],
            'render_callback' => function () {
              $header = new Blocksy_Customizer_Builder_Header();
              echo $header->render('mobile');
            }
          ],

          [
            'id' => 'header_placements_offcanvas',
            'fallback_refresh' => false,
            'container_inclusive' => true,
            'selector' => '#offcanvas .content-container',
            'settings' => ['header_placements'],
            'render_callback' => function () {
              $builder = new Blocksy_Customizer_Builder_Header();
              echo $builder->render_offcanvas('mobile', false);
            }
          ],

          [
            'id' => 'header_placements_item:menu',
            'fallback_refresh' => false,
            'container_inclusive' => true,
            'selector' => 'header[data-device] [data-id="menu"]',
            'settings' => ['header_placements'],
            'render_callback' => function () {
              $header = new Blocksy_Customizer_Builder_Render_Placements();
              echo $header->render_single_item('menu');
            }
          ],

          [
            'id' => 'header_placements_item:menu-secondary',
            'fallback_refresh' => false,
            'container_inclusive' => true,
            'selector' => 'header[data-device] [data-id="menu-secondary"]',
            'settings' => ['header_placements'],
            'render_callback' => function () {
              $header = new Blocksy_Customizer_Builder_Render_Placements();
              echo $header->render_single_item('menu-secondary');
            }
          ],

          [
            'id' => 'header_placements_item:mobile-menu',
            'fallback_refresh' => false,
            'container_inclusive' => true,
            'selector' => '#offcanvas [data-id="mobile-menu"]',
            'settings' => ['header_placements'],
            'render_callback' => function () {
              $header = new Blocksy_Customizer_Builder_Render_Placements();
              echo $header->render_single_item('mobile-menu');
            }
          ],

          [
            'id' => 'header_placements_item:logo:desktop',
            'fallback_refresh' => false,
            'container_inclusive' => true,
            'selector' => '[data-device="desktop"] [data-id="logo"]',
            'settings' => ['header_placements'],
            'render_callback' => function () {
              $b = new Blocksy_Customizer_Builder_Render_Placements();
              echo $b->render_single_item('logo');
            }
          ],

          [
            'id' => 'header_placements_item_mobile:logo:mobile',
            'fallback_refresh' => false,
            'container_inclusive' => true,
            'selector' => '[data-device="mobile"] [data-id="logo"]',
            'settings' => ['header_placements'],
            'render_callback' => function () {
              $b = new Blocksy_Customizer_Builder_Render_Placements(
                'mobile'
              );
              echo $b->render_single_item('logo');
            }
          ]
        ],
      ],

      'footer_placements' => [
        'type' => 'hidden',
        'value' => [
          'current_section' => 'type-1',
          'sections' => [
          ]
        ]
      ]
      
    ]
  ],

  'footer' => [
    'title' => __( 'Footer' ),
    'container' => [ 'priority' => 9 ],
    'options' => [

      'footer_placements' => [
        'type' => 'ct-footer-builder',
        'setting' => ['transport' => 'postMessage'],
        'value' => $footer->get_default_value(),
        'selective_refresh' => [
          [
            'id' => 'footer_placements_1',
            'fallback_refresh' => false,
            'container_inclusive' => true,
            'selector' => '#main-container > footer.site-footer',
            'settings' => ['footer_placements'],
            'render_callback' => function () {
              $footer = new Blocksy_Customizer_Builder_Footer();
              echo $footer->render();
            }
          ],

          [
            'id' => 'footer_placements_item:menu',
            'fallback_refresh' => false,
            'container_inclusive' => true,
            'selector' => '.footer-menu',
            'settings' => ['footer_placements'],
            'render_callback' => function () {
              $header = new Blocksy_Customizer_Builder_Render_Columns();
              echo $header->render_single_item('menu');
            }
          ],
        ]
      ],

    ],
  ],

], $sections );
});