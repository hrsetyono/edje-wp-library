<?php

register_block_style('core/button', [ 'name' => 'h-transparent', 'label' => 'Transparent' ]);

register_block_style('core/columns', [ 'name' => 'h-wide-gap', 'label' => 'Wide Gap' ]);
register_block_style('core/columns', [ 'name' => 'h-no-gap', 'label' => 'No Gap' ]);

register_block_style('core/group', [ 'name' => 'h-large-spacing', 'label' => 'Large Spacing' ]);

register_block_style('core/spacer', [ 'name' => 'h-negative', 'label' => 'Negative' ]);

if (!is_admin()) {
  add_filter('render_block_core/spacer', '_h_render_negative_spacer', 10, 2);

  add_filter('render_block_core/group', '_h_render_group_inner_container', 5, 2);
  add_filter('render_block_core/buttons', '_h_render_buttons_alignment', 5, 2);
}

/**
 * Modify the height into margin-bottom
 * 
 * @filter render_block_core/spacer
 */
function _h_render_negative_spacer($content, $block) {
  $is_negative = isset($block['attrs']['className'])
    && str_contains($block['attrs']['className'], 'is-style-h-negative');

  if ($is_negative) {
    $content = preg_replace('/height:(\d+)/', 'margin-bottom:-$1', $content);
  }
  return $content;
}


/**
 * Add back the Group's inner container missing from WP 5.9
 * 
 * @filter render_block_core/group
 */
function _h_render_group_inner_container($content, $block) {
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
function _h_render_buttons_alignment($content, $block) {
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