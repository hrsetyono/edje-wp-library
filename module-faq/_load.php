<?php
/**
 * Module to transform PULLQUOTE block into FAQ 
 */

if( is_admin() ) { 
  add_action( 'enqueue_block_editor_assets', '_h_enqueue_faq_editor', 20 );
} else {
  add_action( 'plugins_loaded' , '_h_load_faq' );
  add_action( 'wp_enqueue_scripts' , '_h_enqueue_faq', 30 );
}


/**
 * @action plugins_loaded
 */
function _h_load_faq() {
  require_once __DIR__ . '/faq-schema.php';
  new \h\FAQ_Schema();
}


/**
 * @action wp_enqueue_scripts
 */
function _h_enqueue_faq() {
  $assets = plugin_dir_url(__FILE__) . 'assets';
  wp_enqueue_style( 'h-faq', $assets . '/faq.css', [] );
  wp_enqueue_script( 'h-faq', $assets . '/faq.js', [], false, true );
}

/**
 * @action enqueue_block_editor_assets
 */
function _h_enqueue_faq_editor() {
  $assets = plugin_dir_url(__FILE__) . '/assets';
  wp_enqueue_style( 'h-faq-editor', $assets . '/faq-editor.css', ['wp-edit-blocks'] );
}