<?php

/**
 * Create a custom FAQ block that outputs its data into JSON LD Schema too
 */
add_action('init' , function() {
  // if Gutenberg is not active
  if (!function_exists('register_block_type')) { return; }

  if (current_theme_supports('px-faq-block')) {
    require_once __DIR__ . '/faq-block.php';
  }
  elseif (current_theme_supports('h-faq-block-v2')) {
    require_once __DIR__ . '/faq-block-v2.php';
  }
  elseif (current_theme_supports('h-faq-block')) {
    require_once __DIR__ . '/faq-block-v1.php';
  }
});