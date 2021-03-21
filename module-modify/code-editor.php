<?php
/**
 * Modify settings for Admin's code editor.
 */

add_action( 'admin_init', function() {
  global $pagenow;
  if( $pagenow !== 'theme-editor.php' ) { return; }

  add_filter( 'wp_theme_editor_filetypes', '_h_code_editor_allow_twig' );
  add_filter( 'wp_code_editor_settings', '_h_code_editor_change_settings', 10, 2 );
} );


/**
 * Allow editing TWIG file in Editor
 * @filter wp_theme_editor_filetypes
 */
function _h_code_editor_allow_twig( $file_types ) {
  $file_types[] = 'twig';
  return $file_types;
}


/**
 * Change default setting of Codemirror
 * @filter wp_code_editor_settings
 * 
 * https://developer.wordpress.org/reference/functions/wp_enqueue_code_editor/
 */
function _h_code_editor_change_settings( $settings, $args ) {
  $settings['codemirror']['indentUnit'] = 2;
  $settings['codemirror']['indentWithTabs'] = false;
  $settings['htmlhint']['space-tab-mixed-disabled'] = 'disabled';

  // Allow TWIG files to be edited
  $extension = strtolower( pathinfo( $args['file'], PATHINFO_EXTENSION ) );
  if( $extension === 'twig' ) {
    $settings['codemirror'] = array_merge( $settings['codemirror'], [
      'mode' => 'htmlmixed',
      'lint' => true,
      'autoCloseBrackets' => true,
      'autoCloseTags' => true,
      'matchTags' => [ 'bothTags' => true ],
    ] );
  }

  return $settings;
}