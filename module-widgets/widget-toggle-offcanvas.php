<?php

/**
 * 
 */
class H_WidgetToggleOffcanvas extends H_Widget { 
  function __construct() {
    parent::__construct(
      'h_toggle',
      __('- Offcanvas Toggle'),
      [
        'description' => __('Button to open Offcanvas')
      ]
    );
  }

  function widget($args, $instance) {
    $widget_id = 'widget_' . $args['widget_id'];
    $data = [
      'label' => get_field('label', $widget_id),
      'icon' => "<svg xmlns='http://www.w3.org/2000/svg' width='30' height='27' viewBox='0 0 448 512'><path d=\"M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z\"/></svg>",
    ];

    $custom_render = apply_filters('h_widget_toggle', '', $data);
  
    echo $args['before_widget'];
    echo $custom_render ? $custom_render : $this->render_widget($data);
    echo $args['after_widget'];
  }

  function render_widget($data) {
    [
      'label' => $label,
      'icon' => $icon,
    ] = $data;

    ob_start(); ?>
    <a href="#menu">
      <?= $icon ?>
      <?php if ($label): ?>
        <?= $label ?>
      <?php endif; ?>
    </a>
    <?php return ob_get_clean();
  }
}