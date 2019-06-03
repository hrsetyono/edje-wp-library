<?php namespace h;
/**
 * Modify Gutenberg editor
 */
class Modify_Gutenberg {
  function __construct() {
    if( is_admin() ) {
      add_action( 'enqueue_block_editor_assets', [$this, 'gutenberg_enqueue_scripts'] );
    }
    else {
      add_action( 'wp_enqueue_scripts', [$this, 'enqueue_assets'] );
    }
  }

  /**
   * Enqueue CSS and JS to gutenberg editor
   * @action enqueue_block_editor_assets
   */
  function gutenberg_enqueue_scripts() {
    wp_enqueue_style( 'h-gutenberg', H_URL . '/assets/css/h-gutenberg.css', ['wp-edit-blocks'] );
    wp_enqueue_script( 'h-gutenberg', H_URL . '/assets/js/h-gutenberg.js', ['wp-blocks', 'wp-element', 'jquery'], false, true );
  }

  /**
   * @action wp_enqueue_scripts
   */
  function enqueue_assets() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
  }
}