## Edje WP Framework

![Edje Wordpress](http://cdn.setyono.net/edge/wp-edge.jpg)

WordPress allows tons of customization, but it's painfully complicated. Edje WP is a plugin to helps developers do that.

For all the examples below, put them on `functions.php`;

**Note**: This plugin works best with our [Edje WP Template](http://github.com/hrsetyono/edje).

### Custom Post Type

![Wordpress Custom Type](http://cdn.setyono.net/edge/wp-post-type.jpg)

    H::register_post_type( $name, <$args> )

**$name** - Must be singular and lower-cased:

    H::register_post_type( "product" );
    H::register_post_type( "event" );

Optional arguments list:

**icon** - Icon names are listed here [https://developer.wordpress.org/resource/dashicons/](https://developer.wordpress.org/resource/dashicons/).

**taxonomy** - The custom taxonomy (category).

**columns** - Order of columns shown in admin panel. Possible values are: `title`, `author`, `date`, `thumbnail`, any custom field, and taxonomy.

Example:

    H::register_post_type( "product" , array(
      "icon" => "dashicons-cart",
      "taxonomy" => "brand",
      "columns" => array("thumbnail", "title", "price^", "date")
    ) );

### Advanced Arguments

**TAXONOMY**

The taxonomy "category" is already set to Post, so we can't use it anymore.

But there are many cases where we can't find better word than "category". Luckily, we got that covered:

    ...
    "taxonomy" => array(
      "label" => "Category",
      "slug" => "event_cat"
    )
    ...

This way, the front text says "Category" but the one registered in database is "event_cat".

**COLUMNS**

You can customize a column in any way you want by passing in a function.

    ...
    "columns" => array(
      "thumbnail",
      "title",
      "price",
      "discounted_price" => function($post, $fields) {
        $discount = $fields["discount"];
        $price = $fields["price"];

        $total = ($price * $discount) / 100;
        $saving = $price - $total;

        return "Discounted price is " . $total . " - You save " . $saving;
      }
    )
    ...

**$post** - The Post data. You can call the title, content, etc.

**$fields** - All the custom fields in Array format.

If you like cleaner code, you can separate the function like this:

    ...
    "columns" => array(
      "thumbnail",
      "title",
      "price",
      "discounted_price" => "show_discounted_price"
    )
    ...

    function show_discounted_price($post, $fields) {
      $discount = $fields["discount"];
      $price = $fields["price"];

      $total = ($price * $discount) / 100;
      $saving = $price - $total;

      return "Discounted price is " . $total . " - You save " . $saving;
    }
