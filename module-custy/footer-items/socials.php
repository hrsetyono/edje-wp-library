<?php

$item = [
  'title' => __( 'Socials' ),
  'options' => [
    'footer_socials' => [
      'label' => false,
      'type' => 'ct-layers',
      'manageable' => true,
      'desc' => sprintf(
        // translators: placeholder here means the actual URL.
        __( 'You can configure social URLs %shere%s.', 'blocksy' ),
        sprintf(
          '<a href="%s" data-trigger-section="social_accounts">',
          admin_url('/customize.php?autofocus[section]=social_accounts')
        ),
        '</a>'
      ),
      'divider' => 'bottom',
      'settings' => blocksy_get_social_networks_list()
    ],
  ]
];