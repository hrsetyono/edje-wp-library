<?php namespace h;
/*
  Add custom column to CPT listing table
*/
class Post_Column {
  private $post_type;
  private $columns = [];

  public function __construct() {}

  /**
   * Override all columns of a post type table
   */
  function override_columns( string $post_type, array $columns ) {
    $this->post_type = $post_type;

    foreach( $columns as $slug => $args ) {
      $parsed = $this->parse_column( $slug, $args );
      $this->columns[ $slug ] = $parsed;
    }

    $this->_manage_columns( [$this, '_override_columns'] );
  }


  /**
   * Append a column to the post type table.
   */
  function add_column( string $post_type, string $slug, array $args = [] ) {
    $this->post_type = $post_type;

    $parsed_col = $this->parse_column( $slug, $args );
    $this->columns[ $slug ] = $parsed_col;

    $this->_manage_columns( [$this, '_add_column'] );
  }

  /////
  
  /**
   * Format the args to cleaner
   */
  private function parse_column( $slug, $args = [] ) {
    $args = wp_parse_args( $args, [
      'name' => null,
      'content' => false,
      'icon' => false,
      'sortable' => false,
      'position_before' => '',
      'position_after' => '',
    ] );


    $args['name'] = $args['name'] ?? \_H::to_title( $slug );


    // Comments always goes with icon
    if( $slug === 'comments' ) { 
      $args['icon'] = 'dashicons-admin-comments';
    }

    // If has icon, replace its name
    if( $args['icon'] ) {
      if( preg_match( '/^dashicons-/', $args['icon'], $has_prefix ) ) {
        $args['icon'] =  'dashicons-' . $args['icon'];
      }
       
      $args['name'] = "<span class='dashicons {$args['icon']}'></span> <span class='screen-reader-text'>{$args['name']}</span>";
    }

    // If both position is empty, add one
    if( empty( $args['position_before'] ) && empty( $args['position_after'] ) ) {
      $args['position_before'] = 'date';
    }


    return $args;
  }


  /*
    Manage filters and actions to create custom columns

    @param $manage_cb (function) - Callback to create column orders.
  */
  function _manage_columns( $manage_cb ) {
    $pt = $this->post_type;
    add_filter( "manage_{$pt}_posts_columns",         $manage_cb, 100 );
    add_action( "manage_{$pt}_posts_custom_column",   [$this, '_fill_columns'], 10, 2 );
    add_filter( "manage_edit-{$pt}_sortable_columns", [$this, '_enable_sort_columns'] );
    add_filter( 'request', [$this, '_allow_sort_by_metakey'] );
  }
  

  /////


  /*
    @filter manage_CPT_posts_columns

    @param array $defaults - The current column list
    @return array - The new list
  */
  function _override_columns( $defaults ) {
    $columns = $this->columns;

    $list = [];
    foreach( $columns as $slug => $args ) {
      $list[ $slug ] = $args['name'];
    }

    // always start with checkbox
    $list = [ 'cb' => $defaults['cb'] ] + $list;
    return $list;
  }


  /**
   * @filter manage_CPT_posts_columns
   * 
   * @param array $defaults - The current column list
   * @return array - The updated list
   */
  function _add_column( $defaults ) {
    reset( $this->columns );
    $first_key = key( $this->columns );

    $column = $this->columns[ $first_key ];

    // form a new list
    $list = [];
    foreach( $defaults as $slug => $name ) {
      if( $column['position_before'] === $slug ) {
        $list[ $column['slug'] ] = $column['name'];
      }

      $list[ $slug ] = $name;

      if( $column['position_after'] === $slug ) {
        $list[ $column['slug'] ] = $column['name'];
      }
    }
    
    return $list;
  }

  /*
    Fill the column, row by row
    @action manage_CPT_posts_custom_column

    @param $slug (string) - The column slug registered at filter_create()
    @param $post_id (int) - The post ID of current row
    @return string - The content of the column
  */
  function _fill_columns( $slug, $post_id ) {
    global $post;
    $columns = $this->columns;
    if( !isset( $columns[ $slug ] ) ) { return false; }

    switch( $slug ) {
      case 'cb':
      case 'title':
      case 'author':
      case 'date':
      case 'categories':
      case 'comments':
      case 'tags':
        // do nothing, those are automatically filled
        break;

      case 'content':
        echo get_the_excerpt();
        break;

      case 'thumbnail':
        $thumb = get_the_post_thumbnail( $post_id, array(75, 75) );
        echo $thumb;
        break;

      // if custom field
      default:
        $content = $columns[ $slug ]['content'];

        // if function, run it
        if( isset( $content ) && is_callable( $content ) ) {
          $fields = get_post_custom( $post_id );
          echo $content( $post, $fields );
        }
        // if plain string, look for the custom field
        else {
          $output = $this->_get_meta_content( $slug, $post_id );
          echo $output;
        }

        break;
    }
  }



  /*
    Apply sorting to List header
    @filter manage_edit-CPT_sortable_columns

    @params array $defaults - Sortable column list
    @return array - The updated sortable column list
  */
  function _enable_sort_columns( $defaults ) {
    $sortable_columns = $this->_get_sortable_columns( $this->columns );

    foreach( $sortable_columns as $sc ) {
      $defaults[ $sc ] = $sc;
    }
    return $defaults;
  }


  /*
    Add parameters to allow sorting by Custom field
    @filter request

    @param array $vars - The WP Args
    @param array $sortable_columns - Sortable column data
    @return array - The modified $vars to include sorting method

    TODO: bug with Complex column
  */
  function _allow_sort_by_metakey( $vars ) {
    $sortable_columns = $this->_get_sortable_columns( $this->columns );

    $is_orderby_meta = isset( $vars['orderby'] ) && in_array( $vars['orderby'], $sortable_columns );

    if( $is_orderby_meta ) {
      $vars = array_merge( $vars, array(
        'meta_key' => $vars['orderby'],
        'orderby' => 'meta_value'
      ));
    }
    return $vars;
  }


  /*
    Get list of Sortable columns

    @param array $columns - All column data
    @return array - List of sortable column's slug.
  */
  private function _get_sortable_columns( $columns ) {
    $sortable_columns = array_reduce( $columns, function($result, $c) {
      if( $c['sortable'] ) {
        $result[] = $c['slug'];
      }

      return $result;
    }, array() );

    return $sortable_columns;
  }

  /*
    Get the content of a Meta field or Taxonomy

    @param string $name - The column slug
    @param int $post_id

    @return string - Plain text or HTML to be echoed out.
  */
  private static function _get_meta_content( $name, $post_id ) {
    global $post;

    $meta = function_exists( 'get_field' ) ? get_field( $name, $post_id ) : get_post_meta( $post_id, $name );
    $terms = get_the_terms( $post_id, $name );

    // is a term if no error and has been ticked
    $is_terms = !isset( $terms->errors ) && $terms;

    // if the column is a custom field
    if( $meta ) {
      return $meta;
    }
    // if the column is a term
    elseif( $is_terms ) {
      $out = array();

      // loop through each term, linking to the 'edit posts' page for the specific term
      foreach( $terms as $term ) {
        $out[] = sprintf('<a href="%s">%s</a>',
          esc_url( add_query_arg(
            array( 'post_type' => $post->post_type, 'type' => $term->slug ), 'edit.php' )
          ),
          esc_html( sanitize_term_field(
            'name', $term->name, $term->term_id, 'type', 'display')
          )
        );
      }

      // join the terms, separating with comma
      return join( ', ', $out );
    }
  }

}
