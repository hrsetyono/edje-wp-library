/*
  Sharedaddy
*/

(function( $ ) {
  document.addEventListener('DOMContentLoaded', start)

  function start() {
    // copy the hidden links to main UL
    $('.share-more').on( 'click', function( e ) {
      e.preventDefault();

      $(this).closest('li').remove();

      var hiddenLinks = $('.sharing-hidden ul').html();
      $('.sd-content ul').append( hiddenLinks );
    });

    // print
    $('.share-print').on( 'click', function( e ) {
      e.preventDefault(); e.stopPropagation();
      window.print();
    } );
  }
})( jQuery );

/*
  WP Comment Form
*/
(function( $ ) {
  document.addEventListener( 'DOMContentLoaded', commentFormToggle );

  /*
    Open Comment Form and add Placeholder to the textarea
  */
  function commentFormToggle() {
    // exit if comment form not found
    if( $('#reply-title').length <= 0 ) { return false; }

    var replyTitle = document.getElementById( 'reply-title' ).childNodes;
    var replyTo = replyTitle[1].childNodes[0].nodeValue;
    var placeholder = replyTitle[0].nodeValue + (replyTo ? replyTo : '') + '…';

    $('.comment-form textarea').attr( 'placeholder', placeholder );
    $('.comment-form').on( 'click', activateForm );
    $('.comment-reply-link').on( 'click', activateForm );

    function activateForm( e ) {
      var $form = $('.comment-form');
      $form.addClass('active');
      $form.off('click').find('textarea').focus();
    }
  }
})( jQuery );

/*
  Responsive Videos
  @version 6.5
*/
!function(t){function a(){t(".jetpack-video-wrapper").find("embed, iframe, object").each(function(){var a,e,i,r,h,d,o;a=t(this),d=0,"center"===a.parents(".jetpack-video-wrapper").prev("p").css("text-align")&&(d="0 auto"),a.attr("data-ratio")||a.attr("data-ratio",this.height/this.width).attr("data-width",this.width).attr("data-height",this.height).css({display:"block",margin:d}),e=a.attr("data-width"),i=a.attr("data-height"),r=a.attr("data-ratio"),h=a.parent(),o=h.width(),"Infinity"===r&&(e="100%"),a.removeAttr("height").removeAttr("width"),e>o?a.width(o).height(o*r):a.width(e).height(i)})}var e;t(document).ready(function(){t(window).on("load.jetpack",a).on("resize.jetpack",function(){clearTimeout(e),e=setTimeout(a,500)}).on("post-load.jetpack",a).resize()})}(jQuery);
