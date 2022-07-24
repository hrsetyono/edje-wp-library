import './style.sass';

const { wp } = window;

wp.domReady(() => {
  window.localizeH.disallowedBlocks.forEach((name) => {
    wp.blocks.unregisterBlockType(name);
  });
});

// Modify settings for Core blocks
wp.hooks.addFilter('blocks.registerBlockType', 'h/set_default_alignment', (settings, name) => {
  switch (name) {
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
      settings.supports = {
        ...settings.supports,
        ...{
          align: ['wide'],
        },
      };
      break;

    // Remove align left and right
    case 'core/file':
    case 'core/audio':
      settings.supports = {
        ...settings.supports,
        ...{
          align: [],
        },
      };
      break;

    // only allow center
    case 'core/social-links':
      settings.supports = {
        ...settings.supports,
        ...{
          align: ['center'],
        },
      };
      break;

    // Columns default is now wide
    case 'core/columns':
      settings.supports = {
        ...settings.supports,
        ...{
          align: ['wide'],
        },
      };

      settings.attributes = {
        ...settings.attributes,
        ...{
          align: {
            type: 'string',
            default: 'wide',
          },
        },
      };
      break;

    case 'core/button':
      settings.supports = {
        ...settings.supports,
        ...{
          __experimentalBorder: false,
        },
      };
      break;

    // Group and Cover defaults to full
    case 'core/group':
      settings.supports = {
        ...settings.supports,
        ...{
          __experimentalLayout: false,
          layout: false,
          spacing: false,
        },
      };

      settings.attributes = {
        ...settings.attributes,
        ...{
          align: {
            type: 'string',
            default: 'full',
          },
          layout: {
            type: [Object],
            default: { inherit: true },
          },
        },
      };
      break;

    case 'core/cover':
      settings.attributes = {
        ...settings.attributes,
        ...{
          align: {
            type: 'string',
            default: 'full',
          },
        },
      };
      break;

    default:
      break;
  }

  return settings;
});
