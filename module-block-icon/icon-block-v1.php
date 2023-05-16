<?php

_h_register_icon_block_v1();

function _h_register_icon_block_v1() {
  wp_register_script('h-icon', H_DIST . '/h-icon.js', [ 'wp-blocks', 'wp-dom' ] , H_VERSION, true);
  wp_register_style('h-icon', H_DIST . '/h-icon.css', [ 'wp-edit-blocks' ], H_VERSION);

  $default_atts = apply_filters('h_block_icon_defaults', [
    // toolbar
    'align'        => [ 'type' => 'string', 'default' => 'left' ],
    'iconPosition' => [ 'type' => 'string', 'default' => 'left' ],
    'url'          => [ 'type' => 'string' ],
    'linkTarget'   => [ 'type' => 'boolean', 'default' => false ],
    
    // panel settings
    'isFullyClickable' => [ 'type' => 'boolean', 'default' => true ],
    'useRawSVG'        => [ 'type' => 'boolean', 'default' => false ],
    'iconName' => [ 'type' => 'string', 'default' => 'icons' ],
    'iconMarkup' => [
      'type' => 'string',
      'default' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="50" height="50"><path d="M116.65 219.35a15.68 15.68 0 0 0 22.65 0l96.75-99.83c28.15-29 26.5-77.1-4.91-103.88C203.75-7.7 163-3.5 137.86 22.44L128 32.58l-9.85-10.14C93.05-3.5 52.25-7.7 24.86 15.64c-31.41 26.78-33 74.85-5 103.88zm143.92 100.49h-48l-7.08-14.24a27.39 27.39 0 0 0-25.66-17.78h-71.71a27.39 27.39 0 0 0-25.66 17.78l-7 14.24h-48A27.45 27.45 0 0 0 0 347.3v137.25A27.44 27.44 0 0 0 27.43 512h233.14A27.45 27.45 0 0 0 288 484.55V347.3a27.45 27.45 0 0 0-27.43-27.46zM144 468a52 52 0 1 1 52-52 52 52 0 0 1-52 52zm355.4-115.9h-60.58l22.36-50.75c2.1-6.65-3.93-13.21-12.18-13.21h-75.59c-6.3 0-11.66 3.9-12.5 9.1l-16.8 106.93c-1 6.3 4.88 11.89 12.5 11.89h62.31l-24.2 83c-1.89 6.65 4.2 12.9 12.23 12.9a13.26 13.26 0 0 0 10.92-5.25l92.4-138.91c4.88-6.91-1.16-15.7-10.87-15.7zM478.08.33L329.51 23.17C314.87 25.42 304 38.92 304 54.83V161.6a83.25 83.25 0 0 0-16-1.7c-35.35 0-64 21.48-64 48s28.65 48 64 48c35.2 0 63.73-21.32 64-47.66V99.66l112-17.22v47.18a83.25 83.25 0 0 0-16-1.7c-35.35 0-64 21.48-64 48s28.65 48 64 48c35.2 0 63.73-21.32 64-47.66V32c0-19.48-16-34.42-33.92-31.67z"/></svg>'
    ],
    
    'useImage' => [ 'type' => 'boolean', 'default' => false ],
    'imageID'  => [ 'type' => 'number' ],
    'imageURL' => [ 'type' => 'string' ],

    // panel color
    'textColor' => [ 'type' => 'string', 'default' => '' ],
    'bgColor' => [ 'type' => 'string', 'default' => '' ],
    'iconColor' => [ 'type' => 'string', 'default' => '' ],

    // content
    'heading' => [ 'type' => 'string', 'default' => '' ],
    'description' => [ 'type' => 'string', 'default' => '' ],
  ]);

  // format the URL to get Icon SVG
  $icon_url = isset($support[0]) && isset($support[0]['style'])
    ? "https://cdn.pixelstudio.id/h-block-icon-{$support[0]['style']}"
    : "https://cdn.pixelstudio.id/h-block-icon";
  
  wp_localize_script('h-icon', 'hLocalizeIcon', [
    'defaultAtts' => $default_atts,
    'iconURL' => $icon_url,
  ]);

  register_block_type('h/icon', [
    'editor_style' => 'h-icon',
    'editor_script' => 'h-icon',
    'render_callback' => function($atts) use ($default_atts) {
      return _h_render_icon_block_v1($atts, $default_atts);
    }
  ]);
}


/**
 * Render the icon block
 */
function _h_render_icon_block_v1($atts, $default_atts) {
  // prevent loading in Editor screen
  if (function_exists('get_current_screen')) { return; }

  $default_values = array_map(function($a) {
    return $a['default'] ?? '';
  }, $default_atts);

  $atts = wp_parse_args($atts, $default_values);

  // Take over the rendering process, if any
  $render = apply_filters('h_block_icon_render', '', $atts);
  if ($render) {
    return $render;
  }

  // format the content
  $icon = "<figure class='wp-block-h-icon__figure'>" .
      ($atts['useImage'] ? "<img src='{$atts['imageURL']}'>" : $atts['iconMarkup']) .
    "</figure>";

  // format content
  $heading = $atts['heading'];
  $has_description = !($atts['description'] === '<p></p>' || $atts['description'] === '');
  $description = $has_description ? "<dd>{$atts['description']}</dd>" : '';
  $content = "<dl class='wp-block-h-icon__content'> <dt>$heading</dt> $description </dl>";

  // format the style
  $style = '';
  $style .= $atts['textColor'] ? "--textColor: {$atts['textColor']};" : '';
  $style .= $atts['bgColor']   ? "--bgColor: {$atts['bgColor']};" : '';
  $style .= $atts['iconColor'] ? "--iconColor: {$atts['iconColor']};" : '';

  // format url
  $url = $atts['url'];
  $target = $atts['linkTarget'];

  // format class name
  $extra_classes = $atts['className'] ?? '';
  $extra_classes .= " has-icon-position-{$atts['iconPosition']} ";
  $extra_classes .= "has-text-align-{$atts['align']} ";
  $extra_classes .= $has_description ? 'has-description ' : 'has-no-description ';
  $extra_classes .= $atts['useImage'] ? 'use-image ' : '';

  return ( $url && $atts['isFullyClickable'] ) ?
    "<a class='wp-block-h-icon $extra_classes' style='$style' href='$url' target='$target'>
      $icon
      $content
    </a>"
  :
    "<div class='wp-block-h-icon $extra_classes' style='$style'>
      $icon
      $content
    </div>";
}