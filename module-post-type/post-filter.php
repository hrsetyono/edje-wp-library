<?php namespace h;
/*
  Add Taxonomy filter to a CPT
  @author Ohad Raz <admin@bainternet.info>
*/
class Post_Filter {
  private $post_type;
  private $taxonomy;
  private $post_taxonomies;

  public function __construct( $post_type, $taxonomy ) {
    $this->post_type = $post_type;
    $this->taxonomy = $taxonomy;

    $this->post_taxonomies = array( $post_type => array( $taxonomy ) );
  }

  public function add() {
    if( !is_admin() ) { return false; }

    add_action( 'restrict_manage_posts', array( $this, 'my_restrict_manage_posts' ) );
  }

  /*
    Add select dropdown per taxonomy
  */
  public function my_restrict_manage_posts() {
    // only display these taxonomy filters on desired custom post_type listings
    global $typenow;

    $types = array_keys( $this->post_taxonomies );

    if( in_array($typenow, $types ) ) {
      // create an array of taxonomy slugs you want to filter by - if you want to retrieve all taxonomies, could use get_taxonomies() to build the list
      $filters = $this->post_taxonomies[ $typenow ];

      foreach( $filters as $tax ) {
        // retrieve the taxonomy object
        $tax_obj = get_taxonomy( $tax );
        $tax_name = $tax_obj->labels->menu_name;

        // output html for taxonomy dropdown filter
        $tax_slug = strtolower( $tax );
        echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
        echo "<option value=''>Show All $tax_name</option>";
        $this->generate_taxonomy_options( $tax, 0, 0,(isset( $_GET[ $tax_slug ] )? $_GET[ $tax_slug ] : null ) );
        echo "</select>";
      }
    }
  }

  /*
    Generate_taxonomy_options generate dropdown
  */
  public function generate_taxonomy_options( $tax_slug, $parent = '', $level = 0, $selected = null ) {
    $args = array('show_empty' => 1);

    if( !is_null( $parent ) ) {
      $args = array( 'parent' => $parent );
    }
    $terms = get_terms( $tax_slug, $args );
    $tab = '';

    for( $i = 0; $i < $level; $i++ ) {
      $tab .= '- ';
    }

    foreach( $terms as $term ) {
      // output each select option line, check against the last $_GET to show the current option selected
      $selected_attr = ( $selected == $term->slug ) ? ' selected="selected"' : '';
      echo "<option value={$term->slug} $selected_attr>$tab {$term->name} ({$term->count})</option>";
      $this->generate_taxonomy_options( $tax_slug, $term->term_id, $level + 1, $selected );
    }
  }
}
