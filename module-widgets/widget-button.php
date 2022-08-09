<?php
/**
 * Button widget
 * 
 * @deprecated since 9.2.0 - Replaced by Buttons
 */
class H_WidgetButton extends H_Widget { 
  function __construct() {
    parent::__construct('h_button', __('x Button'), [
      'description' => __('Create a Button')
    ]);
  }

  function widget($args, $instance) {
    $widget_id = 'widget_' . $args['widget_id'];
    $data = [
      'style' => get_field('style', $widget_id),
      'icon' => get_field('icon', $widget_id),
      'link' => wp_parse_args(
        get_field('link', $widget_id),
        [
          'url' => '',
          'target' => '_self',
          'title' => 'Click Me',
        ]
      ),
    ];

    $custom_render = apply_filters('h_widget_button', '', $data);

    echo $args['before_widget'];
    echo $custom_render ? $custom_render : $this->render_widget($data);
    echo $args['after_widget'];
  }

  function render_widget($data) {
    [
      'link' => $link,
      'style' => $style,
      'icon' => $icon,
    ] = $data;  
    ob_start(); ?>

    <div class="wp-block-button is-style-<?= $style ?>">
      <a
        class="wp-block-button__link"
        href="<?= $link['url'] ?>"
        target="<?= $link['target'] ?>"
      >
        <?= $icon ?>

        <?php if ($link['title']): ?>
          <span>
            <?= $link['title'] ?>
          </span>
        <?php endif; ?>
      </a>
    </div>

    <?php return ob_get_clean();
  }
}