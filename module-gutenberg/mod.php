<?php namespace h;
/**
 * Modify Gutenberg editor
 */
class Modify_Gutenberg {
  function __construct() {
    add_action( 'enqueue_block_editor_assets', [$this, 'gutenberg_enqueue_scripts'] );
  }

  /**
   * Enqueue CSS and JS to gutenberg editor
   * @action enqueue_block_editor_assets
   */
  function gutenberg_enqueue_scripts() {
    wp_enqueue_style( 'h-gutenberg', H_URL . '/assets/css/h-gutenberg.css', ['wp-edit-blocks'] );
    wp_enqueue_script( 'h-gutenberg', H_URL . '/assets/js/h-gutenberg.js', ['wp-blocks', 'wp-element', 'jquery'], false, true );
  }


}