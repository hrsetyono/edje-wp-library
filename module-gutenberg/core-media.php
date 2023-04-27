<?php

register_block_style('core/gallery', [ 'name' => 'h-slider', 'label' => 'Slider' ]);
register_block_style('core/gallery', [ 'name' => 'h-thumbnails', 'label' => 'Thumbnails' ]);

register_block_style('core/media-text', [ 'name' => 'h-larger-image', 'label' => 'Larger Image' ]);
register_block_style('core/media-text', [ 'name' => 'h-smaller-image', 'label' => 'Smaller Image' ]);

register_block_style('core/cover', [ 'name' => 'h-below-header', 'label' => 'Below Header' ]);

if (!is_admin()) {
  add_filter('render_block_core/cover', '_h_render_responsive_cover', 10, 2);
  
  add_filter('body_class', '_h_body_class_cover_below_header');
}



/**
 * Wrap the Image with <picture> and add responsive mobile image
 * 
 * @filter render_block_core/cover
 */
function _h_render_responsive_cover($content, $block) {
  // If has mobile image
  if (isset($block['attrs']['hMobileMediaURL'])) {
    $image = $block['attrs']['hMobileMediaURL'];
    $content = preg_replace(
      '/<img class="wp-block-cover__image.+\/>/Ui',
      "<picture><source srcset='{$image}' media='(max-width:767px)'>$0</picture>",
      $content
    );
  }

  // If has mobile height
  if (isset($block['attrs']['hMobileHeight'])) {
    $height = $block['attrs']['hMobileHeight'];

    preg_match('/wp-block-cover\s.+(style=).+>/Ui', $content, $has_style);

    // If already have existing style attribute
    if($has_style) {
      $content = preg_replace(
        '/(wp-block-cover\s.+)(style=".+)(".+>)/Ui',
        "$1$2;--hMobileHeight:{$height};$3",
        $content
      );
    } else {
      $content = preg_replace(
        '/(wp-block-cover\s.+")(.*>)/Ui',
        "$1 style='--hMobileHeight:{$height}' $2",
        $content
      );
    }
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
  if (!$post) { return $classes; }

  preg_match('/wp-block-cover.+is-style-h-below-header/', $post->post_content, $matches);

  if ($matches) {
    $classes[] = 'h-has-transparent-header';
  }
  return $classes;
}