<?php

$header = new Blocksy_Customizer_Builder_Header();
$section = [
  'title' => __( 'Header' ),
  'container' => [ 'priority' => 3 ],
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
          'selector' => '#header',
          'settings' => [ 'header_placements' ],
          'render_callback' => function () {
            echo CustyBuilder::render( 'header', get_theme_mod( 'header_placements' ) );
          }
        ],
        // [
        //   'id' => 'header_placements_item:button',
        //   'fallback_refresh' => false,
        //   'container_inclusive' => true,
        //   'selector' => '#header [data-id="button"]',
        //   'settings' => [ 'header_placements' ],
        //   'render_callback' => function () {
        //     echo 'Button';
        //     // $b = new Blocksy_Customizer_Builder_Render_Placements();
        //     // echo $b->render_single_item('button');
        //   }
        // ]
      ],
      // 'selective_refresh' => [
      //   [
      //     'id' => 'header_placements_1',
      //     'fallback_refresh' => false,
      //     'container_inclusive' => true,
      //     'selector' => '.site-header[data-visible="desktop"]',
      //     'settings' => ['header_placements'],
      //     'render_callback' => function () {
      //       $header = new Blocksy_Customizer_Builder_Header();
      //       echo $header->render('desktop');
      //     }
      //   ],

      //   [
      //     'id' => 'header_placements_2',
      //     'fallback_refresh' => false,
      //     'container_inclusive' => true,
      //     'selector' => '.site-header[data-visible="mobile"]',
      //     'settings' => ['header_placements'],
      //     'render_callback' => function () {
      //       $header = new Blocksy_Customizer_Builder_Header();
      //       echo $header->render('mobile');
      //     }
      //   ],

      //   [
      //     'id' => 'header_placements_offcanvas',
      //     'fallback_refresh' => false,
      //     'container_inclusive' => true,
      //     'selector' => '#offcanvas .content-container',
      //     'settings' => ['header_placements'],
      //     'render_callback' => function () {
      //       $builder = new Blocksy_Customizer_Builder_Header();
      //       echo $builder->render_offcanvas('mobile', false);
      //     }
      //   ],

      //   [
      //     'id' => 'header_placements_item:menu',
      //     'fallback_refresh' => false,
      //     'container_inclusive' => true,
      //     'selector' => '.site-header [data-item="menu"]',
      //     'settings' => ['header_placements'],
      //     'render_callback' => function () {
      //       $header = new Blocksy_Customizer_Builder_Render_Placements();
      //       echo $header->render_single_item('menu');
      //     }
      //   ],

      //   [
      //     'id' => 'header_placements_item:menu-secondary',
      //     'fallback_refresh' => false,
      //     'container_inclusive' => true,
      //     'selector' => '.site-header [data-item="menu-secondary"]',
      //     'settings' => ['header_placements'],
      //     'render_callback' => function () {
      //       $header = new Blocksy_Customizer_Builder_Render_Placements();
      //       echo $header->render_single_item('menu-secondary');
      //     }
      //   ],

      //   [
      //     'id' => 'header_placements_item:mobile-menu',
      //     'fallback_refresh' => false,
      //     'container_inclusive' => true,
      //     'selector' => '#offcanvas [data-item="mobile-menu"]',
      //     'settings' => ['header_placements'],
      //     'render_callback' => function () {
      //       $header = new Blocksy_Customizer_Builder_Render_Placements();
      //       echo $header->render_single_item('mobile-menu');
      //     }
      //   ],

      //   [
      //     'id' => 'header_placements_item:logo:desktop',
      //     'fallback_refresh' => false,
      //     'container_inclusive' => true,
      //     'selector' => '.site-header[data-visible="desktop"] [data-item="logo"]',
      //     'settings' => ['header_placements'],
      //     'render_callback' => function () {
      //       $b = new Blocksy_Customizer_Builder_Render_Placements();
      //       echo $b->render_single_item('logo');
      //     }
      //   ],

      //   [
      //     'id' => 'header_placements_item_mobile:logo:mobile',
      //     'fallback_refresh' => false,
      //     'container_inclusive' => true,
      //     'selector' => '.site-header[data-visible="mobile"] [data-item="logo"]',
      //     'settings' => ['header_placements'],
      //     'render_callback' => function () {
      //       $b = new Blocksy_Customizer_Builder_Render_Placements(
      //         'mobile'
      //       );
      //       echo $b->render_single_item('logo');
      //     }
      //   ]
      // ],
    ],
  ]
];