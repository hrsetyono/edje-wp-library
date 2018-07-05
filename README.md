# Edje WordPress

![Edje Wordpress](http://cdn.setyono.net/edge/wp-edge.jpg)

Simplify WordPress complicated functions.

## Requirement

- PHP 5.6+
- WordPress 4.9+

## Sample Features

Create new Custom Post Type

```php
H::register_post_type( 'product' );
```

Add new Admin Sidebar menu:

```php
H::add_menu( 'Home'  array(
  'slug' => 'post.php?post=10&action=edit',
  'icon' => 'dashicons-admin-home',
  'position' => 'above Pages'
));
```

Sending push notification after publishing new post:

```php
add_action( 'publish_post', 'after_publish_notify_users', 10, 2 );

function after_publish_notify_users( $id, $post ) {
  $payload = array(
    'title' => $post->post_title,
    'body' => $post->post_excerpt,
  );
  H::send_push( $payload );
}
```

## Visit our [WIKI](https://github.com/hrsetyono/edje-wp/wiki) for full documentation.
