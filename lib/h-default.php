<?php

new H_Default();
class H_Default {
  function __construct() {
    // remove wp meta tag
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');

    // remove emoji
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7 );
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');

    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    // remove thank you message in admin
    add_filter('admin_footer_text', '__return_empty_string', 11);
    add_filter('update_footer', '__return_empty_string', 11);

    // fixed the positioning of category checklist
    add_filter('wp_terms_checklist_args', array($this, 'fix_terms_checklist'), 1, 2);

    // change login error
    add_filter('login_errors', array($this, 'login_errors') );

    // Remove the annoying WP 4.4 Medium-Large size
    add_filter('intermediate_image_sizes_advanced', array($this, 'remove_mediumlarge_size') );
  }

  function fix_terms_checklist($args, $post_id) {
    $args['checked_ontop'] = false;
    return $args;
  }

  function login_errors($error) {
    global $errors;
    $err_codes = $errors->get_error_codes();

    $filters = array('invalid_username', 'incorrect_password', 'empty_password');

    // if there is at least one filter that intersected with the error
    if(count(array_intersect($filters, $err_codes) ) >= 1) {
      return __('Sorry, your username or password is wrong', 'h');
    } else {
      return $error;
    }
  }

  function remove_mediumlarge_size($sizes) {
    unset($sizes['medium_large']);
    return $sizes;
  }
}
