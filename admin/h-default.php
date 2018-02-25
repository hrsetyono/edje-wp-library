<?php
/*
  Change default setting that affect Frontend side
*/
class H_Default {
  function __construct() {
    // remove wp meta tag
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');

    // remove emoji
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7 );

    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    // modify login
    add_filter( 'login_errors', array($this, 'change_login_errors_message') );
    add_action( 'login_head', array($this, 'modify_login_page') );
  }

  /*
    Change the error message when signing in
    @filter login_errors
  */
  function change_login_errors_message($error) {
    if(is_string($error) ) {
      return __('Sorry, your username or password is wrong', 'h');
    } else {
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
  }

  /*
    Add custom logo to login header
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
}
