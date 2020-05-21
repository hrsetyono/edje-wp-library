// This script is loaded on all front-end pages

/**
 * Gutenberg helper script
 */
(function() { 'use strict';
document.addEventListener( 'DOMContentLoaded', onReady );

function onReady() {
  jetpackSharing();
}

/////


/**
 * Jetpack Sharing module
 */
function jetpackSharing() {
  if( document.querySelector('.sharedaddy') == null ) { return; }

  _initMoreButton();


  /**
   * Move the hidden sharing buttons to main list when MORE is clicked
   */
  function _initMoreButton() {
    let $moreButtons = document.querySelectorAll( '.share-more' );
    for( let $mb of $moreButtons ) {
      $mb.addEventListener( 'click', (e) => {
        e.preventDefault();
        let $shareButtons = e.currentTarget.closest('ul');
        let $shareWrapper = e.currentTarget.closest('.sd-content');

        // remove More button
        e.currentTarget.closest('li').removeChild( e.currentTarget );

        // get hidden links and append it to main list
        let $shareHidden = $shareWrapper.querySelector( '.sharing-hidden' )
        for( let $button of $shareHidden.querySelectorAll('ul li') ) {
          $shareButtons.appendChild( $button );
        }

        // remove hidden share
        $shareHidden.parentElement.removeChild( $shareHidden );
      } );
    }
  }

};

})();