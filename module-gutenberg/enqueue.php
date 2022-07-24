<?php

if (is_admin()) { 
  add_action('enqueue_block_editor_assets', '_h_enqueue_editor', 20);
  add_action('admin_init', '_h_enqueue_classic_editor');
}

/**
 * @action enqueue_block_editor_assets
 */
function _h_enqueue_editor() {
  $disallowed_blocks = apply_filters('h_disallowed_blocks', [
    'core/nextpage',
    'core/more',
    'core/pullquote',
  ]);

  wp_enqueue_style('h-gutenberg', H_DIST . '/h-gutenberg.css', [], H_VERSION);
  wp_enqueue_script('h-gutenberg', H_DIST . '/h-gutenberg.js', [], H_VERSION, true);

  wp_localize_script('h-gutenberg', 'localizeH', [
    'disallowedBlocks' => $disallowed_blocks
  ]);
}

/**
 * Add custom CSS to Classic Editor
 * 
 * @action admin_init
 */
function _h_enqueue_classic_editor() {
  $assets = plugin_dir_url(__FILE__) . 'css';
  add_editor_style(H_DIST . '/h-classic-editor.css');
}
