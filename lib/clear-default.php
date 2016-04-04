<?php
// remove wp meta tag
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// remove emoji
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('admin_print_scripts', 'print_emoji_detection_script');

// remove extra rss
remove_action('wp_head', 'feed_links', 2 );
remove_action('wp_head', 'feed_links_extra', 3 );

// remove thank you message in admin
add_filter('admin_footer_text', '__return_empty_string', 11);
add_filter('update_footer', '__return_empty_string', 11);

// fixed the positioning of category checklist
add_filter('wp_terms_checklist_args', 'h_fixed_terms_checklist', 1, 2);
function h_fixed_terms_checklist($args, $post_id) {
  $args['checked_ontop'] = false;
  return $args;
}

// change login error
add_filter('login_errors', 'h_login_errors');
function h_login_errors() {
  return __('Sorry, your username or password is wrong');
}

// Remove the annoying WP 4.4 Medium-Large size
add_filter('intermediate_image_sizes_advanced', 'h_remove_mediumlarge_size');
function h_remove_mediumlarge_size($sizes) {
  unset( $sizes['medium_large']);
  return $sizes;
}

// prevent url guessing
add_filter('redirect_canonical', 'h_redirect_canonical');
function h_redirect_canonical($url) {
  if (is_404() ) { return false; }
  return $url;
}
