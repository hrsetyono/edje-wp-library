<?php

add_action('enqueue_block_editor_assets', 'px_classic_quote_editor_assets', 100);

function px_classic_quote_editor_assets() {
  if (!function_exists('register_block_type')) { return; } // Abort if Gutenberg not exist

  wp_register_script('px-block-quote', H_DIST . '/px-block-quote.js', [ 'wp-blocks', 'wp-dom' ] , H_VERSION, true);
  wp_register_style('px-block-quote', H_DIST . '/px-block-quote.css', [ 'wp-edit-blocks' ], H_VERSION);

  wp_enqueue_style('px-block-quote');
  wp_enqueue_script('px-block-quote');
};