import './style.sass';
import { registerBlockType } from '@wordpress/blocks';
import edit from './edit.jsx';
// import save from './save.jsx';


registerBlockType( 'h/icon', {
  title: 'Icon',
  description: 'Icon with texts',
  icon: 'id',
  category: 'layout',
  example: {},
  attributes: hLocalizeIcon.defaultAtts,
  styles: [
    { name: 'smaller', label: 'Smaller' },
    { name: 'color-icon-only', label: 'Color on Icon Only' },
    { name: 'smaller-color-icon-only', label: 'Smaller + Color on Icon Only' },
  ],
  
  edit: edit,
  // save: save
} );
