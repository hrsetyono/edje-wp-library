<?php

$item = [
  'title' => __( 'Socials' ),
  'css_selector' => '[data-id="socials"]',
  'options' => [

    'header_socials' => [
      'label' => false,
      'type' => 'ct-layers',
      'manageable' => true,
      'desc' => __( 'You can configure social URLs <a href="?autofocus[section]=social_accounts">here</a>.' ),
      'divider' => 'bottom',
      'settings' => custy_get_social_list(),
    ],

  ]
];