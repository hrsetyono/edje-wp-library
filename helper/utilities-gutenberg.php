<?php

/**
 * Dump all block settings in current post or page
 * 
 * @since 6.2.1
 */
function px_blocks_dump() {
  global $post;
  $blocks = parse_blocks($post->post_content);

  foreach($blocks as $block) {
    $inner_blocks = $block['innerBlocks'] ?? [];
    unset($block['innerBlocks']);

    var_dump($block);

    foreach ($inner_blocks as $iblock) {
      var_dump($iblock);
    }
  }
}