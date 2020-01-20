<?php

/**
 * Set default options: Core, Header, and Footer
 * @filter custy_sections 1
 */
function _custy_set_default_sections( $sections ) {
  $textUnits = [
    'px' => [ 'min' => 12, 'max' => 32, ],
    'rem' => [ 'min' => 0, 'max' => 2 ],
    'em' => [ 'min' => 0, 'max' => 2 ],
  ];
  $headingUnits = [
    'px' => [ 'min' => 14, 'max' => 64, ],
    'rem' => [ 'min' => 0, 'max' => 4 ],
    'em' => [ 'min' => 0, 'max' => 4 ],
  ];
  $footer = new Blocksy_Customizer_Builder_Footer();
  $header = new Blocksy_Customizer_Builder_Header();

  return wp_parse_args( [

    'cores' => [
      'title' => __( 'Core Settings' ),
      'container' => [ 'priority' => 0 ],
      'css_selector' => ':root',
      'options' => [

        // SITE WIDE
        blocksy_rand_md5() => [
        'title' => __( 'General' ), 
        'type' => 'tab',
        'options' => [

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
            'pickers' => [
              'default' => __( 'Text' ),
              'invert' => __( 'Text Invert' ),
            ],
            'css' => [
              '--text' => 'default.color',
              '--textInvert' => 'invert.color',
            ],
          ],

          blocksy_rand_md5() => [ 'type' => 'ct-divider' ],

          'siteBackground' => [
            'label' => __( 'Site Background' ),
            'type' => 'ct-background',
            'css' => '--site$',
          ],

          blocksy_rand_md5() => [
            'label' => __( 'CSS Output' ),
            'desc' => __( 'Adjust the media query for responsive settings' ),
            'type' => 'ct-title'
          ],
    
          'mobile_media' => [
            'label' => __( 'Mobile Media' ),
            'type' => 'ct-slider',
            'units' => [
              'px' => [ 'min' => 320, 'max' => 600 ],
            ],
          ],
      
          'tablet_media' => [
            'label' => __( 'Tablet Media' ),
            'type' => 'ct-slider',
            'units' => [
              'px' => [ 'min' => 700, 'max' => 960 ],
            ],
          ],
        ] ],

        // TYPOGRAPHY
        blocksy_rand_md5() => [
        'title' => __( 'Text' ), 
        'type' => 'tab',
        'options' => [

          'rootTypography' => [
            'label' => __( 'Root Typography' ),
            'type' => 'ct-typography',
            'isDefault' => true,
            'css' => '--$',
          ],

          blocksy_rand_md5() => [ 'type' => 'ct-divider' ],

          'smallFontSize' => [
            'label' => __( 'Small Font Size' ),
            'type' => 'ct-slider',
            'units' => $textUnits,
            'css' => '--smallFontSize',
          ],
          'mediumFontSize' => [
            'label' => __( 'Medium Font Size' ),
            'type' => 'ct-slider',
            'responsive' => true,
            'units' => $textUnits,
            'css' => '--mediumFontSize',
          ],
          'largeFontSize' => [
            'label' => __( 'Large Font Size' ),
            'type' => 'ct-slider',
            'responsive' => true,
            'units' => $textUnits,
            'css' => '--largeFontSize',
          ],
          'hugeFontSize' => [
            'label' => __( 'Huge Font Size' ),
            'type' => 'ct-slider',
            'responsive' => true,
            'units' => $textUnits,
            'css' => '--hugeFontSize',
          ],

          blocksy_rand_md5() => [ 'label' => __( 'Heading' ), 'type' => 'ct-title' ],

          'headingTypography' => [
            'type' => 'ct-typography',
            'label' => __( 'Heading Typography' ),
            'desc' => "Applies to H1-H6. Leave size as 0.",
            'isDefault' => true,
            'css' => '--h$'
          ],

          blocksy_rand_md5() => [ 'type' => 'ct-divider' ],
    
          'h1Size' => [
            'label' => __( 'H1 Size' ),
            'type' => 'ct-slider',
            'responsive' => true,
            'units' => $headingUnits,
            'css' => '--h1Size',
          ],
      
          'h2Size' => [
            'label' => __( 'H2 Size' ),
            'type' => 'ct-slider',
            'responsive' => true,
            'units' => $headingUnits,
            'css' => '--h2Size',
          ],
      
          'h3Size' => [
            'label' => __( 'H3 Size' ),
            'type' => 'ct-slider',
            'responsive' => true,
            'units' => $headingUnits,
            'css' => '--h3Size'
          ],
      
          'h4Size' => [
            'label' => __( 'H4 Size' ),
            'type' => 'ct-slider',
            'responsive' => true,
            'units' => $headingUnits,
            'css' => '--h4Size'
          ],
      
          'h5Size' => [
            'label' => __( 'H5 Size' ),
            'type' => 'ct-slider',
            'responsive' => true,
            'units' => $headingUnits,
            'css' => '--h5Size',
          ],
      
          'h6Size' => [
            'label' => __( 'H6 Size' ),
            'type' => 'ct-slider',
            'responsive' => true,
            'units' => $headingUnits,
            'css' => '--h6Size'
          ],
        ] ],
        
        // SHADOW
        blocksy_rand_md5() => [
        'title' => __( 'Shadow' ),
        'type' => 'tab',
        'options' => [

          'shadow0' => [
            'label' => __( 'Shadow 0' ),
            'type' => 'ct-box-shadow',
            'css' => '--shadow0',
          ],
          'shadow1' => [
            'label' => __( 'Shadow 1' ),
            'type' => 'ct-box-shadow',
            'css' => '--shadow1',
          ],
          'shadow2' => [
            'label' => __( 'Shadow 2' ),
            'type' => 'ct-box-shadow',
            'css' => '--shadow2',
          ],
          'shadow3' => [
            'label' => __( 'Shadow 3' ),
            'type' => 'ct-box-shadow',
            'css' => '--shadow3',
          ],
          'shadow4' => [
            'label' => __( 'Shadow 4' ),
            'type' => 'ct-box-shadow',
            'css' => '--shadow4',
          ],
        
        ] ],

      ],
    ],

    'header' => [
      'title' => __( 'Header' ),
      'container' => [ 'priority' => 0 ],
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
              'selector' => '.site-header[data-device="desktop"]',
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
              'selector' => '.site-header[data-device="mobile"]',
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
              'selector' => '.site-header[data-device] [data-id="menu"]',
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
              'selector' => '.site-header[data-device] [data-id="menu-secondary"]',
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
              'selector' => '.site-header[data-device="desktop"] [data-id="logo"]',
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
              'selector' => '.site-header[data-device="mobile"] [data-id="logo"]',
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
      'container' => [ 'priority' => 0 ],
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
              'selector' => '.site-footer',
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
}