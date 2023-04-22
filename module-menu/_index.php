<?php

require_once __DIR__ . '/menu-item.php';
require_once __DIR__ . '/sub-menu.php';

add_action('after_setup_theme', function() {
  if (!current_theme_supports('h-mega-menu')) { return; }

  add_action('admin_enqueue_scripts', '_h_enqueue_menu_assets', 100);
  add_filter('acf/settings/load_json', '_h_load_acf_json_menu', 20);
}, 20);


/**
 * @action admin_enqueue_scripts
 */
function _h_enqueue_menu_assets() {
  wp_enqueue_script('h-menu', H_DIST . '/h-menu-admin.js', [], H_VERSION, true);
  wp_enqueue_style('h-menu', H_DIST . '/h-menu-admin.css', [], H_VERSION);
}

/**
 * Allow ACF JSON to load from this directory
 * 
 * @filter acf/settings/load_json 20
 */
function _h_load_acf_json_menu($paths) {
  $paths[] = plugin_dir_path(__FILE__) . '/acf-json';
  return $paths;
}