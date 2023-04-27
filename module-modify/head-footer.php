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

// add_action('customize_register', '_h_add_header_footer_customizer');
add_action('wp_head', '_h_add_custom_head_code', 100);
add_action('wp_footer', '_h_add_custom_footer_code', 100);


/**
 * Create Customizer field to add extra code in Header/Footer
 * 
 * @param $wpc - WP_Customize object
 * @action customize_register
 * 
 * @deprecated 6.2.0 - Replaced by ACF, customizer is removed but the saved option is still echoed
 */
// function _h_add_header_footer_customizer($wpc) {
//   $setting_args = [
//     'type' => 'option',
//     'transport' => 'postMessage',
//     'default' => '',
//   ];
//   $editor_settings = [
//     'codemirror' => ['mode' => 'htmlmixed'],
//   ];
//   // Add section
//   $wpc->add_section('h_code_section', [
//     'title' => __('Head & Footer Code'),
//     'description' => __('Add custom code for Head and Footer area'),
//   ]);
//   // Add options
//   $wpc->add_setting('h[head_code]', $setting_args);
//   $wpc->add_setting('h[footer_code]', $setting_args);
//   // Add control
//   $wpc->add_control(new WP_Customize_Code_Editor_Control($wpc, 'h[head_code]', [
//     'label' => __( 'HEAD code' ),
//     'editor_settings' => $editor_settings,
//     'section' => 'h_code_section',
//     'settings' => 'h[head_code]',
//   ]));
//   $wpc->add_control(new WP_Customize_Code_Editor_Control($wpc, 'h[footer_code]', [
//     'label' => __( 'FOOTER code' ),
//     'editor_settings' => $editor_settings,
//     'section' => 'h_code_section',
//     'settings' => 'h[footer_code]',
//   ]));
// }


/**
 * Add custom code to wp_head() section.
 * 
 * @action wp_head 100
 * 
 * @update 6.2.0 - Code taken from ACF, only check for Option if empty
 */
function _h_add_custom_head_code() {
  $code = '';

  if (function_exists('get_field')) {
    $code = get_field('head_code', 'option');
  }

  // Fallback to the old customizer
  if (!$code) {
    $code = get_option('h')['head_code'] ?? '';
  }

  echo $code;
}

/**
 * Add custom code to wp_footer() section.
 * 
 * @action wp_footer 100
 * 
 * @update 6.2.0 - Code taken from ACF, only check for Option if empty
 */
function _h_add_custom_footer_code() {
  $code = '';

  if (function_exists('get_field')) {
    $code = get_field('footer_code', 'option');
  }

  // Fallback to the old customizer
  if (!$code) {
    $code = get_option('h')['footer_code'] ?? '';
  }

  echo $code;
}
