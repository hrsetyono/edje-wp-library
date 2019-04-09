<?php namespace h;
/*
  Modify Jetpack modules
*/
class Default_Gutenberg {
  function __construct() {
    // add_action( 'enqueue_block_editor_assets', array($this, 'gutenberg_enqueue_scripts') );
  }

  /*
    Enqueue CSS and JS to gutenberg editor
    @action enqueue_block_editor_assets
  */
  function gutenberg_enqueue_scripts() {
    wp_enqueue_style( 'h-gutenberg', H_URL . '/assets/css/h-gutenberg.css', array( 'wp-edit-blocks' ) );
    wp_enqueue_script( 'h-gutenberg', H_URL . '/assets/js/h-gutenberg.js', array( 'wp-blocks', 'wp-element', 'jquery' ), false, true );
  }


}