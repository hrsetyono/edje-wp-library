<?php
/**
 * Buttons widget
 * 
 * @since 9.2.0 - Replacing Button widget
 */
class H_WidgetButtons extends H_Widget { 
  function __construct() {
    parent::__construct('h_buttons', __('- Buttons'), [
      'description' => __('Create multiple buttons')
    ]);
  }

  function widget($args, $instance) {
    $widget_id = 'widget_' . $args['widget_id'];
    $data = [
      'widget_id' => $widget_id,
      'addon' => get_field('addon', $widget_id),
      'buttons' => get_field('buttons', $widget_id),
    ];

    $custom_render = apply_filters('h_widget_buttons', '', $data);

    echo $args['before_widget'];
    echo $custom_render ? $custom_render : $this->render_widget($data);
    echo $args['after_widget'];
  }

  function render_widget($data) {
    [
      'addon' => $addon,
      'buttons' => $buttons,
    ] = $data;

    ob_start(); ?>

    <div class="wp-block-buttons">
    <?php foreach ($buttons as $b): ?>
      <div class="wp-block-button is-style-<?= $b['style'] ?> <?= $addon ?>">
        <a
          class="wp-block-button__link"
          href="<?= $b['link']['url'] ?>"
          target="<?= $b['link']['target'] ?>"
        >
          <?php if ($b['svg_icon']): ?>
            <?= $b['svg_icon'] ?>

          <?php elseif($b['image']): ?>
            <img src="<?= $b['image']['sizes']['thumbnail'] ?>">
          <?php endif; ?>

          <?php if ($b['link']['title']): ?>
            <span>
              <?= $b['link']['title'] ?>
            </span>
          <?php endif; ?>
        </a>
      </div>
    <?php endforeach; ?>
    </div>

    <?php return ob_get_clean();
  }
}