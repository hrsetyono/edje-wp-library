<?php namespace h;
/**
 * Modify settings for Admin panel
 */
class Modify_Admin {
  function __construct() {
    add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'] );

    // remove emoji
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // remove thank you message in admin
    add_filter( 'admin_footer_text', '__return_empty_string', 11 );
    add_filter( 'update_footer', '__return_empty_string', 11 );

    // make category checkbox position static
    add_filter( 'wp_terms_checklist_args', [$this, 'fix_terms_checklist'], 1, 2);

    // remove useless medium-large size
    add_filter( 'intermediate_image_sizes_advanced', [$this, 'remove_mediumlarge_size'] );

    // remove wp logo
    add_action( 'admin_bar_menu', [$this, 'remove_wp_logo'], 999 );


    add_filter( 'site_transient_update_plugins', [$this, 'disable_plugin_updates'] );
  }

  /**
   * Add CSS and JS to admin area
   * @action admin_enqueu_scripts
   */
  function admin_enqueue_scripts() {
    $assets = plugin_dir_url(__FILE__) . 'assets';
    wp_enqueue_style( 'h-admin', $assets . '/h-admin.css' );
  }

  /**
   * Prevent reordering of Category checklist
   * @filter wp_terms_checklist_args
   */
  function fix_terms_checklist( $args, $post_id ) {
    $args['checked_ontop'] = false;
    return $args;
  }

  /**
   * Remove "medium_large" image size
   * @filter intermediate_image_sizes_advanced
   */
  function remove_mediumlarge_size( $sizes ) {
    unset( $sizes['medium_large'] );
    return $sizes;
  }

  /**
   * Remove Wordpress logo in admin bar
   * @filter admin_bar_menu
   */
  function remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' );
  }


  /**
   * Disable plugin update that can mess the site
   * 
   * @filter site_transient_update_plugins
   */
  function disable_plugin_updates( $value ) {
    unset( $value->response[ 'timber-library/timber.php' ] );
    unset( $value->response[ 'gutenberg/gutenberg.php' ] );
    return $value;
  }

}
