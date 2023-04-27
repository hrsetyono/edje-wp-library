<?php

register_block_style('core/button', [ 'name' => 'h-transparent', 'label' => 'Transparent' ]);

register_block_style('core/columns', [ 'name' => 'h-wide-gap', 'label' => 'Wide Gap' ]);
register_block_style('core/columns', [ 'name' => 'h-no-gap', 'label' => 'No Gap' ]);

register_block_style('core/spacer', [ 'name' => 'h-negative', 'label' => 'Negative' ]);

if (!is_admin()) {
  add_filter('render_block_core/spacer', '_h_render_negative_spacer', 10, 2);

  add_filter('render_block_core/group', '_h_render_group', 5, 2);
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
function _h_render_group($content, $block) {
  $extra_classes = '';

  // Add Row Variation class
  $layout_type = $block['attrs']['layout']['type'] ?? '';
  if ($layout_type) {
    $extra_classes .= "is-layout-{$layout_type} ";
  }

  $wrap = $block['attrs']['layout']['flexWrap'] ?? '';
  if ($wrap === 'nowrap') {
    $extra_classes .= 'is-nowrap ';
  }
  
  $justify = $block['attrs']['layout']['justifyContent'] ?? '';
  if ($justify) {
    $extra_classes .= "is-content-justification-{$justify} ";
  }

  if ($extra_classes) {
    $content = preg_replace(
      '/class="wp-block-group/',
      "$0 {$extra_classes} ",
      $content
    );
  }
  

  // Add back inner-container
  // $content = preg_replace(
  //   '/(wp-block-group.+>)(.+)(<\/div>$)/Uis',
  //   '$1<div class="wp-block-group__inner-container">$2</div>$3',
  //   $content,
  // );

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

  $extra_classes = '';

  $justify = $block['attrs']['layout']['justifyContent'] ?? false;
  if ($justify) {
    $extra_classes .= "is-content-justification-{$justify} ";
  }
  
  $is_vertical = isset($block['attrs']['layout']['orientation'])
    && $block['attrs']['layout']['orientation'] === 'vertical';
  if ($is_vertical) {
    $extra_classes .= 'is-vertical ';
  }

  if ($extra_classes) {
    $content = preg_replace(
      '/class="wp-block-buttons/',
      "$0 {$extra_classes} ",
      $content
    );
  }

  return $content;
}