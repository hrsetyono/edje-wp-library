<?php

/**
 * Add extra functionality to Twig module
 */
class H_Timber {
  function __construct() {
    add_filter( 'get_twig', [$this, 'add_to_twig'] );

    // enable password protected post
    add_filter( 'timber/post/content/show_password_form_for_protected', '__return_true' );
  }


  /**
   * Add default filter to Twig
   * @filter get_twig
   */
  function add_to_twig( $twig ) {
    // @deprecated - use h_markdown instead
    $twig->addFilter( new Twig_SimpleFilter( 'markdown', [$this, '_filter_markdown'] ) );
    $twig->addFilter( new Twig_SimpleFilter( 'h_markdown', [$this, '_filter_markdown'] ) );
    $twig->addFilter( new Twig_SimpleFilter( 'h_markdown_no_p', [$this, '_filter_markdown_no_p'] ) );

    $twig->addFilter( new Twig_SimpleFilter( 'h_get_timber_menu', [$this, '_filter_get_timber_menu'] ) );
    $twig->addFilter( new Twig_SimpleFilter( 'h_get_visible_attr', [$this, '_filter_get_visible_attr'] ) );
    $twig->addFilter( new Twig_SimpleFilter( 'h_get_columns_count', [$this, '_filter_columns_count'] ) );
    $twig->addFilter( new Twig_SimpleFilter( 'h_get_dropdown_attr', [$this, '_filter_dropdown_attr'] ) );

    // only if set to Debug mode
    if( defined('WP_DEBUG') && WP_DEBUG === true ) {
      $twig->addFilter( new Twig_SimpleFilter( 'dump', [$this, '_filter_dump'] ) );
      $twig->addFilter( new Twig_SimpleFilter( 'methods', [$this, '_filter_methods'] ) );
    }

    return $twig;
  }

  //


  /**
   * Parse Markdown
   *  
   * `{{ post.custom_field | h_markdown }}`
   */
  function _filter_markdown( $text ) {
    $pd = new \Parsedown();
    $text_compiled = $pd->text( $text );
    return do_shortcode( $text_compiled );
  }

  /**
   * Parse Markdown without wrapper <p>
   * 
   * `{{ post.custom_field | h_markdown_no_p }}`
   * 
   * @since 5.1.0
   */
  function _filter_markdown_no_p( $text ) {
    $pd = new \Parsedown();
    $text_compiled = $pd->text( $text );
    $text_compiled = preg_replace( '/<(\/)?p>/', '', $text_compiled ); // remove outer <p>

    return do_shortcode( $text_compiled );
  }

  
  
  /**
   * Convert Menu ID into TimberMenu object
   * 
   * ```
   * {% set menu = menu_id | h_get_timber_menu %}
   * // loop it
   * ```
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
   * <div {{ visibility | h_get_visible_attr }}>
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

    $data_visible = empty( $attr ) ? '' : implode( ' ', $attr );

    return "data-visible='{$data_visible}'";
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


  /**
   * Get the class for Desktop nav dropdown
   * 
   * {{ nav_item.children | h_get_dropdown_attr }}
   */
  function _filter_dropdown_attr( $nav_children, $base_class = 'nav-dropdown' ) {
    $class = $base_class;
    $count = 1;

    if( $nav_children[0]->children() ) {
      $count = count( $nav_children );
      $class .= " {$base_class}--wide";
    }

    return "class='{$class}' data-children='{$count}'";
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

new H_Timber();