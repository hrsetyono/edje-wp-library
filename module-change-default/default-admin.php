<?php namespace h;
/*
  Change default setting that affect Admin panel
*/
class Default_Admin {
  function __construct() {
    add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts') );

    add_action( 'admin_init', array($this, 'add_classic_editor_style') );

    // remove emoji
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // remove thank you message in admin
    add_filter( 'admin_footer_text', '__return_empty_string', 11 );
    add_filter( 'update_footer', '__return_empty_string', 11 );

    // make category checkbox position static
    add_filter( 'wp_terms_checklist_args', array($this, 'fix_terms_checklist'), 1, 2);

    // remove useless medium-large size
    add_filter( 'intermediate_image_sizes_advanced', array($this, 'remove_mediumlarge_size') );

    // remove wp logo
    add_action( 'admin_bar_menu', array($this, 'remove_wp_logo'), 999 );
  }

  /*
    Add CSS and JS to admin area
    @action admin_enqueu_scripts
  */
  function admin_enqueue_scripts() {
    wp_enqueue_style( 'h-admin', H_URL . '/assets/css/h-admin.css' );
  }

  /*
    Add custom CSS to Editor area
    @action admin_init
  */
  function add_classic_editor_style() {
    add_editor_style( H_URL . '/assets/css/h-editor.css' );
  }

  /*
    Prevent reordering of Category checklist
    @filter wp_terms_checklist_args
  */
  function fix_terms_checklist( $args, $post_id ) {
    $args['checked_ontop'] = false;
    return $args;
  }

  /*
    Remove "medium_large" image size
    @filter intermediate_image_sizes_advanced
  */
  function remove_mediumlarge_size( $sizes ) {
    unset( $sizes['medium_large'] );
    return $sizes;
  }

  /*
    Remove Wordpress logo in admin bar
    @filter admin_bar_menu
  */
  function remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' );
  }
}
