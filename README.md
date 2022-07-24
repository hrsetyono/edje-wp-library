# Edje WordPress Library

![Edje Wordpress](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/logo.jpg)

This plugin contains features that we keep using in our client's website. They are:

1. [Custom Post Type](#custom-post-type)
1. [Custom Table Columns](custom-table-columns)
1. [FAQ Block](#faq-block)
1. [Icon Block](#icon-block)
1. [Comment Editor](#comment-editor)
1. [Header and Footer Code](#header-and-footer-code)
1. [Other Features](#other-features)

**Requirement**: PHP 7.3 and WordPress 5.5.

-----

## Custom Post Type

Read full documentation: [Post Type »](https://github.com/hrsetyono/edje-wp-library/wiki/Custom-Post-Type) and [Taxonomy »](https://github.com/hrsetyono/edje-wp-library/wiki/Custom-Taxonomy)

Create custom post type:

```php
H::register_post_type('product' , [
  'menu_icon' => 'dashicons-cart',
  'slug' => 'p',
  'supports' => ['comments', 'revisions']
]);
```

![Edje WordPress - Product Custom Post Type](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/register-cpt.jpg)

Create custom taxonomy:

```php
H::register_taxonomy('brand', 'product');
```

![Edje WordPress - Custom Taxonomy](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/register-tax.jpg)

## Custom Table Columns

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Custom-Table-Columns)

![Edje WordPress - Complex Column](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/column.jpg)

```php
H::override_columns('product', [
  'title' => [], // 'title', 'date', 'thumbnail', 'author' are reserved keywords
  'price' => [], // custom field automatically populated
  'discount' => [
    'name' => 'Discount',
    'content' => 'my_show_discounted_price'
  ]
  'date' => [],
]);

function my_show_discounted_price($post, $fields) { 
  $discount = isset($fields['discount']) ? $fields['discount'][0] : null;
  $price = isset($fields['price']) ? $fields['price'][0] : null;

  $total = $price - ($price * $discount / 100);
  $saving = $price - $total;

  return "{$discount}% Discount - You save {$saving}";
}
```

## FAQ Block

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Gutenberg-–-FAQ-Block)

![Edje WordPress - FAQ Block](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/gutenberg-faq-block-v2.jpg)

Create a question where you can click to show the answer. It requires this theme support:

```php
add_theme_support( 'h-faq-block-v2' );
```

Features:

- Automatically generate JSON LD Schema to include the FAQ within Google search result.
- Modern markup with `<details>` and `<summary>`.
- No frontend CSS. Refer to the [documentation](https://github.com/hrsetyono/edje-wp-library/wiki/Gutenberg-–-FAQ-Block) for basic one.

## Icon Block

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Gutenberg-–-Icon-Block)

![Edje WordPress - Icon Block](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/gutenberg-icon-block.jpg)

Create a box with SVG icon and description.

It requires this theme support:

```php
add_theme_support( 'h-icon-block' );
```

Features:

- Integration with FontAwesome FREE. Simply type in the name of the icon and it will get the SVG code.
- Change position of icon to left, above, or right.
- Option to use Image file instead of SVG.
- No frontend CSS. Refer to the [documentation](https://github.com/hrsetyono/edje-wp-library/wiki/Gutenberg-–-Icon-Block) for basic one.

## Comment Editor

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Comment-%E2%80%93-Editor-&-Reply-Notification)

![Edje WordPress - Comment Markdown](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/comment-md-editor.jpg)

Enable a Markdown editor in the comment form.

It requires this theme support:

```php
add_theme_support( 'h-comment-editor' );
```

Features:

- Saved in database as Markdown and compiled before rendered.
- General keyboard shortcut like bold (CTRL+B), italic (CTRL+I), undo (CTRL+Z)
- Added a checkbox for "Receive follow-up email when someone reply" below comment form.

## Header and Footer Code

![Edje WordPress - Customizer Head Footer](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/customizer-head-footer.jpg)

We added a new section in the Customizer to insert raw HTML code inside `wp_head()` and `wp_footer()`.

This is useful for Analytics code from Google or Facebook.

## Other Features

All these features are enabled by default:

**JavaScript**

- Removed emoji converter.
- Removed Jetpack's Device-px script because it's useless.
- Removed Jetpack's Sharing script. It's only for sharing via email which is rarely used.

**SEO**

- Disabled automatic URL guessing if a visitor enters 404 page.
- Disabled Jetpack's Open Graph module when Yoast or The SEO Framework is installed.

**GUTENBERG**

- Added back Group's inner container that's removed in WP 5.9.
- Removed layout and dimensions setting in Group that's introduced in WP 5.9.
- Removed "Circle Mask" style from Image.
- Added "Transparent" style to Button.
- Added "Full Color" style to Table.
- Added "Larger Image" and "Smaller Image" style to Media-Text.
- Created a filter `h_disallowed_blocks` that returns an array of disabled blocks. By default it disables only three: `core/pullquote`, `core/nextpage` and `core/more`.
- Added better styling for ACF Block (as see in the ACF Block's screenshot above).
- Changed the Category checklist to always be in same the position.
- Removed Medium-Large size when uploading new image.

**OTHER**

- Removed "Created by Wordpress" message in the bottom-left of WP Admin
- Changed the login error message to "Sorry, your username or password is wrong" instead of giving hint of which one is wrong.
- Changed the Wordpress logo in login page to the one you have set in Customizer > Site Identity.
- Added `H::markdown($text)` function to parse markdown text.