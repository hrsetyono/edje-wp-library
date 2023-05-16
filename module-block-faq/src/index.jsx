import './style.sass';
import { registerBlockType } from '@wordpress/blocks';
import edit from './edit.jsx';

registerBlockType('px/faq', { edit });
