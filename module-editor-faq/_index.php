<?php
/**
 * Module to transform PULLQUOTE block into FAQ 
 */

if( is_admin() ) { 
  add_action( 'init', '_h_register_faq_block' );
} else {
  add_action( 'init' , '_h_load_faq' );
}


/**
 * Register a new FAQ Block
 * 
 * @action init
 */
function _h_register_faq_block() {
  // if Gutenberg is not active
  if ( !function_exists( 'register_block_type' ) ) {
    return;
  }

  // If support FAQ Block
  if( current_theme_supports( 'h-faq-block' ) ) {
    $dir = plugin_dir_url(__FILE__) . 'assets';

    wp_register_script( 'h-faq', $dir . '/h-faq.js', [ 'wp-blocks', 'wp-dom' ] , null, true );
    wp_register_style( 'h-faq', $dir . '/h-faq.css', [ 'wp-edit-blocks' ] );

    register_block_type( 'h/faq', [
      'editor_style' => 'h-faq',
      'editor_script' => 'h-faq',
    ] );
  }
  // Backward support for old version that transforms Pullquote into FAQ
  // @deprecated
  else {
    add_action( 'enqueue_block_editor_assets', '_h_enqueue_pullfaq_editor', 20 );
    add_action( 'wp_enqueue_scripts' , '_h_enqueue_pullfaq', 30 );
  }
}


/**
 * @action plugins_loaded
 */
function _h_load_faq() {
  if( current_theme_supports( 'h-faq-block' ) ) {
    require_once __DIR__ . '/faq-schema.php';
  }
  else {
    require_once __DIR__ . '/pullfaq-schema.php';
  }
}


/**
 * Enqueue the editor assets for FAQ Pullquote Block
 * 
 * @action enqueue_block_editor_assets
 */
function _h_enqueue_pullfaq_editor() {
  $assets = plugin_dir_url(__FILE__) . '/assets';
  wp_enqueue_style( 'h-faq-pullquote', $assets . '/h-pullfaq-editor.css', ['wp-edit-blocks'] );
}

/**
 * Enqueue the assets for FAQ Pullquote Block
 * 
 * @action wp_enqueue_scripts
 */
function _h_enqueue_faq() {
  $assets = plugin_dir_url(__FILE__) . 'assets';
  wp_enqueue_style( 'h-pullfaq', $assets . '/h-pullfaq.css', [] );
  wp_enqueue_script( 'h-pullfaq', $assets . '/h-pullfaq.js', [], false, true );
}