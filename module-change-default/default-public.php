<?php namespace h;
/*
  Change default setting that affect Frontend side
*/
class Default_Public {
  function __construct() {
    // remove wp meta tag
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'rsd_link' );

    // remove emoji
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    // remove default js or css
    add_action( 'wp_enqueue_scripts', array($this, 'enqueue_script'), 9999 );

    // modify login
    add_filter( 'login_errors', array($this, 'change_login_errors_message') );
    add_action( 'login_head', array($this, 'modify_login_page') );

    // remove query strings
    add_filter( 'script_loader_src', array($this, 'remove_script_version'), 15, 1 );
    add_filter( 'style_loader_src', array($this, 'remove_script_version'), 15, 1 );

    // remove gravatar in admin bar (slow loading)
    add_action( 'admin_bar_menu', function() {
		  add_filter( 'pre_option_show_avatars', '__return_zero' );
	  }, 0 );

    add_action( 'admin_bar_menu', function() {
		  remove_filter( 'pre_option_show_avatars', '__return_zero' );
	  }, 10 );
  }

  /*
    Remove the versioning in JS and CSS url
    @filter script_loader_src 15
    @filter style_loader_src 15
  */
  function remove_script_version( $src ){
    $parts = explode( '?', $src );
    return $parts[0];
  }

  /*
    Change some default CSS or JS
    @action wp_enqueue_scripts
  */
  function enqueue_script() {
    // remove embedding post from other blog
    wp_deregister_script( 'wp-embed' );

    // Enable comment's reply form
    if( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }
  }

  /*
    Change the error message when signing in
    @filter login_errors
  */
  function change_login_errors_message( $error ) {
    if( is_string($error) ) {
      return __('Sorry, your username or password is wrong', 'h');
    } else {
      global $errors;
      $err_codes = $errors->get_error_codes();

      $filters = array('invalid_username', 'incorrect_password', 'empty_password');

      // if there is at least one filter that intersected with the error
      if( count( array_intersect($filters, $err_codes) ) >= 1 ) {
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
