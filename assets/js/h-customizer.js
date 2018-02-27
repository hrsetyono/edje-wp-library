jQuery( document ).ready(function($) {
	'use strict';

  /*
    Visual Editor script
    @link https://github.com/maddisondesigns/customizer-custom-controls
  */
  $( '.customize-control-tinymce-editor' ).each( function() {
    var id = $(this).data('customize-setting-link');
    var js_safe_id = $(this).attr('id');

  	// Get the toolbar strings that were passed from the PHP Class
  	var toolbar1 = _wpCustomizeSettings.controls[ id ].toolbar1;
  	var toolbar2 = _wpCustomizeSettings.controls[ id ].toolbar2;

  	wp.editor.initialize( js_safe_id, {
  		tinymce: {
  			wpautop: true,
  			toolbar1: toolbar1,
  			toolbar2: toolbar2,
  		},
      mediaButtons: true,
  		quicktags: true
  	});

  });

  $(document).on( 'tinymce-editor-init', function( event, editor ) {
  	editor.on( 'change', function( e ) {
  		tinyMCE.triggerSave();
  		$( '#' + editor.id ).trigger( 'change' );
  	});
  });

});
