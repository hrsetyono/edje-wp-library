<?php

// add_action('plugins_loaded' , function() {
// });

require_once __DIR__ . '/core-text.php';
require_once __DIR__ . '/core-media.php';
require_once __DIR__ . '/core-design.php';

if (is_admin()) {
  add_filter('safe_style_css', '_h_gutenberg_safe_style');

  add_action('enqueue_block_editor_assets', '_h_enqueue_editor', 20);
  add_action('admin_init', '_h_enqueue_classic_editor');
} else {
  // remove group container class
  remove_filter('render_block', 'wp_render_layout_support_flag', 10, 2);
  remove_filter('render_block', 'gutenberg_render_layout_support_flag', 10, 2);

  // remove the SVG gradient
  remove_action('wp_body_open', 'wp_global_styles_render_svg_filters', 10);
}

/**
 * Allow this CSS Var to be saved in database
 * 
 * @filter safe_style_css
 */
function _h_gutenberg_safe_style($attr) {
  $attr[] = '--textColor';
  $attr[] = '--bgColor';
  $attr[] = '--iconColor';
  $attr[] = '--faqTitleBg';
  $attr[] = '--faqTitleColor';
  return $attr;
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
