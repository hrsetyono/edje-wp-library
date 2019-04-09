<?php

class H_Shortcode {
  function __construct() {
    add_shortcode( 'grid', [$this, 'grid'] );
    add_shortcode( 'button', [$this, 'button'] );
  }

  /*
    Wrap content with Edje's CSS Grid

      [grid $sizes <$state>] ... [/grid] 

    @atts $sizes - Column size between 1 to 12. Can specify mobile column with dash like 8-6 (meaning 8 on desktop, 6 on mobile).
    @atts $state (optional) - Either "start" or "end".

    Example:
      [grid 8-6 start]
        ...
      [/grid] [grid 4-6 end]
        ...
      [/grid]

    Result:
      <h-grid> <div class="large-8 small-6">
        ...
      </div> <div class="large-4 small-6">
        ...
      </div> </h-grid>
  */
  function grid( $atts, $content = null ) {
    $size = $atts[0] ?? '12';
    $state = $atts[1] ?? 'start';

    preg_match( '/^\d+/', $size, $large_size );
    preg_match( '/-(\d+)$/', $size, $small_size );

    // create opening and closing tag
    $opening = $state == 'start' ? '<h-grid>' : '';
    $closing = $state == 'end' ? '</div> </h-grid>' : '</div>';

    // form the column classes
    $classes = "large-$large_size[0]";
    $classes .= isset( $small_size[1] ) ? " small-$small_size[1]" : '';

    return $opening . "<div class='$classes'>" .  do_shortcode($content) . $closing;
  }


  /**
   * Add button class to the link inside
   *   [button $class1 $class2] link [/button]
   * 
   * @atts $class1 (string, optional) - Extra class name
   * @atts $class2 (string, optional)
   */
  function button( $atts, $content = null ) {
    $class1 = $atts[0] ?? '';
    $class2 = $atts[1] ?? '';

    // if have anchor inside, add button class
    if( preg_match( '/<a (.+?)>/', $content, $match ) ) {
      $content = substr_replace( $content, " class='button $class1 $class2' ", 3, 0 );
    }
    // else, make it into do-nothing button
    else {
      $content = "<a class='button $extra_class'>" . $content . '</a>';
    }

    return $content;
  }
}