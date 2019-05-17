// COLUMNS Style
wp.blocks.registerBlockStyle( 'core/columns', {
  name: '8-4',
  label: '8-4'
} );

wp.blocks.registerBlockStyle( 'core/columns', {
  name: '4-8',
  label: '4-8'
} );

// MEDIA TEXT Style

wp.blocks.registerBlockStyle( 'core/media-text', {
  name: 'larger-image',
  label: 'Larger Image'
} );

wp.blocks.registerBlockStyle( 'core/media-text', {
  name: 'smaller-image',
  label: 'Smaller Image'
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

    case 'core/freeform':
      return lodash.assign( {}, settings, {
        supports: lodash.assign( {}, settings.supports, { className: true, align: ['wide'] } ),
      } );

    // Hide these useless blocks
    case 'core/audio':
    case 'core/video':
    case 'core/nextpage':
    case 'core/verse':

    case 'core/calendar':
    case 'core/tag-cloud':
    case 'core/search':
    case 'core/latest-comments':
    case 'core/latest-posts':
    case 'core/rss':
    case 'core/legacy-widget':
    case 'core/archives':

    case 'core-embed/amazon-kindle':
    case 'core-embed/soundcloud':
    case 'core-embed/spotify':
    case 'core-embed/flickr':
    case 'core-embed/vimeo':
    case 'core-embed/amazon-kindle':
    case 'core-embed/animoto':
    case 'core-embed/cloudup':
    case 'core-embed/collegehumor':
    case 'core-embed/crowdsignal':
    case 'core-embed/dailymotion':
    case 'core-embed/funnyordie':
    case 'core-embed/hulu':
    case 'core-embed/imgur':
    case 'core-embed/issuu':
    case 'core-embed/kickstarter':
    case 'core-embed/meetup-com':
    case 'core-embed/mixcloud':
    case 'core-embed/photobucket':
    case 'core-embed/polldaddy':
    case 'core-embed/reddit':
    case 'core-embed/reverbnation':
    case 'core-embed/screencast':
    case 'core-embed/scribd':
    case 'core-embed/slideshare':
    case 'core-embed/speaker-deck':
    case 'core-embed/smugmug':
    case 'core-embed/speaker':
    case 'core-embed/ted':
    case 'core-embed/tumblr':
    case 'core-embed/videopress':
    case 'core-embed/wordpress-tv':
      return lodash.assign( {}, settings, {
        supports: lodash.assign( {}, settings.supports, { inserter: false } ),
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