// COLUMNS Style
wp.blocks.registerBlockStyle( 'core/columns', {
  name: '8-4',
  label: '8-4'
} );

wp.blocks.registerBlockStyle( 'core/columns', {
  name: '4-8',
  label: '4-8'
} );


// Modify settings for Core blocks
wp.hooks.addFilter( 'blocks.registerBlockType', 'h/set_default_alignment', ( settings, name ) => {
  switch( name ) {
    // Paragraph and List is allowed to use wide alignment
    case 'core/paragraph':
    case 'core/list':
    case 'core/gallery':
    case 'core/code':
    case 'core/table':
      return lodash.assign( {}, settings, {
        supports: lodash.assign( {}, settings.supports, { align: ['wide'] } ),
      } );

    case 'core/heading':
    return lodash.assign( {}, settings, {
      supports: lodash.assign( {}, settings.supports, { align: ['center', 'wide'] } ),
    } );

    // Columns can only be wide
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

    case 'core/pullquote':
      return lodash.assign( {}, settings, {
        title: 'FAQ',
        description: 'Question with hidden answer that is displayed on click. (Originally Pullquote, customized by Edje)',
        supports: lodash.assign( {}, settings.supports, { align: ['wide'] } ),
      } );
  }

  return settings;
});

// Fix nested block to crash when having Style
let el = wp.element.createElement;
let allowNestedStyle = wp.compose.createHigherOrderComponent( function( BlockEdit ) {
  return function( props ) {
    let content = el( BlockEdit, props );

    // if nested block, the preview content is empty div
    let isNestedBlock = ['core/columns', 'core/group', 'core/media-text'].indexOf( props.name ) >= 0;
    if( isNestedBlock && typeof props.insertBlocksAfter === 'undefined' ) {
      content = el( 'div', {} );
    }

    return el(
      wp.element.Fragment, {}, content
    );
  };
}, 'allowNestedStyle' );
wp.hooks.addFilter( 'editor.BlockEdit', 'h/fix_nested_style_preview', allowNestedStyle );