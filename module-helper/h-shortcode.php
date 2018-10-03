<?php
/*
  EDJE default shortcode
*/
class H_Shortcode {
  function __construct() {
    add_shortcode( 'row', array($this, 'row') );
    add_shortcode( 'grid', array($this, 'grid') );
    add_shortcode( 'column', array($this, 'column') );

    // remove empty <p> on shortcode
    add_filter( 'the_content', array($this, 'shortcode_unautop'), 10 );
    add_filter( 'acf_the_content', array($this, 'shortcode_unautop') );
  }

  /*
    Deprecated, just returns whatever inside
  */
  function row( $atts, $content = null ) {
    return do_shortcode( $content );
  }
	
  /*
    Wrap the content with CSS3 Grid (only works in Edje >=2.0).
	You need to specify which is opening / closing grid  by adding "start" and "end" at the parameter.
	
	[grid size="8 start"]
	  ...
	[/grid] [grid size="4 end"]
	  ...
	[/grid]
  */
  function grid( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'size' => '12 start end',
    ), $atts);

    $opening = '';
    $closing = '</div>';

    // if contains "start", add opening of grid
    if( preg_match( '/start/', $atts['size'] ) ) {
      $opening .= '<h-grid>';
    }

    // add sizes
    if( preg_match( '/\d+/', $atts['size'], $size ) ) {
      $opening .= "<div class='large-$size[0]'>";
    } else {
      $opening .= "<div class='large-12'>";
    }

    // if contains "end", add closing of grid
    if( preg_match( '/end/', $atts['size'] ) ) {
      $closing .= '</h-grid>';
    }

    return $opening . do_shortcode($content) . $closing;
  }
  
  /*
    Wrap the content with old Grid (only works in Edje <2.0).
	You need to specify which is opening / closing grid  by adding "start" and "end" at the parameter.
	
	[column size="8 start"]
	  ...
	[/column] [column size="4 end"]
	  ...
	[/column]
  */
  function column( $atts, $content = null ) {
	$atts = shortcode_atts( array(
      'size' => '12 start end',
    ), $atts);

    $opening = '';
    $closing = '</h-column>';

    // if contains "start", add opening of grid
    if( preg_match( '/start/', $atts['size'] ) ) {
      $opening .= '<h-row>';
    }

    // add sizes
    if( preg_match( '/\d+/', $atts['size'], $size ) ) {
      $opening .= "<h-column class='large-$size[0]'>";
    } else {
      $opening .= "<h-column class='large-12'>";
    }

    // if contains "end", add closing of grid
    if( preg_match( '/end/', $atts['size'] ) ) {
      $closing .= '</h-row>';
    }

    return $opening . do_shortcode($content) . $closing;
  }


  function shortcode_unautop( $content ) {
    return strtr($content, array(
      '<p>[' => '[',
      ']</p>' => ']',
      ']<br />' => ']',
      '<p>[/' => '[/'
    ) );
  }
}
