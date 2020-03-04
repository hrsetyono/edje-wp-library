<?php


/**
 * Add extra functionality to Twig module
 */
class H_TimberFilters {
  function __construct() {
    add_filter('get_twig', [$this, 'add_to_twig'] );
  }


  /**
   * Add default filter to Twig
   * @filter get_twig
   */
  function add_to_twig( $twig ) {
    // @deprecated - use h_markdown instead
    $twig->addFilter( new \Twig_SimpleFilter( 'markdown', [$this, '_filter_markdown'] ) );

    $twig->addFilter( new \Twig_SimpleFilter( 'h_markdown', [$this, '_filter_markdown'] ) );
    $twig->addFilter( new \Twig_SimpleFilter( 'h_get_timber_menu', [$this, '_filter_get_timber_menu'] ) );
    $twig->addFilter( new \Twig_SimpleFilter( 'h_get_visible_attr', [$this, '_filter_get_visible_attr'] ) );
    $twig->addFilter( new Twig_SimpleFilter( 'h_get_social_label', [$this, '_filter_social_label'] ) );
    $twig->addFilter( new Twig_SimpleFilter( 'h_get_columns_count', [$this, '_filter_columns_count'] ) );
    
    

    // only if set to Debug mode
    if( defined('WP_DEBUG') && WP_DEBUG === true ) {
      $twig->addFilter( new \Twig_SimpleFilter( 'dump', [$this, '_filter_dump'] ) );
      $twig->addFilter( new \Twig_SimpleFilter( 'methods', [$this, '_filter_methods'] ) );
    }

    return $twig;
  }

  //


  /**
   * Parse Markdown
   *  
   * `{{ post.custom_field | markdown }}`
   */
  function _filter_markdown( $text ) {
    $pd = new \Parsedown();
    $text_compiled = $pd->text( $text );
    return do_shortcode( $text_compiled );
  }

  /**
   * Convert Menu ID into TimberMenu object
   * 
   * `{{ menu_id | h_get_timber_menu }}
   * 
   * @return TimberMenu
   */
  function _filter_get_timber_menu( $menu_id ) {
    return new Timber\Menu( $menu_id );
  }

  /**
   * Parse the Visiblity value into string.
   * 
   * Usage:
   * ```    
   * <div data-visible="{{ visibility | h_get_visible_attr }}">
   *   ...
   * </div>
   * ```
   * 
   * @return string - All the visible media, separated with space
   */
  function _filter_get_visible_attr( $visibility ) : string {
    $attr = [];

    foreach( $visibility as $media => $is_visible ) {
      if( $is_visible ) {
        $attr[] = $media;
      }
    }

    return empty( $attr ) ? '' : implode( ' ', $attr );
  }

  /**
   * Get the label of Social Media buttons in Header / Footer
   */
  function _filter_social_label( $context, $id, $default_label = false ) {
    if( $context['has_text'] == 'no' ) { return; }

    $label = $context[ "{$id}_label" ] ?? $default_label;
    return $label;
  }

  /**
   * Get the number of Header columns. If Middle column is occupied, set to 3 no matter what
   */
  function _filter_columns_count( $row ) {
    $type = isset( $row['placements'] ) ? 'header' : 'footer';

    if( $type == 'footer' ) {
      return count( $row['columns'] );
    }
    elseif( $type == 'header' ) {
      // if has middle column, it become 3
      $has_middle = false;
      foreach( $row['placements'] as $column ) {
        if( $column['id'] == 'middle' ) {
          $has_center = true;
          return 3;
        }
      }

      return count( $row['placements'] );
    }
  }

  /////

  /**
   * Echo the data
   *   
   * `{{ post | dump }}`
   */
  function _filter_dump( $anything ) {
    var_dump( $anything );
  }

  /**
   * Echo all the methods of an object
   *   
   * `{{ post | methods }}`
   */
  function _filter_methods( $object ) {
    var_dump( get_class_methods( $object ) );
  }
}
