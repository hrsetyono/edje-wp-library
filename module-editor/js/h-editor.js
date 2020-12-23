
wp.domReady( function() {
  // IMAGE
  wp.blocks.unregisterBlockStyle( 'core/image', 'circle-mask' );

  for( let name of localizeH.disallowedBlocks ) {
    wp.blocks.unregisterBlockType( name );
  }
});

// Modify settings for Core blocks
wp.hooks.addFilter( 'blocks.registerBlockType', 'h/set_default_alignment', ( settings, name ) => {

  switch( name ) {
    // Paragraph and List is allowed to use wide alignment
    case 'core/paragraph':
    case 'core/list':
    case 'core/gallery':
    case 'core/code':
    case 'core/verse':
    case 'core/preformatted':
    case 'core/table':
    case 'core/pullquote':
    case 'core/heading':
      return lodash.assign( {}, settings, {
        supports: lodash.assign( {}, settings.supports, { align: [ 'wide'] } ),
      } );
    
    // Remove align left and right
    case 'core/file':
    case 'core/audio':
      return lodash.assign( {}, settings, {
        supports: lodash.assign( {}, settings.supports, { align: [] } ),
      } );

    // only allow center
    case 'core/social-links':
      return lodash.assign( {}, settings, {
        supports: lodash.assign( {}, settings.supports, { align: ['center'] } ),
      } );

    // Columns default is now wide
    case 'core/columns':
      return lodash.assign( {}, settings, {
        supports: lodash.assign( {}, settings.supports, { align: ['wide'] } ),
        attributes: lodash.assign( {}, settings.attributes, { align: { type: 'string', default: 'wide' } } ),
      } );

    // Group and Cover defaults to full
    case 'core/group':
    case 'core/cover':
      return lodash.assign( {}, settings, {
        attributes: lodash.assign( {}, settings.attributes, { align: { type: 'string', default: 'full' } } ),
      } );
  }

  return settings;
});