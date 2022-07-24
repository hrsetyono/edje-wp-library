import './style.sass';
import { registerBlockType } from '@wordpress/blocks';
import edit from './edit.jsx';

registerBlockType('h/faq', {
  title: 'FAQ',
  description: 'Question with expandable Answer',
  icon: 'id',
  category: 'layout',
  example: {},
  attributes: window.hLocalizeFAQ.defaultAtts,
  styles: [
    // { name: 'boxed', label: 'Boxed' },
  ],

  edit,
});
