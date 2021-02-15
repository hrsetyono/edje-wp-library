<?php

/**
 * Create a separate div for the next set of widgets.
 * 
 * In Header, it will divide the widgets into left / center / right position.
 * In Footer, it will divide them into equal sized div.
 */
class H_Widget_Separator extends H_Widget { 
  function __construct() {
    parent::__construct( 'h_separator',  __( '-----' ), [
        'description' => __( 'Split the widgets' )
    ] );
  }

  public function widget( $args, $instance ) {
    $id = $args['widget_id'];
    $size = get_field( 'footer_size', "widget_$id" );
    $style = '';

    if( $size !== 'auto' ) {
      $style = "style='--columnSize:$size'";
    }

    $content = "</ul><ul class=\"widget-column\" {$style}>";
    $content = apply_filters( 'h_widget_separator', $content, $args );

    echo $content;
  }
}