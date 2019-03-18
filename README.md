# Edje WordPress Library

![Edje Wordpress](https://cdn.setyono.net/edge/wp-edge.jpg)

Simplify WordPress complicated functions.

**REQUIREMENT**

- PHP 7.0+
- WordPress 5.0+

**TABLE OF CONTENTS**

1. [Custom Post Type](#custom-post-type)
1. [Custom Taxonomy](#custom-taxonomy)
1. [Theme Customizer](#theme-customizer)
1. [Post Table Columns](#post-table-columns)
1. [Other Features](#other-features)

## Custom Post Type

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Custom-Post-Type)

![Edje WordPress - Product Custom Post Type](https://cdn.setyono.net/edjewp/cpt-product.jpg)

```php
H::register_post_type( 'product', [
  'icon' => 'dashicons-cart',
  'supports' => [ 'comments' ]
] );
```

## Custom Taxonomy

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Custom-Taxonomy)

![Edje WordPress - Product Custom Post Type](https://cdn.setyono.net/edjewp/cpt-product.jpg)

```php
H::register_taxonomy( 'brand' , [
  'post_type' => 'product',
] );
```


## Theme Customizer

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Customizer)

You can access this from **Appearance > Customizer**. By default, only Administrator role can see this page.

![Edje Customize Example](https://cdn.setyono.net/edjewp/cust-sample-header.jpg)

```php
add_action( 'customize_register', 'my_customize_register' );

function my_customize_register( $wp_customize ) {
  $c = H::customizer( $wp_customize ); // init the class

  $c->add_section( 'header' );

  $c->add_theme_mod( 'head_code', 'code_editor htmlmixed' );
  $c->add_theme_mod( 'background_color', 'color' );
  $c->add_theme_mod( 'phone_no', 'text' );
}
```

## Post Table Columns

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Table-Columns)

![Edje WordPress - Complex Column](https://cdn.setyono.net/edjewp/cpt-column.jpg)

```php
H::override_columns( 'product', [
  'title',
  'price',
  'Discount' => 'show_discounted_price',
] );

function show_discounted_price( $post, $fields ) { 
  $discount = isset( $fields['discount'] ) ? $fields['discount'][0] : null;
  $price = isset( $fields['price'] ) ? $fields['price'][0] : null;

  $total = $price - ($price * $discount / 100);
  $saving = $price - $total;

  return $discount . '% Discount - You save ' . $saving;
}
```

## Other Features

All these features are enabled by default:

**JavaScript**

- Removed emoji converter.
- Removed ability to embed WordPress post.
- Removed Jetpack's Device-px script because it's useless.
- Removed Jetpack's Sharing script. It's only for sharing via email which is rarely used.
- [COMING SOON] Removed jQuery and jQuery migrate. If you need jQuery, enqueue it in your Theme.

**SEO**

- Disabled automatic URL guessing if a visitor enters 404 page.
- Disabled Jetpack's Open Graph module when Yoast or The SEO Framework is installed

**CUSTOMIZER**

- Added Head and Footer code field.
- Added Theme Color field in Site Identity for changing the actionbar color in Chrome mobile.

**EDIT POST**

- Removed Medium-Large size when uploading new image.
- Changed the Category checklist to always be in same the position.
- Added a better styling to WYSIWYG classic editor.
- Added styling to Gutenberg editor for ACF block.

**OTHER**

- Removed "Created by Wordpress" message in the bottom-left of WP Admin
- Changed the login error message to "Sorry, your username or password is wrong" instead of giving hint of which one is wrong.
- Changed the Wordpress logo in login page to the one you have set in Customizer > Site Identity.
- Added the ability to edit TWIG file in Appearance > Editor. But it's still recommended to disable Editor by adding this line in WP Config: `define('DISALLOW_FILE_EDIT', true);`