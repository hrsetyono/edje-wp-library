import '@babel/polyfill';
import './style.sass';
import { registerBlockType } from '@wordpress/blocks';
import edit from './edit.jsx';


registerBlockType( 'h/icon', {
  title: 'Icon',
  description: 'Icon with texts',
  icon: 'id',
  category: 'layout',
  example: {},
  attributes: hLocalizeIcon.defaultAtts,
  styles: [
    { name: 'boxed', label: 'Boxed' },
  ],
  
  edit: edit,
  // save: save
} );
