<?php

// TEXT
register_block_style('core/paragraph', [ 'name' => 'h-no-spacing', 'label' => 'No Spacing' ]);

register_block_style('core/heading', [ 'name' => 'h-no-spacing', 'label' => 'No Spacing' ]);

register_block_style('core/table', [ 'name' => 'h-full-color', 'label' => 'Full Color' ]);

register_block_style('core/quote', [ 'name' => 'h-timeline', 'label' => 'Timeline' ]);

register_block_style('core/quote', [ 'name' => 'h-testimony', 'label' => 'Testimony' ]);

// DESIGN
register_block_style('core/button', [ 'name' => 'h-transparent', 'label' => 'Transparent' ]);

register_block_style('core/columns', [ 'name' => 'h-wide-gap', 'label' => 'Wide Gap' ]);

register_block_style('core/columns', [ 'name' => 'h-no-gap', 'label' => 'No Gap' ]);

register_block_style('core/spacer', [ 'name' => 'h-negative', 'label' => 'Negative' ]);
add_filter('render_block_core/spacer', '_h_block_spacer_negative', 10, 2);

// MEDIA
register_block_style('core/gallery', [ 'name' => 'h-thumbnails', 'label' => 'Thumbnails' ]);
register_block_style('core/image', [ 'name' => 'h-thumbnail-wide', 'label' => 'Thumbnail Wide' ]);
register_block_style('core/image', [ 'name' => 'h-thumbnail-tall', 'label' => 'Thumbnail Tall' ]);

register_block_style('core/media-text', [ 'name' => 'h-larger-image', 'label' => 'Larger Image' ]);

register_block_style('core/media-text', [ 'name' => 'h-smaller-image', 'label' => 'Smaller Image' ]);

register_block_style('core/cover', [ 'name' => 'h-below-header', 'label' => 'Below Header' ]);
add_filter('body_class', '_h_body_class_cover_below_header');


/**
 * Modify the height into margin-bottom
 * 
 * @filter render_block_core/spacer
 */
function _h_block_spacer_negative($content, $block) {
  $is_negative = isset($block['attrs']['className'])
    && str_contains($block['attrs']['className'], 'is-style-h-negative');

  if ($is_negative) {
    $content = preg_replace('/height:(\d+)/', 'margin-bottom:-$1', $content);
  }
  return $content;
}

/**
 * Add extra class if using Cover with Below Header style
 * 
 * @filter body_class
 */
function _h_body_class_cover_below_header($classes) {
  global $post;
  preg_match('/wp-block-cover.+is-style-h-below-header/', $post->post_content, $matches);

  if ($matches) {
    $classes[] = 'h-has-cover-below-header';
  }
  return $classes;
}