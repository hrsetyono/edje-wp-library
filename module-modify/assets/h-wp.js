// This script is loaded on all front-end pages

/**
 * Gutenberg helper script
 */
(function() { 'use strict';
document.addEventListener( 'DOMContentLoaded', onReady );

function onReady() {
  commentFormToggle();
  jetpackSharing();
}

/////


/**
 * Open Comment Form and add Placeholder to the textarea
 */
function commentFormToggle() {
  // exit if comment form not found
  if( document.querySelector('#reply-title') === null ) { return; }

  // Create placeholder's text based on Form Title.
  let replyTitle = document.querySelector( '#reply-title' ).childNodes;
  let replyTo = replyTitle[1].childNodes[0].nodeValue;
  let placeholder = replyTitle[0].nodeValue + (replyTo ? replyTo : '') + '…';

  // change the comment field's placeholder
  document.querySelector('.comment-form textarea').setAttribute( 'placeholder', placeholder );
  
  // click listener to toggle the form
  document.querySelector('.comment-form').addEventListener( 'click', activateForm );
  
  let $replyLinks = document.querySelectorAll( '.comment-reply-link' );
  for( let $rl of $replyLinks ) {
    $rl.addEventListener( 'click', activateForm );
  }

  //
  function activateForm( e ) {
    var $form = document.querySelector( '.comment-form' );
    $form.classList.add( '--active' );
    $form.removeEventListener( 'click', activateForm );
    $form.querySelector( 'textarea' ).focus();
  }
}


/**
 * Jetpack Sharing module
 */
function jetpackSharing() {
  if( document.querySelector('.sharedaddy') == null ) { return; }

  _initMoreButton();
  _initPrintButton();


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

  /**
   * Print the website when Sharedaddy's print button is clicked
   */
  function _initPrintButton() {
    let $printButtons = document.querySelectorAll( '.sd-content .share-print' );
    for( let $pb of $printButtons ) {
      $pb.addEventListener( 'click', (e) => {
        e.preventDefault(); e.stopPropagation();
        window.print();
      } );
    }
  }

};

})();