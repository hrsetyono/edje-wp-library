<?php namespace h;
/**
 * Modify wp_head() and wp_footer() for frontend pages.
 */
class Modify_Head_Footer {
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
    add_action( 'wp_enqueue_scripts', [$this, 'enqueue_assets'] );

    
    // NOTE: Clashes with CDN making the CSS and JS hard to update
    // add_filter( 'script_loader_src', [$this, 'remove_script_version'], 15 );
    // add_filter( 'style_loader_src', [$this, 'remove_script_version'], 15 );
  }


  /**
   * Change some default CSS or JS
   * @action wp_enqueue_scripts
   */
  function enqueue_assets() {
    if ( !is_admin() ) {
      wp_deregister_script( 'wp-embed' );
      wp_deregister_script( 'jquery-ui-core' );
    }

    wp_enqueue_script( 'h-wp', H_URL . 'assets/js/h-wp.js', [], false, true );

    // Register H Library, you need to enqueue it in theme
    wp_register_script( 'h-slider', H_URL . 'assets/js-vendor/h-slider.min.js', [], false, true );
    wp_register_script( 'h-scroll', H_URL . 'assets/js-vendor/h-scroll.min.js', [], false, true );
    wp_register_script( 'h-lightbox', H_URL . 'assets/js-vendor/h-lightbox.min.js', [], false, true );

    // Enable comment's reply form
    if( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }
  }


  /**
   * Remove the versioning in JS and CSS url
   * @filter script_loader_src 15
   * @filter style_loader_src 15
   */
  function remove_script_version( $src ){
    $parts = explode( '?', $src );
    return $parts[0];
  }

}
