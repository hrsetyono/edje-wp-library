import hEditor from './h-editor';
import './style.scss';

/**
 * Create hEditor instance
 */
function hApplyEditor() {
  const $textarea = document.querySelector('#comment');

  if ($textarea) {
    hEditor($textarea, {
      buttons: ['bold', 'italic', 'link', '|', 'bullist', 'numlist', 'code', 'pre', '|', 'undo'],
    });
  }
}

document.addEventListener('DOMContentLoaded', hApplyEditor);
