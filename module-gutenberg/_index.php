<?php

add_action('plugins_loaded' , function() {
  require_once __DIR__ . '/block-styles.php';
  require_once __DIR__ . '/enqueue.php';
});

if (is_admin()) {
  add_filter('safe_style_css', '_h_gutenberg_safe_style');
} else {
  add_filter('render_block_core/group', '_h_add_group_inner_container', 5, 2);
  add_filter('render_block_core/buttons', '_h_add_buttons_alignment', 5, 2);

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
 * Add back the Group's inner container missing from WP 5.9
 * 
 * @filter render_block_core/group
 */
function _h_add_group_inner_container($content, $block) {
  // Abort if still the old group
  if (strpos($content, '__inner-container')) { return $content; }

  $content = preg_replace(
    '/(wp-block-group.+>)(.+)(<\/div>$)/Uis',
    '$1<div class="wp-block-group__inner-container">$2</div>$3',
    $content,
  );
  return $content;
}

/**
 * Add back the missing Buttons alignment class from WP 5.9
 * 
 * @filter render_block_core/buttons
 */
function _h_add_buttons_alignment($content, $block) {
  // Abort if still the old buttons
  if (strpos($content, 'is-content-justification-')) { return $content; }

  $justify = isset($block['attrs']['layout']['justifyContent'])
    ? $block['attrs']['layout']['justifyContent']
    : false;

  if ($justify) {
    $content = preg_replace(
      '/class="wp-block-buttons/',
      "$0 is-content-justification-{$justify} ",
      $content
    );
  }

  return $content;
}