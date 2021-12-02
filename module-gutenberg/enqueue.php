<?php

if( is_admin() ) { 
  add_action( 'enqueue_block_editor_assets', '_h_enqueue_editor', 20 );
  add_action( 'admin_init', '_h_enqueue_classic_editor' );
}

/**
 * @action wp_enqueue_scripts
 */
function _h_enqueue_editor() {
  $disallowed_blocks = apply_filters( 'h_disallowed_blocks', [
    'core/nextpage',
    'core/more',
    'core/pullquote',
  ] );

  $assets = plugin_dir_url(__FILE__);
  wp_enqueue_style( 'h-editor', $assets . 'css/h-editor.css', [], H_VERSION );
  wp_enqueue_script( 'h-editor', $assets . 'js/h-editor.js', [], H_VERSION, true );

  wp_localize_script( 'h-editor', 'localizeH', [ 'disallowedBlocks' => $disallowed_blocks ] );
}

/**
 * Add custom CSS to Classic Editor
 * 
 * @action admin_init
 */
function _h_enqueue_classic_editor() {
  $assets = plugin_dir_url(__FILE__) . 'css';
  add_editor_style( $assets . '/h-classic-editor.css' );
}
