<?php

class Custy_OutputStyles {
  function __construct() {}

  /**
   * Output the styles
   */
  function echo_css( $styles ) {
    $mobile_media = Custy::get_mod( 'mobile_media' );
    $tablet_media = Custy::get_mod( 'tablet_media' );

    $output = '';
    $medias = [
      'desktop_css' => [
        'attr' => '',
        'id' => 'ct-main-styles-inline-css',
      ],
      'tablet_css' => [
        'attr' => "media='(max-width: $tablet_media)'",
        'id' => 'ct-main-styles-tablet-inline-css',
      ],
      'mobile_css' => [
        'attr' => "media='(max-width: $mobile_media)'",
        'id' => 'ct-main-styles-mobile-inline-css',
      ],
    ];
    
    foreach( $medias as $key => $args ):
      if( count($styles[ $key ]) <= 0 ) { continue; }

      // add <style> tag
      $output .= "<style type='text/css' id='{$args['id']}' {$args['attr']}>";
      
      // add css properties
      foreach( $styles[ $key ] as $selector => $css ):
        $output .= " $selector { ";

        foreach( $css as $prop => $value ) {
          $output .= " $prop: $value; ";
        }

        $output .= " } \n\n";
      endforeach;

      $output .= "</style>";
    endforeach;

    echo '<!-- Customizer -->';
    echo $output;
    echo '<!-- /Customizer -->';
  }
}