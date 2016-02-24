<?php
class H_PostColumn {
  private $name;
  private $columns;

  public function __construct($name, $column_args) {
    $this->name = $name;
    $this->columns = $this->parse_args($column_args);
  }

  // Add visible column in admin panel
  public function init() {
    $name = $this->name;

    // create the WP filter name
    $name_create = 'manage_' . $name . '_posts_columns'; // create column
    $name_fill = 'manage_' . $name . '_posts_custom_column'; // fill column
    $name_sortable = 'manage_edit-' . $name . '_sortable_columns'; // enable sorting

    add_filter($name_create, array($this, '_filter_create') );
    add_action($name_fill, array($this, '_filter_fill'), 10, 2);
    add_filter($name_sortable, array($this, '_filter_sortable') );
    add_filter('request', array($this, '_metakey_sortable') );
  }

  //////////

  /*
    Parse all the annotation in the dataset into accepted Array format

    @param array $args - Original column args
    @return array - The parsed and neat column data
  */
  private function parse_args($args) {
    $columns = array();

    foreach($args as $key => $value) {
      $text = is_string($key) ? $key : $value;
      $col = $this->format_arg($text, $value);
      $columns[$col['slug']] = $col;
    }

    return $columns;
  }

  /*
    Format an argument into neat array

    @param string $text - Either the key or value of Columns arg, whichever is string
    @return array - The formatted argument
  */
  private function format_arg($text, $value) {
    $col = array(
      'slug' => '',
      'title' => '',
      'sortable' => false,
      'editable' => false,
      'content' => '',
    );

    // if contains Caret, it's sortable
    if(strpos($text, '^') ) {
      $text = trim($text, '^');
      $col['sortable'] = true;
    }

    $col['slug'] = H_Util::to_param($text);
    $col['title'] = H_Util::to_title($text);
    $col['content'] = $value;

    return $col;
  }

  /*
    Get list of Sortable columns

    @param array $columns - All column data
    @return array - List of sortable column's slug.
  */
  private function get_sortable_columns($columns) {
    $sortable_columns = array_reduce($columns, function($result, $c) {
      if($c['sortable']) {
        array_push($result, $c['slug']);
      }

      return $result;
    }, array() );

    return $sortable_columns;
  }

  //////////

  /*
    List out all the columns in accepted format

    @param array $defaults - The current column list

    @return array - The new list
  */
  public function _filter_create($defaults) {
    $columns = $this->columns;

    $list = array();
    foreach($columns as $col) {
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
  public function _filter_fill($name, $post_id) {
    global $post;
    $columns = $this->columns;

    switch($name) {
      case 'cb':
      case 'title':
      case 'author':
      case 'date':
        // do nothing, those are automatically filled
        break;

      case 'content':
        echo get_the_excerpt();
        break;

      case 'thumbnail':
        $thumb = get_the_post_thumbnail($post_id, array(75, 75) );
        echo $thumb;

      // if custom field
      default:
        $content = $columns[$name]['content'];

        // if function, run it
        if(isset($content) && is_callable($content) ) {
          // TODO: add check whether ACF exists, if not, use native get_post_custom($id);
          $fields = get_fields($post_id);
          echo $content($post, $fields);
        }
        // if plain string, look for the custom field
        else {
          $output = $this->_get_meta_content($name, $post_id);
          echo $output;
        }

        break;
    }
  }

  /*
    Get the content of a Meta field or Taxonomy

    @param string $name - The column slug
    @param int $post_id

    @return string - Plain text or HTML to be echoed out.
  */
  private static function _get_meta_content($name, $post_id) {
    global $post;

    $meta = get_field($name, $post_id);
    $terms = get_the_terms($post_id, $name);

    // is a term if no error and has been ticked
    $is_terms = !isset($terms->errors) && $terms;

    // if the column is a custom field
    if($meta) {
      return $meta;
    }
    // if the column is a term
    elseif ($is_terms) {
      $out = array();

      // loop through each term, linking to the 'edit posts' page for the specific term
      foreach ($terms as $term) {
        $out[] = sprintf('<a href="%s">%s</a>',
          esc_url( add_query_arg(
            array('post_type' => $post->post_type, 'type' => $term->slug), 'edit.php')
          ),
          esc_html( sanitize_term_field(
            'name', $term->name, $term->term_id, 'type', 'display')
          )
        );
      }

      // join the terms, separating with comma
      return join(', ', $out);
    }
  }

  /*
    Apply sorting to List header
    @params array $defaults - Sortable column list

    @return array - The updated sortable column list
  */

  public function _filter_sortable($defaults) {
    $sortable_columns = $this->get_sortable_columns($this->columns);

    foreach($sortable_columns as $sc) {
      $defaults[$sc] = $sc;
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
  public function _metakey_sortable ($vars) {
    $sortable_columns = $this->get_sortable_columns($this->columns);

    $is_orderby_meta = isset($vars['orderby']) && in_array($vars['orderby'], $sortable_columns);

    if ($is_orderby_meta) {
      $vars = array_merge($vars, array(
        'meta_key' => $vars['orderby'],
        'orderby' => 'meta_value'
      ));
    }
    return $vars;
  }
}
