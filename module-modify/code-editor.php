<?php
/**
 * Modify settings for Admin's code editor.
 */

add_action('admin_init', function() {
  global $pagenow;
  if ($pagenow !== 'theme-editor.php') { return; }

  add_filter('wp_code_editor_settings', '_h_code_editor_change_settings', 10, 2);
});


/**
 * Change default setting of Codemirror
 * @filter wp_code_editor_settings
 * 
 * https://developer.wordpress.org/reference/functions/wp_enqueue_code_editor/
 */
function _h_code_editor_change_settings($settings, $args) {
  $settings['codemirror']['indentUnit'] = 2;
  $settings['codemirror']['indentWithTabs'] = false;
  $settings['htmlhint']['space-tab-mixed-disabled'] = 'disabled';
  return $settings;
}