<?php

/**
 * Create a separate div for the next set of widgets.
 * 
 * In Header, it will divide the widgets into left / center / right position.
 * In Footer, it will divide them into equal sized div.
 */
class H_WidgetSeparator extends H_Widget { 
  function __construct() {
    parent::__construct(
      'h_separator',
      __('-----'),
      [
        'description' => __('Split the widgets')
      ]
    );
  }

  public function widget($args, $instance) {
    $widget_id = 'widget_' . $args['widget_id'];
    $data = [
      'size' => get_field('footer_size', $widget_id),
      'style' => '',
    ];
  
    if ($data['size'] !== 'auto') {
      $data['style'] = "style='--columnSize:{$data['size']}'";
    }

    // render the HTML
    $content = "</ul><ul class=\"widget-column\" {$data['style']}>";
    $content = apply_filters('h_widget_separator', $content, $data);

    echo $content;
  }
}