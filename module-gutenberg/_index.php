<?php

add_action('plugins_loaded' , function() {
  require_once __DIR__ . '/block-styles.php';
  require_once __DIR__ . '/enqueue.php';
});

if (is_admin()) {
  add_filter('safe_style_css', '_h_gutenberg_safe_style');
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