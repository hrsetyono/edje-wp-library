<?php

/**
 * 
 */
class H_WidgetSocials extends H_Widget {
  function __construct() {
    parent::__construct('h_socials', __('- Socials'), [
      'description' => __('Social Media links'),
    ]);
  }

  function widget($args, $instance) {
    $widget_id = 'widget_' . $args['widget_id'];
    $data = [
      'widget_id' => $widget_id,
      'links' => get_field('links', $widget_id),
      'style' => get_field('link_style', $widget_id),
      'color' => get_field('color', $widget_id),
      'size' => get_field('size', $widget_id),
      'orientation' => get_field('orientation', $widget_id),

      'before_title' => $args['before_title'],
      'after_title' => $args['after_title'],
      'heading' => trim(get_field('heading', $widget_id)),
    ];

    if (empty($data['style'])) {
      $data['style'] = get_field('style', $widget_id);
    }

    $data['links'] = array_map(function($item) {
      $name = $item['icon'];

      $item['svg'] = $name === 'custom'
        ? $item['svg_code']
        : H::get_social_icon($name)['svg'];

      $item['extra_classes'] = "wp-block-social-link wp-social-link-{$name}";

      // if link is totally empty
      if (!is_array($item['link'])) {
        $item['link'] = [
          'url' => '',
          'target' => '',
          'title' => '',
        ];
      }

      // create label from link title
      $label = $item['link']['title'] ?? '';
      if ($label) {
        $item['label'] = H::markdown($label);
        $item['extra_classes'] .= ' has-label ';
      } else {
        $item['label'] = '';
      }

      return $item;
    }, $data['links']);

    $custom_render = apply_filters('h_widget_socials', '', $data);

    echo $args['before_widget'];
    echo $custom_render ? $custom_render : $this->render_widget($data);
    echo $args['after_widget'];
  }

  function render_widget($data) {
    [
      'links' => $links,
      'style' => $style,
      'color' => $color,
      'size' => $size,
      'orientation' => $orientation,

      'before_title' => $before_title,
      'after_title' => $after_title,
      'heading' => $heading,
    ] = $data;
    
    $style_class = $style === 'default' ? '' : "";
    $size_class = $size === 'normal' ? '' : "has-{$size}-icon-size";
    $orient_class = $orientation === 'horizontal' ? '' : "is-orientation-{$orientation}";

    $extra_classes = "{$style_class} is-style-{$style} has-{$color}-color {$size_class} {$orient_class}";
    ob_start() ?>

    <?php if ($heading): ?>
      <?= $before_title ?>
        <?= $heading ?>
      <?= $after_title ?>
    <?php endif; ?>

    <ul class="wp-block-social-links <?= $extra_classes ?>">
      <?php foreach ($links as $item): ?>
        <li class="wp-social-link <?= $item['extra_classes'] ?>">
          <a
            class="wp-block-social-link-anchor"
            href="<?= $item['link']['url'] ?>"
            target='<?= $item['link']['target'] ?>'
            rel="noopener nofollow"
          >
            <figure class="wp-block-social-link__icon">
              <?= $item['svg'] ?>
            </figure>
            <?= $item['label'] ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>

    <?php return ob_get_clean();
  }
}