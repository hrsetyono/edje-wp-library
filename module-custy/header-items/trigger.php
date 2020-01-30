<?php

$item = [
  'title' => __( 'Trigger' ),
  'devices' => [ 'mobile' ],
  'excluded_from' => [ 'offcanvas' ],
  'options' => [

    'mobile_menu_trigger_type' => [
      'label' => false,
      'type' => 'ct-image-picker',
      'attr' => [
        'data-type' => 'background',
        'data-columns' => '3',
      ],
      'choices' => [

        'type-1' => [
          'src'   => blocksy_image_picker_file( 'trigger-1' ),
          'title' => __( 'Type 1' ),
        ],
        'type-2' => [
          'src'   => blocksy_image_picker_file( 'trigger-2' ),
          'title' => __( 'Type 2' ),
        ],
        'type-3' => [
          'src'   => blocksy_image_picker_file( 'trigger-3' ),
          'title' => __( 'Type 3' ),
        ],
      ],
    ],

  ]
  ];