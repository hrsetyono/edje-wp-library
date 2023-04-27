<?php

add_action('widgets_init', '_h_register_sidebar');
add_action('widgets_init', '_h_register_widgets');
add_action('widgets_init', '_h_unregister_widgets');
add_filter('acf/settings/load_json', '_h_load_acf_json_widgets', 20);

if (is_admin()) {
  // Reverted the gutenberg widget into classic widget
  add_filter('gutenberg_use_widgets_block_editor', '__return_false');
  add_filter('use_widgets_block_editor', '__return_false');

  add_action('admin_enqueue_scripts', '_h_enqueue_widget_assets');
}


/**
 * Add columns count into Header widgets
 * 
 * @since 5.9.0
 * @param string $slug - the sidebar ID
 */
function h_dynamic_header($slug) {
  ob_start();
  dynamic_sidebar($slug);
  $widgets = ob_get_clean();

  // count the amount of Separator
  preg_match_all('/<\/ul>\s?<ul class="widget-column".+>/Ui', $widgets, $matches);
  $columns_count = count($matches[0]) + 1;

  // add columns count in the wrapper
  $widgets = preg_replace(
    '/role=\'nav/Ui', "data-columns='{$columns_count}' $0",
    $widgets
  );

  echo $widgets;
}


/**
 * Register Sidebar for Header and Footer builder
 * 
 * @since 5.9.0
 * @action widgets_init
 */
function _h_register_sidebar() {
  $before_sidebar = "<div class='widget-row'><ul class='widget-column'>";
  $after_sidebar = "</ul></div>";
  $headers = [
    'header' => __('Header'),
    'subheader' => __('Subheader'),
    'header-mobile' => __('Header (Mobile)'),
    'subheader-mobile' => __('Subheader (Mobile)'),
  ];

  $footers = [
    'footer-top' => __('Footer Top'),
    'footer-mid' => __('Footer Mid'),
    'footer-bottom' => __('Footer Bottom'),
  ];
  
  $offcanvas = [
    'offcanvas' => __('Offcanvas'),
  ];

  foreach ($headers as $id => $name) {
    register_sidebar([
      'name' => $name,
      'id' => $id,
      'before_sidebar' => "<header class='header-widgets {$id}' role='navigation'> {$before_sidebar}", 
      'after_sidebar' => "{$after_sidebar} </header>",
    ]);
  }

  foreach ($footers as $id => $name) {
    register_sidebar([
      'name' => $name,
      'id' => $id,
      'before_sidebar' => "<div class='footer-widgets {$id}'> {$before_sidebar}", 
      'after_sidebar' => "{$after_sidebar} </div>",
    ]);
  }

  foreach ($offcanvas as $id => $name) {
    register_sidebar([
      'name' => $name,
      'id' => $id,
      'before_sidebar' => $before_sidebar, 
      'after_sidebar' => $after_sidebar,
    ]);
  }
}


/**
 * Register custom widgets for the Header / Footer builder
 * @action widgets_init
 */
function _h_register_widgets() {
  require_once __DIR__ . '/widget-logo.php';
  require_once __DIR__ . '/widget-separator.php';
  require_once __DIR__ . '/widget-socials.php';
  require_once __DIR__ . '/widget-toggle-offcanvas.php';
  require_once __DIR__ . '/widget-recent-posts.php';
  require_once __DIR__ . '/widget-buttons.php';
  
  register_widget('H_WidgetLogo');
  register_widget('H_WidgetToggleOffcanvas');
  register_widget('H_WidgetSocials');
  register_widget('H_WidgetSeparator');
  register_widget('H_WidgetRecentPosts');
  register_widget('H_WidgetButtons');
  
  if (current_theme_supports('h-dark-mode')) {
    require_once __DIR__ . '/widget-dark-toggle.php';
    register_widget('H_WidgetDarkToggle');
  }
}


/**
 * Remove the default obscure widgets
 * @action widgets_init
 */
function _h_unregister_widgets() {
  $disabled_widgets = apply_filters('h_disabled_widgets', [
    'WP_Widget_Calendar',
    'WP_Widget_Archives',
    'WP_Widget_Media_Audio',
    'WP_Widget_Media_Video',
    'WP_Widget_RSS',
    'WP_Widget_Recent_Comments',
    'WP_Widget_Tag_Cloud',
    'WP_Widget_Meta',
    'WP_Widget_Pages',
    'WP_Widget_Recent_Posts',
    'WP_Widget_Gallery',
  ]);

  foreach ($disabled_widgets as $w) { 
    unregister_widget($w);
  }
}

/**
 * Allow ACF JSON to load from this directory
 * 
 * @filter acf/settings/load_json 20
 */
function _h_load_acf_json_widgets($paths) {  
  $paths[] = plugin_dir_path(__FILE__) . '/acf-json';
  return $paths;
}

/**
 * @action admin_enqueue_scripts
 */
function _h_enqueue_widget_assets() {
  wp_enqueue_style('h-widgets', H_DIST . '/h-widgets.css', [], H_VERSION);
}

/////


if (!class_exists('H_Widget')):
/**
 * Class to create a new widget
 */
class H_Widget extends WP_Widget {
  function __construct($slug, $name, $args) {
    parent::__construct($slug, $name, $args);
  }


  /**
   * Outputs the content of the widget
   */
  function widget($args, $instance) {
    $content = '';
    $id = $args['widget_id'];

    $content = apply_filters('h_widget_name', $content, $args);
    echo $args['before_widget'] . $content . $args['after_widget'];
  }

  /**
   * Leave empty, will be handled by ACF
   */
  function form($instance) {
    
  }

  /**
   * Leave empty, will be handled by ACF
   */
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  

  /**
   * Add ACF fields for this widget
   */
  function add_acf_fields() {
    acf_add_local_field_group([]);
  }
}
endif;