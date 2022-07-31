<?php

/**
 * 
 */
class H_WidgetSocials extends H_Widget {
  function __construct() {
    parent::__construct(
      'h_socials',
      __('- Socials'),
      [
        'description' => __('Social Media links'),
      ]
    );
  }

  function widget($args, $instance) {
    $widget_id = 'widget_' . $args['widget_id'];
    $data = [
      'items' => get_field('links', $widget_id),
      'style' => get_field('style', $widget_id),
      'color' => get_field('color', $widget_id),
      'size' => get_field('size', $widget_id),

      'before_title' => $args['before_title'],
      'after_title' => $args['after_title'],
      'title' => trim(get_field('title', $widget_id)),
    ];

    $data['items'] = array_map(function($i) {
      $name = $i['icon'];
      $icon_data = H::get_social_icon($name);

      $i['extra_classes'] = "wp-block-social-link wp-social-link-{$name}";
      $i['svg'] = $icon_data['svg'];

      // if link is totally empty
      if (!is_array($i['link'])) {
        $i['link'] = [
          'url' => '',
          'target' => '',
          'title' => '',
        ];
      }

      // create label from link title
      $label = $i['link']['title'] ?? '';
      if ($label) {
        $i['label'] = H::markdown($label);
        $i['extra_classes'] .= ' has-label ';
      } else {
        $i['label'] = '';
      }

      return $i;
    }, $data['items']);

    $custom_render = apply_filters('h_widget_socials', '', $data);

    echo $args['before_widget'];
    echo $custom_render ? $custom_render : $this->render_widget($data);
    echo $args['after_widget'];
  }

  function render_widget($data) {
    [
      'items' => $items,
      'style' => $style,
      'color' => $color,
      'size' => $size,

      'before_title' => $before_title,
      'after_title' => $after_title,
      'title' => $title,
    ] = $data;

    $extra_classes = "is-style-{$style} has-{$size}-icon-size has-{$color}-color";
  
    ob_start() ?>

    <?php if ($title): ?>
      <?= $before_title ?>
        <?= $title ?>
      <?= $after_title ?>  
    <?php endif; ?>

    <ul class="wp-block-social-links <?= $extra_classes ?>">
      <?php foreach ($items as $i): ?>
        <li class="wp-social-link <?= $i['extra_classes'] ?>">
          <a
            class="wp-block-social-link-anchor"
            href="<?= $i['link']['url'] ?>"
            target='<?= $i['link']['target'] ?>'
            rel="noopener nofollow"
          >
            <?= $i['svg'] ?>
            <?= $i['label'] ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>

    <?php return ob_get_clean();
  }
}