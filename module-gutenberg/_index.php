<?php

require_once __DIR__ . '/core-text.php';
require_once __DIR__ . '/core-media.php';
require_once __DIR__ . '/core-design.php';

if (is_admin()) {
  add_filter('safe_style_css', '_h_gutenberg_safe_style');

  add_action('enqueue_block_editor_assets', '_h_enqueue_editor', 20);
  add_action('admin_init', '_h_enqueue_classic_editor');  
  add_filter('block_editor_settings_all', '_px_disable_inspector_tabs');
} else {
  // remove group container class
  remove_filter('render_block', 'wp_render_layout_support_flag', 10, 2);
  remove_filter('render_block', 'gutenberg_render_layout_support_flag', 10, 2);

  // remove the SVG gradient
  remove_action('wp_body_open', 'wp_global_styles_render_svg_filters', 10);
  add_action('wp_footer', '_px_disable_gutenberg_support_css');
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
 * Disable Inspector Tabs
 * 
 * @filter block_editor_settings_all
 */
function _px_disable_inspector_tabs($settings) {
  $current_tab_settings = _wp_array_get($settings, ['blockInspectorTabs'], []);
  $settings['blockInspectorTabs'] = array_merge(
    $current_tab_settings,
    [
      'core/spacer' => false,
      'core/column' => false,
      'core/buttons' => false,
      'core/button' => false,
      'core/table' => false,
      'core/group' => false,
      'core/image' => false,
    ]
  );

  return $settings;
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

/**
 * Disable Support CSS
 * 
 * @action wp_footer
 */
function _px_disable_gutenberg_support_css() {
  wp_dequeue_style('core-block-supports');
}