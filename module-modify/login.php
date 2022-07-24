<?php
/**
 * Modify Login page
 */

add_filter('login_errors', '_h_change_login_errors_message');
add_action('login_head', '_h_add_logo_in_login_page');


/**
 * Change the error message when signing in
 * @filter login_errors
 */
function _h_change_login_errors_message($error) {
  if (is_string($error)) {
    return __('Sorry, your username or password is wrong');
  } else {
    global $errors;
    $err_codes = $errors->get_error_codes();

    $filters = ['invalid_username', 'incorrect_password', 'empty_password'];

    // if there is at least one filter that intersected with the error
    if (count(array_intersect($filters, $err_codes)) >= 1) {
      return __('Sorry, your username or password is wrong');
    } else {
      return $error;
    }
  }
}


/**
 * Add custom logo to login header
 * @filter login_head
 */
function _h_add_logo_in_login_page() {
  $logo_id = get_theme_mod('custom_logo');

  // if logo exists
  if ($logo_id):
    $logo = wp_get_attachment_image_src($logo_id , 'full');
    ?>
    <style>
      .login h1 a {
        background-position: center center;
        background-size: contain;
        background-image: url("<?= $logo[0]; ?>");
        width: 250px;
      }
    </style>
    <?php
  endif;
}