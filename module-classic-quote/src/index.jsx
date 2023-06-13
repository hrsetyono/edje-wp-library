/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { quote as icon } from '@wordpress/icons';
import { registerBlockType, unregisterBlockType } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

/**
 * Internal dependencies
 */
import deprecated from './deprecated.jsx';
import edit from './edit.jsx';
import save from './save.jsx';
import transforms from './transforms.jsx';
import { name, title, description, attributes, supports, styles } from './block.json';
import './style.sass';

domReady(() => {
  unregisterBlockType('core/quote');
  registerBlockType(name, {
    icon,
    title,
    description,
    attributes,
    supports,
    styles,
    example: {
      attributes: {
        value:
          `<p> ${__('In quoting others, we cite ourselves.')}</p>`,
        citation: 'Julio Cortázar',
        className: 'is-style-large',
      },
    },
    transforms,
    edit,
    save,
    merge(attributes, { value, citation }) {
      if (!citation) {
        citation = attributes.citation;
      }
      if (!value || value === '<p></p>') {
        return {
          ...attributes,
          citation,
        };
      }
      return {
        ...attributes,
        value: attributes.value + value,
        citation,
      };
    },
    deprecated,
  });
});
