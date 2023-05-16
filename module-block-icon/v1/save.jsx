/**
 * Deprecated: Using dynamic block instead
 */

import { RichText } from '@wordpress/block-editor';
import Helper from './_helpers.js';

export default function( props ) {
  let atts = props.attributes;

  let className = Helper.formatClassName( props );
  let style = {
    '--textColor': atts.textColor,
    '--bgColor': atts.bgColor,
  };
  let content = ( <>
    <figure  dangerouslySetInnerHTML={{ __html: atts.iconMarkup }}></figure>
    <dl>
      <RichText.Content tagName="dt" value={ atts.heading } />
      { atts.hasDescription && <RichText.Content tagName="dd" value={ atts.description } /> }
    </dl>
  </> );

  return ( atts.url && atts.isFullyClickable ?
    <a className={ className } style={ style }
      href={ atts.url } target={ atts.linkTarget }>
      { content }
    </a>
  :
    <div className={ className } style={ style }>
      { content }
    </div>
  );
};