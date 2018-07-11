<?php namespace h;
/*
  Add custom column to CPT listing table
*/
class Post_Column {
  private $post_type;
  private $columns;

  public function __construct() {}

  /*
    Override all columns from the post type table.
    @since 0.9.0

    @param $post_type (string)
    @param $args (array) - List of columns
  */
  function override( $post_type, $args ) {
    $this->post_type = $post_type;
    $this->columns = $this->_parse_args( $args );

    $this->_manage_columns( array($this, '_override') );
  }

  /*
    Append a column to the post type table. Placed before "date".

    @param $post_type (string)
    @param $arg (string / array) - Keyword or Argument for the new column
  */
  function add( $post_type, $arg ) {
    $this->post_type = $post_type;

    // if keyword
    if( is_string( $arg ) ) {
      $this->columns = $this->_parse_args( array($arg) );
    }
    // if array AND has Name
    elseif( is_array( $arg ) && isset( $arg['name'] ) ) {
      $args = isset( $arg['content'] )
        ? array( $arg['name'] => $arg['content'] )
        : array( $arg['name'] );
      $this->columns = $this->_parse_args( $args );
    } else {
      var_dump( 'ERROR - H::add_column has invalid arguments' );
      return false;
    }

    $this->_manage_columns( array($this, '_add') );
  }


  /////

  /*
    Manage filters and actions to create custom columns

    @param $manage_cb (function) - Callback to create column orders.
  */
  function _manage_columns( $manage_cb ) {
    $manage_columns = "manage_{$this->post_type}_posts_columns";
    $fill_columns = "manage_{$this->post_type}_posts_custom_column";
    $sortable_columns = "manage_edit-{$this->post_type}_sortable_columns";

    add_filter( $manage_columns, $manage_cb, 100 );
    add_action( $fill_columns, array($this, '_fill_columns'), 10, 2 );
    add_filter( $sortable_columns, array($this, '_enable_sort_columns') );
    add_filter( 'request', array($this, '_allow_sort_by_metakey') );
  }

  /*
    @filter manage_CPT_posts_columns

    @param array $defaults - The current column list
    @return array - The new list
  */
  function _override( $defaults ) {
    $columns = $this->columns;

    $list = array();
    foreach( $columns as $c ) {
      $list[ $c['slug'] ] = $c['name'];
    }

    $list = array( 'cb' => $defaults['cb'] ) + $list;
    return $list;
  }

  /*
    @filter manage_CPT_posts_columns

    @param array $defaults - The current column list
    @return array - The updated list
  */
  function _add( $defaults ) {
    $column = reset( $this->columns );

    // if position is specified
    $position = isset( $column['position'] ) ? $column['position'] : false;
    if( $position && isset( $defaults[ $position ]) ) {

      $list = array();
      foreach( $defaults as $slug => $col ) {
        $list[ $slug ] = $col;

        // if loop have reached the position
        if( $position == $slug ) {
          $list[ $column['slug'] ] = $column['name'];
        }
      }
      return $list;
    }
    // if no position
    else {
      $defaults[ $column['slug'] ] = $column['name'];
      return $defaults;
    }
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
          // TODO: add check whether ACF exists, if not, use native get_post_custom($id);
          $fields = \get_fields( $post_id );
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

  /////

  /*
    Parse all the annotation in the dataset into accepted Array format

    @param array $args - Original column args
    @return array - The parsed and neat column data
  */
  private function _parse_args( $args ) {
    $columns = array();

    foreach( $args as $key => $value ) {
      // Since the array is mix between Key-Value and Single, the Key become integer for single array
      // We need to replace it with the value
      $name = is_int( $key ) ? $value : $key;

      $col = $this->_format_arg( $name, $value );
      $columns[ $col['slug'] ] = $col;
    }

    return $columns;
  }

  /*
    Format an argument into neat array

    @param $name (string) - The column header name
    @param $value (string / function)
    @return array - The formatted argument
  */
  private function _format_arg( $name, $value ) {
    $col = array(
      'name' => '',
      'slug' => '',
      'content' => $value,
      'sortable' => preg_match( '/\^/', $name ) ? true : false,
      'icon' => preg_match( '/#(dashicons-\S+)/', $name, $matches ) ? $matches[1] : '',
      'position' => preg_match( '/>(\S+)/', $name, $matches ) ? $matches[1] : '',
    );

    // clean name
    $name = preg_replace( '/#dashicons-\S+|\^|>\S+/', '', $name );
    $name = trim( $name );

    // format slug
    $col['slug'] = \_H::to_param( $name );
    if( $col['slug'] === 'comments' ) { // Comments always goes with icon
      $col['icon'] = 'dashicons-admin-comments';
    }

    // format name
    $name = \_H::to_title( $name );
    if( $col['icon'] ) {
      $name = "<span class='dashicons {$col['icon']}'></span> <span class='screen-reader-text'>{$name}</span>";
    }
    $col['name'] = $name;

    return $col;
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
