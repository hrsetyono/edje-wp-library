<?php

/**
 * Create a custom FAQ block that outputs its data into JSON LD Schema too
 */
add_action('init' , function() {
  // if Gutenberg is not active
  if (!function_exists('register_block_type')) { return; }

  if (current_theme_supports('px-icon-block')) {
    require_once __DIR__ . '/icon-block.php';
  }
  elseif (current_theme_supports('h-icon-block')) {
    require_once __DIR__ . '/icon-block-v1.php';
  }
});