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
    $columns = $this->columns;

    // create the WP filter name
    $name_create = "manage_" . $name . "_posts_columns"; // create column
    $name_fill = "manage_" . $name . "_posts_custom_column"; // fill column
    $name_sortable = "manage_edit-" . $name . "_sortable_columns"; // enable sorting

    // cleanup and build the dataset
    $columns = $this->clean_columns($columns);
    $this->columns = $columns;

    $sortable_columns = $this->get_sortable_columns($raw_columns);

    $filter_fill = function($name, $post_id) use ($columns) {
      $content = H_PostColumn::_fill_column($name, $post_id, $columns);
      echo $content;
    };

    // enable sorting by clicking the table header
    $filter_sortable = function($defaults) use ($sortable_columns) {
      foreach($sortable_columns as $sc) {
        $defaults[$sc] = $sc;
      }
      return $defaults;
    };

    // additional wp args if sort by custom field
    // TODO: bug with custom name
    $metakey_sortable = function($vars) use ($sortable_columns) {
      $vars = H_PostColumn::_orderby_meta($vars, $sortable_columns);
      return $vars;
    };

    add_filter($name_create, array($this, "filter_create") );
    add_action($name_fill, $filter_fill, 10, 2);
    add_filter($name_sortable, $filter_sortable);
    add_filter("request", $metakey_sortable);
  }

  //////////

  /*
    Clean all the annotation in the dataset

    @param array $raw - Passed column args
    @return array - The neat and tidy Columns data
  */
  private function clean_columns($raw) {
    $columns = array_map(function($r) {
      if(is_string($r) ) {
        return trim($r, "^");
      } else {
        return $r;
      }
    }, $raw);

    return $columns;
  }

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
      $columns[$col["slug"]] = $col;
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
      "slug" => "",
      "title" => "",
      "sortable" => false,
      "editable" => false,
      "content" => "",
    );

    // if contains Caret, it's sortable
    if(strpos($text, "^") ) {
      $text = trim($text, "^");
      $col["sortable"] = true;
    }

    $col["slug"] = H_Util::to_slug($text);
    $col["title"] = H_Util::to_title($text);
    $col["content"] = $value;

    return $col;
  }

  /*
    Get list of Sortable columns

    @param array $columns - All column data
    @return array - List of sortable column's slug.
  */
  private function get_sortable_columns($columns) {
    $sortable_columns = array_reduce($columns, function($result, $c) {
      if($c["sortable"]) {
        array_push($result, $c["slug"]);
      }

      return $result;
    }, array() );

    return $sortable_columns;
  }

  //////////

  public function filter_create($defaults) {
    $list = H_PostColumn::_create_column($defaults, $this->columns);
    return $list;
  }

  /*
    List out all the columns in accepted format

    @param array $defaults - The current column list
    @param array $columns - Passed columns data

    @return array - The new list
  */
  public static function _create_column($defaults, $columns) {
    $list = array();
    foreach($columns as $col) {
      $list[$col["slug"] ] = $col["title"];
    }

    $list = array("cb" => $defaults["cb"]) + $list;
    return $list;
  }

  /*
    Fill the column, row by row

    @param string $name - The column slug registered at filter_create()
    @param int $post_id - The post ID of current row
    @param array $columns - Passed columns data

    @return string - The content of the column
  */
  public static function _fill_column($name, $post_id, $columns) {
    switch($name) {
      case "cb":
      case "title":
      case "author":
      case "date":
        // do nothing, those are automatically filled
        break;
      case "thumbnail":
        $thumb = get_the_post_thumbnail($post_id, array(75, 75) );
        return $thumb;

      case "category":


      // if custom field
      default:
        global $post;
        $content = $columns[$name]["content"];

        // if function, run it
        if(isset($content) && is_callable($content) ) {
          $fields = get_fields($post_id);
          return $content($post, $fields);
        }
        // if plain string, look for the custom field
        else {
          $output = H_PostColumn::_get_meta($name, $post_id);
          return $output;
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
  public static function _get_meta($name, $post_id) {
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
        $out[] = sprintf("<a href='%s'>%s</a>",
          esc_url( add_query_arg(
            array("post_type" => $post->post_type, "type" => $term->slug), "edit.php")
          ),
          esc_html( sanitize_term_field(
            "name", $term->name, $term->term_id, "type", "display")
          )
        );
      }

      // join the terms, separating with comma
      return join(", ", $out);
    }
  }

  /*
    Add parameters to allow sorting by Custom field

    @param array $vars - The WP Args
    @param array $sortable_columns - Sortable column data

    @return array - The modified $vars to include sorting method
  */
  public static function _orderby_meta($vars, $sortable_columns) {
    $is_orderby_meta = isset($vars["orderby"]) && in_array($vars["orderby"], $sortable_columns);

    if ($is_orderby_meta) {
      $vars = array_merge($vars, array(
        "meta_key" => $vars["orderby"],
        "orderby" => "meta_value"
      ));
    }
    return $vars;
  }

}
