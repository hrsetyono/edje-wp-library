<?php
/**
 * Modify settings for Admin panel
 */

// remove emoji
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

// remove thank you message in admin
add_filter('admin_footer_text', '__return_empty_string', 11);
add_filter('update_footer', '__return_empty_string', 11);

// other
add_action('admin_enqueue_scripts', '_h_admin_enqueue_scripts');
add_filter('wp_terms_checklist_args', '_h_fixed_position_on_term_checkboxes', 1, 2);
add_filter('intermediate_image_sizes_advanced', '_h_remove_mediumlarge_size');
add_action('admin_bar_menu', '_h_remove_wp_logo', 999);


/**
 * Add CSS and JS to admin area
 * @action admin_enqueu_scripts
 */
function _h_admin_enqueue_scripts() {
  wp_enqueue_style('h-admin', H_DIST . '/h-admin.css');
}

/**
 * Prevent reordering of Category checklist
 * @filter wp_terms_checklist_args
 */
function _h_fixed_position_on_term_checkboxes($args, $post_id) {
  $args['checked_ontop'] = false;
  return $args;
}

/**
 * Remove "medium_large" image size
 * @filter intermediate_image_sizes_advanced
 */
function _h_remove_mediumlarge_size($sizes) {
  unset($sizes['medium_large']);
  return $sizes;
}

/**
 * Remove Wordpress logo in admin bar
 * @filter admin_bar_menu
 */
function _h_remove_wp_logo($wp_admin_bar) {
  $wp_admin_bar->remove_node('wp-logo');
}