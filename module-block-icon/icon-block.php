<?php
_px_register_icon_block();

/**
 * Register a custom ICON block
 */
function _px_register_icon_block() {
  wp_register_script('px-icon', H_DIST . '/px-icon.js', [ 'wp-blocks', 'wp-dom' ] , H_VERSION, true);
  wp_register_style('px-icon', H_DIST . '/px-icon.css', [ 'wp-edit-blocks' ], H_VERSION);

  wp_localize_script('px-icon', 'pxLocalizeIcon', [
    'iconURL' => 'https://cdn.pixelstudio.id/h-block-icon',
  ]);

  register_block_type(__DIR__ . '/src');
}