<?php

add_action('widgets_init', '_h_register_sidebar');
add_action('widgets_init', '_h_register_widgets');
add_action('widgets_init', '_h_unregister_widgets');

add_filter('acf/settings/load_json', '_h_load_acf_json_widgets', 20);

if (is_admin()) {
  add_action('after_setup_theme', '_h_disable_gutenberg_widgets', 100);
  add_action('admin_enqueue_scripts', '_h_enqueue_widget_assets');
}



/**
 * Get sidebar data
 */
function h_dynamic_sidebar($slug) {
  ob_start();
  dynamic_sidebar($slug);
  $widgets = ob_get_contents();
  ob_end_clean();

  preg_match_all('/<\/ul>\s?<ul class="widget-column".+>/Ui', $widgets, $matches);

  return [
    'columns' => count($matches[0]) + 1,
    'widgets' => $widgets,
  ];
}


/**
 * Register Sidebar for Header and Footer builder
 * @action widgets_init
 */
function _h_register_sidebar() {
  $sidebars = [
    'subheader' => __('Subheader'),
    'header' => __('Header'),
    'subheader-mobile' => __('Subheader (Mobile)'),
    'header-mobile' => __('Header (Mobile)'),
    'offcanvas' => __('Offcanvas'),

    'footer-top' => __('Footer Top'),
    'footer-mid' => __('Footer Mid'),
    'footer-bottom' => __('Footer Bottom'),
  ];

  foreach ($sidebars as $id => $name) {
    register_sidebar([
      'name' => $name,
      'id' => $id,
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
  require_once __DIR__ . '/widget-button.php';
  require_once __DIR__ . '/widget-socials.php';
  require_once __DIR__ . '/widget-toggle-offcanvas.php';
  require_once __DIR__ . '/widget-recent-posts.php';

  register_widget('H_Widget_Button');
  register_widget('H_Widget_Logo');
  register_widget('H_Widget_Toggle_Offcanvas' );
  register_widget('H_Widget_Socials');
  register_widget('H_Widget_Separator');
  register_widget('H_Widget_Recent_Posts');
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


function _h_load_acf_json_widgets($paths) {  
  $paths[] = plugin_dir_path(__FILE__) . '/acf-json';
  return $paths;
}


/**
 * @action admin_enqueue_scripts
 */
function _h_enqueue_widget_assets() {
  $dir = plugin_dir_url(__FILE__);

  wp_enqueue_style('h-widgets', $dir . 'css/h-widgets.css', [], H_VERSION);
}


/**
 * Disables the block editor from managing widgets.
 * Taken from Classic Widgets v0.2 plugin https://wordpress.org/plugins/classic-widgets/
 * 
 * @action after_setup_theme
 */
function _h_disable_gutenberg_widgets() {
  if (get_theme_support('h-classic-widgets')) {
    add_filter('gutenberg_use_widgets_block_editor', '__return_false');
    add_filter('use_widgets_block_editor', '__return_false');
  }
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

    // do something
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