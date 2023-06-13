import { unregisterBlockType, unregisterBlockVariation } from '@wordpress/blocks';
import { addFilter } from '@wordpress/hooks';
import domReady from '@wordpress/dom-ready';

import './h-gutenberg.sass';
import './h-cover-mobile.jsx';

domReady(() => {
  window.localizeH.disallowedBlocks.forEach((name) => {
    unregisterBlockType(name);
  });

  // Disable useless Group variation
  unregisterBlockVariation('core/group', 'group-stack');
});

// Modify settings for Core blocks
addFilter('blocks.registerBlockType', 'h/set_default_alignment', (settings, name) => {
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
        align: ['wide'],
      };
      break;

    case 'core/separator':
      settings.supports = {
        ...settings.supports,
        align: ['wide'],
      };
      break;

    // Remove align left and right
    case 'core/file':
    case 'core/audio':
      settings.supports = {
        ...settings.supports,
        align: [],
      };
      break;

    // only allow center
    case 'core/social-links':
      settings.supports = {
        ...settings.supports,
        align: ['center'],
      };
      break;

    // Columns default is now wide
    case 'core/columns':
      settings.supports = {
        ...settings.supports,
        align: ['wide'],
      };

      settings.attributes = {
        ...settings.attributes,
        align: {
          type: 'string',
          default: 'wide',
        },
      };
      break;

    // Remove layout setting in Child Column
    case 'core/column':
      settings.supports = {
        ...settings.supports,
        __experimentalLayout: false,
      };
      break;

    case 'core/button':
      settings.supports = {
        ...settings.supports,
        __experimentalBorder: false,
      };
      break;

    // Group defaults to full and remove the Justification
    case 'core/group':
      settings.supports = {
        ...settings.supports,
        // __experimentalLayout: false,
      };

      settings.attributes = {
        ...settings.attributes,
        align: {
          type: 'string',
          default: 'full',
        },
        layout: {
          type: [Object],
          default: { inherit: true },
        },
      };
      break;

    // Cover defaults to Full
    case 'core/cover':
      settings.attributes = {
        ...settings.attributes,
        align: {
          type: 'string',
          default: 'full',
        },
      };
      break;

    default:
      break;
  }

  // SPACING SETTINGS
  if (!settings.supports) {
    settings.supports = {};
  }

  switch (name) {
    // Has both padding and margin
    case 'core/group':
    case 'core/columns':
    case 'core/cover':
      settings.supports.spacing = {
        ...settings.supports.spacing,
        margin: ['top', 'bottom'],
        __experimentalDefaultControls: {
          padding: true,
          margin: true,
        },
      };
      break;

    // Has hidden margin and padding
    case 'core/paragraph':
    case 'core/list':
    case 'core/gallery':
    case 'core/code':
    case 'core/verse':
    case 'core/preformatted':
    case 'core/table':
      settings.supports.spacing = {
        ...settings.supports.spacing,
        padding: true,
        margin: ['top', 'bottom'],
        // __experimentalDefaultControls: {
        //   margin: true,
        // },
      };
      break;

    // Only margin
    case 'core/heading':
    case 'core/quote':
    case 'core/buttons':
    case 'core/separator':
    case 'core/image':
    case 'core/latest-posts':
      settings.supports.spacing = {
        ...settings.supports.spacing,
        padding: false,
        margin: ['top', 'bottom'],
        // __experimentalDefaultControls: {
        //   margin: true,
        // },
      };
      break;

    // Only padding
    case 'core/column':
      settings.supports.spacing = {
        ...settings.supports.spacing,
        padding: true,
        margin: false,
        // __experimentalDefaultControls: {
        //   padding: true,
        // },
      };
      break;

    default:
      // do nothing
      break;
  }

  // FONT SIZE Settings
  switch (name) {
    case 'core/paragraph':
    case 'core/list':
      settings.supports.typography = {
        ...settings.supports.typography,
        fontSize: true,
      };
      break;

    default:
      settings.supports.typography = false;
      break;
  }

  return settings;
});
