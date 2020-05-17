
wp.domReady( function() {
  // MEDIA TEXT
  wp.blocks.registerBlockStyle( 'core/media-text', {
    name: 'h-larger-image',
    label: 'Larger Image'
  } );

  wp.blocks.registerBlockStyle( 'core/media-text', {
    name: 'h-smaller-image',
    label: 'Smaller Image'
  } );

  // IMAGE
  wp.blocks.unregisterBlockStyle( 'core/image', 'circle-mask' );
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
    case 'core-embed/tiktok':

    case 'jetpack/slideshow':
    case 'jetpack/gif':
    case 'jetpack/markdown':
    case 'jetpack/opentable':
      return lodash.assign( {}, settings, {
        supports: lodash.assign( {}, settings.supports, { inserter: false } ),
      } );
  }

  return settings;
});