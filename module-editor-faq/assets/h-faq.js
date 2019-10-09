(function( $ ) { 'use strict';
document.addEventListener( 'DOMContentLoaded', faqListener );

/**
 * Toggle the Pullquote when clicking the Citation
 * 
 * @event DOMContentLoaded
 */
function faqListener() {
  let $faqs = document.querySelectorAll( '.wp-block-pullquote cite' );

  for( let $f of $faqs ) {
    $f.addEventListener( 'click', _onClick );
    $f.addEventListener( 'keydown', _onPressEnter ); // can be toggled by pressing Enter
    $f.setAttribute( 'tabindex', 0 );
  }

  //
  function _onClick( e ) {
    _toggle( e.currentTarget );
  }

  function _onPressEnter( e ) {
    if( e.keyCode === 13 ) {
      _toggle( e.currentTarget );
    }
  }

  function _toggle( $cite ) {
    let $faqWrapper = $cite.closest( '.wp-block-pullquote' );
    $faqWrapper.classList.toggle( '--expanded' );
  }
}

})( jQuery );