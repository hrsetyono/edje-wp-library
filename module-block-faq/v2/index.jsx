import './style.sass';
import { registerBlockType } from '@wordpress/blocks';
import edit from './edit.jsx';

registerBlockType('h/faq', { edit });
