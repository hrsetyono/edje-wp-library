<?php

add_action('plugins_loaded' , function() {
  require_once __DIR__ . '/block-styles.php';
  require_once __DIR__ . '/enqueue.php';
});

if (is_admin()) {
  add_filter('safe_style_css', '_h_gutenberg_safe_style');
} else {
  add_filter('render_block_core/group', '_h_add_group_inner_container', 5, 2);
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