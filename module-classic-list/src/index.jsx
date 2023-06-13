/**
 * WordPress dependencies
 */
import { list as icon } from '@wordpress/icons';
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
  unregisterBlockType('core/list');
  registerBlockType(name, {
    icon,
    title,
    description,
    attributes,
    supports,
    styles,
    example: {
      attributes: {
        values:
          '<li>Alice.</li><li>The White Rabbit.</li><li>The Cheshire Cat.</li><li>The Mad Hatter.</li><li>The Queen of Hearts.</li>',
      },
    },
    // transforms,
    merge(attributes, attributesToMerge) {
      const { values } = attributesToMerge;

      if (!values || values === '<li></li>') {
        return attributes;
      }

      return {
        ...attributes,
        values: attributes.values + values,
      };
    },
    edit,
    save,
    // deprecated,
  });
});
