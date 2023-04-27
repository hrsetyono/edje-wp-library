<?php
/**
 * This is a template to create new widget
 */
class PX_WidgetName extends PX_Widget { 
  function __construct() {
    parent::__construct('px_name', __('- Name'), [
      'description' => __('Short description here')
    ]);
  }

  function widget($args, $instance) {
    $widget_id = 'widget_' . $args['widget_id'];
    $data = [
      'widget_id' => $widget_id,
      'acf_field' => get_field('acf_field', $widget_id),
    ];

    $custom_render = apply_filters('px_widget_name', '', $data);

    echo $args['before_widget'];
    echo $custom_render ? $custom_render : $this->render_widget($data);
    echo $args['after_widget'];
  }

  function render_widget($data) {
    [
      'acf_field' => $acf_field,
    ] = $data;
    ob_start(); ?>

    <div>
      <?= $acf_field ?>
    </div>

    <?php return ob_get_clean();
  }
}