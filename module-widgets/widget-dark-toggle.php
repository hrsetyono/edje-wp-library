<?php
/**
 * Create a dark mode toggle
 */

if (current_theme_supports('h-dark-mode')) {
  add_action('wp_body_open', '_h_add_dark_mode_script', 5);
}


class H_WidgetDarkToggle extends H_Widget { 
  function __construct() {
    parent::__construct('h_dark_toggle', __('- Dark Mode Toggle'), [
      'description' => __('Switch between dark/light mode')
    ]);
  }

  function widget($args, $instance) {
    $widget_id = 'widget_' . $args['widget_id'];
    $data = [
      'widget_id' => $widget_id,
      'style' => get_field('style', $widget_id),
      'label_light' => '',
      'label_dark' => '',
    ];

    if ($data['style'] === 'has-label') {
      $label_light = get_field('label_light', $widget_id);
      $label_dark = get_field('label_dark', $widget_id);

      $data['label_light'] = $label_light ? $label_light : 'Light';
      $data['label_dark'] = $label_dark ? $label_dark : 'Dark';
    }

    $custom_render = apply_filters('h_widget_dark_toggle', '', $data);

    echo $args['before_widget'];
    echo $custom_render ? $custom_render : $this->render_widget($data);
    echo $args['after_widget'];
  }

  function render_widget($data) {
    [
      'style' => $style,
      'label_light' => $label_light,
      'label_dark' => $label_dark,
    ] = $data;
    ob_start(); ?>

    <label class="h-dark-toggle is-style-<?= $style ?>">
      <?php if ($label_light): ?>
        <span>
          <?= $label_light ?>
        </span>
      <?php endif; ?>

      <input type="checkbox">
      <div class="h-dark-toggle__switch" tabindex="0"></div>
      
      <?php if ($label_dark): ?>
        <span>
          <?= $label_dark ?>
        </span>
      <?php endif; ?>
    </label>

    <?php return ob_get_clean();
  }
}

/**
 * Output a script to <head> to check whether dark mode was on or not
 * 
 * @action wp_body_open 5
 */
function _h_add_dark_mode_script() { ?>
<script>
  (function() { 'use strict';
    const darkMode = localStorage.hDarkMode === 'true';
    if (darkMode) {
      document.querySelector('body').classList.add('h-is-dark');

      // activate the toggle
      document.addEventListener('DOMContentLoaded', () => {
        const $toggles = document.querySelectorAll('.h-dark-toggle input[type="checkbox"]');
        $toggles.forEach(($t) => {
          $t.checked = true;
        });
      });
    }
  })();
</script>
<?php }
