<?php namespace h;
/*
  Change default setting that affect Code Editor
*/
class Default_Codemirror {
  function __construct() {
    add_action( 'admin_init', array($this, 'init') );
  }

  function init() {
    global $pagenow;
    // if file edit not allowed AND if not in Editor page
    $disallow_file_edit = defined('DISALLOW_FILE_EDIT') && DISALLOW_FILE_EDIT;
    if( $disallow_file_edit || $pagenow !== 'theme-editor.php' ) { return false; }

    add_filter( 'wp_theme_editor_filetypes', array($this, 'allow_editing_twig') );
    add_filter( 'wp_code_editor_settings', array($this, 'change_editor_settings'), 10, 2 );
  }

  /*
    Allow editing TWIG file in Editor
    @filter wp_theme_editor_filetypes
  */
  function allow_editing_twig( $file_types ) {
    $file_types[] = 'twig';
    return $file_types;
  }


  /*
    Change default setting of Codemirror
    @filter wp_code_editor_settings

    https://developer.wordpress.org/reference/functions/wp_enqueue_code_editor/
  */
  function change_editor_settings( $settings, $args ) {
    $settings['codemirror']['indentUnit'] = 2;
    $settings['codemirror']['indentWithTabs'] = false;
    $settings['htmlhint']['space-tab-mixed-disabled'] = 'disabled';

    // Allow TWIG files to be edited
    $extension = strtolower( pathinfo( $args['file'], PATHINFO_EXTENSION ) );
    if( $extension === 'twig' ) {
      $settings['codemirror'] = array_merge( $settings['codemirror'], array(
        'mode' => 'htmlmixed',
        'lint' => true,
        'autoCloseBrackets' => true,
        'autoCloseTags' => true,
        'matchTags' => array(
          'bothTags' => true,
        ),
      ) );
    }

    return $settings;
  }
}
