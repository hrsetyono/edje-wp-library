<?php

// Create an option for each social media
$list = custy_get_social_list();
$social_options = [];

foreach( $list as $key => $value ) {
  $social_options[ $key ] = [
    'label' => $value['label'],
    'type' => 'text',
    'disableRevertButton' => true,
  ];
}

$section = [
  'title' => __( 'Social Accounts' ),
  'container' => [ 'priority' => '4' ],
  'options' => array_merge( [

    custy_rand_id() => [ 'divider' => __( 'Social Network Links' ),
      'desc' => __( 'Paste in your social network\'s link here and then enable them in Header or Footer' ),
    ],

  ], $social_options )
];