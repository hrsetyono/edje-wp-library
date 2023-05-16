<?php

register_block_style('core/list', [ 'name' => 'h-inline', 'label' => 'Inline' ]);

register_block_style('core/table', [ 'name' => 'h-full-color', 'label' => 'Full Color' ]);

register_block_style('core/quote', [ 'name' => 'h-timeline', 'label' => 'Timeline' ]);
register_block_style('core/quote', [ 'name' => 'h-testimony', 'label' => 'Testimony' ]);

add_filter('render_block_core/table', '_px_render_rowspan_colspan', 10, 2);

/**
 * A cell containing [rowspan x] or [colspan x] will apply that to the <td>
 * 
 * @filter render_block_core/table
 * @since 6.2
 */
function _px_render_rowspan_colspan($content, $block) {
  preg_match('/\[(?:row|col)span/Ui', $content, $has_span);

  if ($has_span) {
    $content = preg_replace(
      '/<td(.*)>\[(row|col)span\s(\d+)\]<br>/Ui',
      '<td $1 $2span="$3">',
      $content
    );
    $content = preg_replace('/<td[^<]*><\/td>/Ui', '', $content);
  }

  return $content;
}