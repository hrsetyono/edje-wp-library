<?php namespace h;
/*
  Add custom column to CPT listing table
*/
class Post_Column {
  private $name;
  private $columns;

  public function __construct( $name, $column_args ) {
    $this->name = $name;
    $this->columns = $this->parse_args( $column_args );
  }

  // Add visible column in admin panel
  function init() {
    if( !is_admin() ) { return false; }

    $name = $this->name;

    // create the WP filter name
    $name_create = 'manage_' . $name . '_posts_columns'; // create column
    $name_fill = 'manage_' . $name . '_posts_custom_column'; // fill column
    $name_sortable = 'manage_edit-' . $name . '_sortable_columns'; // enable sorting

    add_filter( $name_create, array($this, 'create_columns') );
    add_action( $name_fill, array($this, 'fill_columns'), 10, 2 );
    add_filter( $name_sortable, array($this, 'enable_sort_columns') );
    add_filter( 'request', array($this, 'allow_sort_by_metakey') );
  }

  /*
    List out all the columns in accepted format

    @param array $defaults - The current column list

    @return array - The new list
  */
  function create_columns( $defaults ) {
    $columns = $this->columns;

    $list = array();
    foreach( $columns as $col ) {
      $list[$col['slug'] ] = $col['title'];
    }

    $list = array('cb' => $defaults['cb']) + $list;
    return $list;
  }

  /*
    Fill the column, row by row

    @param string $name - The column slug registered at filter_create()
    @param int $post_id - The post ID of current row
    @param array $columns - Passed columns data

    @return string - The content of the column
  */
  function fill_columns( $name, $post_id ) {
    global $post;
    $columns = $this->columns;

    switch( $name ) {
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
        $content = $columns[ $name ]['content'];

        // if function, run it
        if( isset( $content ) && is_callable( $content ) ) {
          // TODO: add check whether ACF exists, if not, use native get_post_custom($id);
          $fields = \get_fields( $post_id );
          echo $content( $post, $fields );
        }
        // if plain string, look for the custom field
        else {
          $output = $this->_get_meta_content( $name, $post_id );
          echo $output;
        }

        break;
    }
  }



    /*
      Apply sorting to List header
      @params array $defaults - Sortable column list

      @return array - The updated sortable column list
    */

    function enable_sort_columns( $defaults ) {
      $sortable_columns = $this->get_sortable_columns( $this->columns );

      foreach( $sortable_columns as $sc ) {
        $defaults[ $sc ] = $sc;
      }
      return $defaults;
    }

    /*
      Add parameters to allow sorting by Custom field

      @param array $vars - The WP Args
      @param array $sortable_columns - Sortable column data

      @return array - The modified $vars to include sorting method

      TODO: bug with Complex column
    */
    function allow_sort_by_metakey( $vars ) {
      $sortable_columns = $this->get_sortable_columns( $this->columns );

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
  private function parse_args( $args ) {
    $columns = array();

    foreach( $args as $key => $value ) {
      // Since the array is mix between Key-Value and Single, the Key become integer for single array
      // We need to replace it with the value
      $title = is_int( $key ) ? $value : $key;

      $col = $this->format_arg( $title, $value );
      $columns[ $col['slug'] ] = $col;
    }

    return $columns;
  }

  /*
    Format an argument into neat array

    @param $title (string)
    @param $value (string) -

    @return array - The formatted argument
  */
  private function format_arg( $title, $value ) {
    $col = array(
      'title' => '',
      'slug' => '',
      'content' => $value,
      'sortable' => preg_match( '/\^/', $title ) ? true : false,
      'icon' => preg_match( '/#(dashicons-.+)/', $title, $matches ) ? $matches[1] : '',
    );

    // clean title
    $title = preg_replace( '/#dashicons-.+|\^|\s/', '', $title );

    // format slug
    $col['slug'] = \_H::to_param( $title );
    if( $col['slug'] === 'comments' ) { // Comments always goes with icon
      $col['icon'] = 'dashicons-admin-comments';
    }

    // format title
    $title = \_H::to_title( $title );
    if( $col['icon'] ) {
      $title = "<span class='dashicons {$col['icon']}'></span> <span class='screen-reader-text'>{$title}</span>";
    }
    $col['title'] = $title;

    return $col;
  }

  /*
    Get list of Sortable columns

    @param array $columns - All column data
    @return array - List of sortable column's slug.
  */
  private function get_sortable_columns( $columns ) {
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
