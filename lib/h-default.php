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

    add_filter('login_errors', array($this, 'change_login_errors_message') );

    // Remove the annoying WP 4.4 Medium-Large size
    add_filter('intermediate_image_sizes_advanced', array($this, 'remove_mediumlarge_size') );

    add_action('login_head', array($this, 'modify_login_page') );

    add_action('admin_bar_menu', array($this, 'remove_wp_logo'), 999);
  }

  /*
    Prevent reordering of Category checklist

    @filter wp_terms_checklist_args
  */
  function fix_terms_checklist($args, $post_id) {
    $args['checked_ontop'] = false;
    return $args;
  }

  /*
    Change the error message when signing in

    @filter login_errors
  */
  function change_login_errors_message($error) {
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

  /*
    Remove "medium_large" image size

    @filter intermediate_image_sizes_advanced
  */
  function remove_mediumlarge_size($sizes) {
    unset($sizes['medium_large']);
    return $sizes;
  }

  /*
    Customize the Login page

    @filter login_head
  */
  function modify_login_page() {
    $logo_id = get_theme_mod('custom_logo');

    // if logo exists
    if($logo_id):
      $logo = wp_get_attachment_image_src($logo_id , 'full');
      ?>
      <style>
        .login h1 a {
          background-position: center center;
          background-size: contain;
          background-image: url("<?php echo $logo[0]; ?>");
          width: 250px;
        }
      </style>
      <?php
    endif;
  }

  /*
    Remove Wordpress logo in admin bar

    @filter admin_bar_menu
  */
  function remove_wp_logo($wp_admin_bar) {
    $wp_admin_bar->remove_node( 'wp-logo' );
  }
}
