<?php

/**
 * Show the logo that is set in Customizer or allow overriding with own image.
 */
class H_WidgetLogo extends H_Widget { 
  function __construct() {
    parent::__construct(
      'h_logo',
      __('- Logo'),
      [ 'description' => __('Show logo from Customizer') ]
    );
  }

  function widget($args, $instance) {
    $widget_id = 'widget_' . $args['widget_id'];
    $data = [
      'logo' => get_field('logo', $widget_id),
      'logo_src' => '',
      'tagline' => get_field('tagline', $widget_id),
    ];

    // If has logo, get the medium size URL
    if ($data['logo']) {
      $data['logo_src'] = $data['logo']['sizes']['medium'];
    }
    // if logo is empty, use the logo from Customizer
    else {
      $default_logo_id = get_theme_mod('custom_logo');
      $data['logo_src'] = wp_get_attachment_image_url($default_logo_id, 'medium');
    }

    $custom_render = apply_filters('h_widget_logo', '', $data);

    echo $args['before_widget'];
    echo $custom_render ? $custom_render : $this->render_widget($data);
    echo $args['after_widget'];
  }

  function render_widget($data) {
    [
      'logo_src' => $logo_src,
      'tagline' => $tagline,
    ] = $data;

    ob_start(); ?>
    <div class="wp-block-site-logo">
      <a
        href="<?= get_home_url() ?>"
        class='custom-logo-link'
        rel="home"
      >
        <img src="<?= $logo_src ?>">
      </a>
      <?php if ($tagline): ?>
        <span>
          <?= $tagline ?>
        </span>
      <?php endif; ?>
    </div>
    <?php return ob_get_clean();
  }
}