// COLUMNS Style
wp.blocks.registerBlockStyle( 'core/columns', {
  name: 'h-2-1',
  label: '2:1'
} );

wp.blocks.registerBlockStyle( 'core/columns', {
  name: 'h-1-2',
  label: '1:2'
} );

wp.blocks.registerBlockStyle( 'core/columns', {
  name: 'h-1-1-mobile',
  label: '1:1 Mobile'
} );

// GALLERY Style

wp.blocks.registerBlockStyle( 'core/gallery', {
  name: 'h-slider',
  label: 'Slider'
} );

// MEDIA TEXT Style

wp.blocks.registerBlockStyle( 'core/media-text', {
  name: 'h-larger-image',
  label: 'Larger Image'
} );

wp.blocks.registerBlockStyle( 'core/media-text', {
  name: 'h-smaller-image',
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

    // Hide these useless blocks
    case 'core/video':
    case 'core/nextpage':
      
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