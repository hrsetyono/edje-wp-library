# Edje WP Framework

![Edje Wordpress](http://cdn.setyono.net/edge/wp-edge.jpg)

WordPress allows tons of customization, but it's painfully complicated. Edje WP is a plugin to helps developers do that.

Visit our [WIKI](https://github.com/hrsetyono/edje-wp/wiki) for full documentation.

## Sample Features

Create new Custom Post Type (CPT)

    H::register_post_type("product");

Add new Admin menu

    H::add_menu("Home", array(
      "slug" => "post.php?post=10&action=edit",
      "icon" => "dashicons-admin-home",
      "position" => "above Pages"
    ));

Put a Number counter besides an Admin menu

    H::add_menu_counter("Posts", "count_drafted_posts");

    function count_drafted_posts() {
      $posts = Timber::get_posts(array(
        "post_type" => "post",
        "post_status" => "draft",
      ));

      return count($posts);
    }
