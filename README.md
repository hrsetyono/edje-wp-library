# Edje WordPress Library

![Edje Wordpress](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/logo.jpg)

WordPress is a fantastic web platform, but it's complicated for developer. This plugin helps simplifying many functions.

**REQUIREMENT**

- PHP 7.0+
- WordPress 5.0+

**TABLE OF CONTENTS**

1. [Custom Post Type](#1-custom-post-type)
1. [Custom Taxonomy](#2-custom-taxonomy)
1. [Theme Customizer](#3-theme-customizer)
1. [Post Table Columns](#4-post-table-columns)
1. [Other Features](#5-other-features)
1. [Changelog](https://github.com/hrsetyono/edje-wp-library/wiki/Changelog)

## 1. Custom Post Type

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Custom-Post-Type)

![Edje WordPress - Product Custom Post Type](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/register-cpt.jpg)

```php
H::register_post_type( 'product', [
  'icon' => 'dashicons-cart',
  'supports' => [ 'comments' ]
] );
```

## 2. Custom Taxonomy

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Custom-Taxonomy)

![Edje WordPress - Product Custom Post Type](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/register-tax.jpg)

```php
H::register_taxonomy( 'brand' , [
  'post_type' => 'product',
] );
```


## 3. Theme Customizer

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Theme-Customizer)

You can access this from **Appearance > Customizer**. By default, only Administrator role can see this page.

![Edje Customize Example](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/cust-sample-header.jpg)

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

## 4. ACF Blocks

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/ACF-Blocks)

![Edje Wordpress - ACF Blocks](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/acf-block-sample.jpg)

```php
// functions.php

add_action( 'acf/init', 'my_create_blocks' );

function my_create_blocks() {
  H::register_block( 'sample' );
}
```

## 5. Other Features

All these features are enabled by default:

**JavaScript**

- Removed emoji converter.
- Removed ability to embed WordPress post.
- Removed Jetpack's Device-px script because it's useless.
- Removed Jetpack's Sharing script. It's only for sharing via email which is rarely used.

**SEO**

- Disabled automatic URL guessing if a visitor enters 404 page.
- Disabled Jetpack's Open Graph module when Yoast or The SEO Framework is installed.

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
