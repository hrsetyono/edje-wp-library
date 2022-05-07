<?php
/**
 * Modify wp_head() and wp_footer() for frontend pages.
 */

// remove obscure wp meta tag
add_filter('the_generator', '__return_false');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

// remove emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
add_filter('emoji_svg_url', '__return_false');

//
add_action('customize_register', '_h_add_header_footer_customizer');
add_action('wp_head', '_h_add_custom_head_code', 100);
add_action('wp_footer', '_h_add_custom_footer_code', 100);



/**
 * Create Customizer field to add extra code in Header/Footer
 * 
 * @param $wpc - WP_Customize object
 * 
 * @action customize_register
 */
function _h_add_header_footer_customizer($wpc) {
  $setting_args = [
    'type' => 'option',
    'transport' => 'postMessage',
    'default' => '',
  ];

  $editor_settings = [
    'codemirror' => ['mode' => 'htmlmixed'],
  ];

  // Add section
  $wpc->add_section('h_code_section', [
    'title' => __('Head & Footer Code'),
    'description' => __('Add custom code for Head and Footer area'),
  ]);

  // Add options
  $wpc->add_setting('h[head_code]', $setting_args);
  $wpc->add_setting('h[footer_code]', $setting_args);

  // Add control
  $wpc->add_control(new \WP_Customize_Code_Editor_Control($wpc, 'h[head_code]', [
    'label' => __( 'HEAD code' ),
    'editor_settings' => $editor_settings,
    'section' => 'h_code_section',
    'settings' => 'h[head_code]',
  ]));

  $wpc->add_control(new \WP_Customize_Code_Editor_Control($wpc, 'h[footer_code]', [
    'label' => __( 'FOOTER code' ),
    'editor_settings' => $editor_settings,
    'section' => 'h_code_section',
    'settings' => 'h[footer_code]',
  ]));
}


/**
 * Add custom code to wp_head() section.
 * 
 * @action wp_head 100
 */
function _h_add_custom_head_code() {
  echo get_option('h')['head_code'] ?? '';
}

/**
 * Add custom code to wp_footer() section.
 * @action wp_footer 100
 */
function _h_add_custom_footer_code() {
  echo get_option('h')['footer_code'] ?? '';
}
