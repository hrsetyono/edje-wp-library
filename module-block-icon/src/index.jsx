import './style.sass';
import { registerBlockType } from '@wordpress/blocks';
import edit from './edit.jsx';

registerBlockType('h/icon', {
  title: 'Icon',
  description: 'Icon with texts',
  icon: 'id',
  category: 'layout',
  example: {},
  attributes: window.hLocalizeIcon.defaultAtts,
  styles: [
    { name: 'boxed', label: 'Boxed' },
  ],

  edit,
  // save: save
});
