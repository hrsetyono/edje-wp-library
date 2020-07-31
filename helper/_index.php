<?php

add_action( 'plugins_loaded' , function() {
  require_once __DIR__ . '/shortcode.php';
  new H_Shortcode();

  if( class_exists('Timber') ) {
    require_once __DIR__ . '/timber.php';
    new H_Timber();
  }
} );

 /**
 * Get social media SVG icon and color
 * 
 * @param $slug (string / optional) - The icon name. Leave empty to get all data
 * @return array - An icon or all icons data
 * 
 *     H::get_social_icon( 'facebook );
 */
function h_get_social_icon( $slug = null ) {
  $list = apply_filters( 'h_social_icons', [
    'facebook' => [
      'label' => __( 'Facebook' ),
      'color' => '#1977f2',
      'placeholder' => 'https://www.facebook.com/your-page',
      'svg' => '<svg width="20px" height="20px" viewBox="0 0 20 20">
      <path d="M20,10.1c0-5.5-4.5-10-10-10S0,4.5,0,10.1c0,5,3.7,9.1,8.4,9.9v-7H5.9v-2.9h2.5V7.9C8.4,5.4,9.9,4,12.2,4c1.1,0,2.2,0.2,2.2,0.2v2.5h-1.3c-1.2,0-1.6,0.8-1.6,1.6v1.9h2.8L13.9,13h-2.3v7C16.3,19.2,20,15.1,20,10.1z"/>
    </svg>',
    ],

    'twitter' => [
      'label' => __( 'Twitter' ),
      'color' => '#21a1f3',
      'placeholder' => 'https://twitter.com/your-username',
      'svg' => '<svg width="20px" height="20px" viewBox="0 0 20 20">
      <path d="M20,3.8c-0.7,0.3-1.5,0.5-2.4,0.6c0.8-0.5,1.5-1.3,1.8-2.3c-0.8,0.5-1.7,0.8-2.6,1c-0.7-0.8-1.8-1.3-3-1.3c-2.3,0-4.1,1.8-4.1,4.1c0,0.3,0,0.6,0.1,0.9C6.4,6.7,3.4,5.1,1.4,2.6C1,3.2,0.8,3.9,0.8,4.7c0,1.4,0.7,2.7,1.8,3.4C2,8.1,1.4,7.9,0.8,7.6c0,0,0,0,0,0.1c0,2,1.4,3.6,3.3,4c-0.3,0.1-0.7,0.1-1.1,0.1c-0.3,0-0.5,0-0.8-0.1c0.5,1.6,2,2.8,3.8,2.8c-1.4,1.1-3.2,1.8-5.1,1.8c-0.3,0-0.7,0-1-0.1c1.8,1.2,4,1.8,6.3,1.8c7.5,0,11.7-6.3,11.7-11.7c0-0.2,0-0.4,0-0.5C18.8,5.3,19.4,4.6,20,3.8z"/>
    </svg>',
    ],

    'instagram' => [
      'label' => __( 'Instagram' ),
      'color' => '#f00075',
      'placeholder' => 'https://instagram.com/your-username',
      'svg' => '<svg width="20" height="20" viewBox="0 0 20 20">
      <circle cx="10" cy="10" r="3.3"/>
      <path d="M14.2,0H5.8C2.6,0,0,2.6,0,5.8v8.3C0,17.4,2.6,20,5.8,20h8.3c3.2,0,5.8-2.6,5.8-5.8V5.8C20,2.6,17.4,0,14.2,0zM10,15c-2.8,0-5-2.2-5-5s2.2-5,5-5s5,2.2,5,5S12.8,15,10,15z M15.8,5C15.4,5,15,4.6,15,4.2s0.4-0.8,0.8-0.8s0.8,0.4,0.8,0.8S16.3,5,15.8,5z"/>
    </svg>',
    ],

    'whatsapp' => [
      'label' => __( 'WhatsApp' ),
      'color' => '#25d366',
      'placeholder' => 'https://wa.me/6281234567890',
      'svg' => '<svg width="20px" height="20px" viewBox="0 0 20 20">
      <path d="M10,0C4.5,0,0,4.5,0,10c0,1.9,0.5,3.6,1.4,5.1L0.1,20l5-1.3C6.5,19.5,8.2,20,10,20c5.5,0,10-4.5,10-10S15.5,0,10,0zM6.6,5.3c0.2,0,0.3,0,0.5,0c0.2,0,0.4,0,0.6,0.4c0.2,0.5,0.7,1.7,0.8,1.8c0.1,0.1,0.1,0.3,0,0.4C8.3,8.2,8.3,8.3,8.1,8.5C8,8.6,7.9,8.8,7.8,8.9C7.7,9,7.5,9.1,7.7,9.4c0.1,0.2,0.6,1.1,1.4,1.7c0.9,0.8,1.7,1.1,2,1.2c0.2,0.1,0.4,0.1,0.5-0.1c0.1-0.2,0.6-0.7,0.8-1c0.2-0.2,0.3-0.2,0.6-0.1c0.2,0.1,1.4,0.7,1.7,0.8s0.4,0.2,0.5,0.3c0.1,0.1,0.1,0.6-0.1,1.2c-0.2,0.6-1.2,1.1-1.7,1.2c-0.5,0-0.9,0.2-3-0.6c-2.5-1-4.1-3.6-4.2-3.7c-0.1-0.2-1-1.3-1-2.6c0-1.2,0.6-1.8,0.9-2.1C6.1,5.4,6.4,5.3,6.6,5.3z"/>
    </svg>',
    ],

    'phone' => [
      'label' => __( 'Phone' ),
      'color' => 'var(--main)',
      'placeholder' => 'tel:+12-3456-789',
      'svg' => '<svg width="20" height="20" viewBox="0 0 512 512"><path d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"/></svg>',
    ],

    'email' => [
      'label' => __( 'Email' ),
      'color' => 'var(--main)',
      'placeholder' => 'mailto:yourname@gmail.com',
      'svg' => '<svg width="20" height="20" viewBox="0 0 512 512"><path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"/></svg>',
    ],

    'location' => [
      'label' => __( 'Location' ),
      'color' => 'var(--main)',
      'placeholder' => 'https://goo.gl/maps/abcdefghij',
      'svg' => '<svg width="20" height="20" viewBox="0 0 384 512"><path d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"/></svg>',
    ],

    'linkedin' => [
      'label' => __( 'LinkedIn' ),
      'color' => '#0577b5',
      'placeholder' => 'https://www.linkedin.com/in/your-username',
      'svg' => '<svg width="20px" height="20px" viewBox="0 0 20 20">
      <path d="M18.6,0H1.4C0.6,0,0,0.6,0,1.4v17.1C0,19.4,0.6,20,1.4,20h17.1c0.8,0,1.4-0.6,1.4-1.4V1.4C20,0.6,19.4,0,18.6,0z M6,17.1h-3V7.6h3L6,17.1L6,17.1zM4.6,6.3c-1,0-1.7-0.8-1.7-1.7s0.8-1.7,1.7-1.7c0.9,0,1.7,0.8,1.7,1.7C6.3,5.5,5.5,6.3,4.6,6.3z M17.2,17.1h-3v-4.6c0-1.1,0-2.5-1.5-2.5c-1.5,0-1.8,1.2-1.8,2.5v4.7h-3V7.6h2.8v1.3h0c0.4-0.8,1.4-1.5,2.8-1.5c3,0,3.6,2,3.6,4.5V17.1z"/>
    </svg>',
    ],

    'pinterest' => [
      'label' => __( 'Pinterest' ),
      'color' => '#e60122',
      'placeholder' => 'https://pinterest.com/your-username',
      'svg' => '<svg width="20px" height="20px" viewBox="0 0 20 20">
      <path d="M10,0C4.5,0,0,4.5,0,10c0,4.1,2.5,7.6,6,9.2c0-0.7,0-1.5,0.2-2.3c0.2-0.8,1.3-5.4,1.3-5.4s-0.3-0.6-0.3-1.6c0-1.5,0.9-2.6,1.9-2.6c0.9,0,1.3,0.7,1.3,1.5c0,0.9-0.6,2.3-0.9,3.5c-0.3,1.1,0.5,1.9,1.6,1.9c1.9,0,3.2-2.4,3.2-5.3c0-2.2-1.5-3.8-4.2-3.8c-3,0-4.9,2.3-4.9,4.8c0,0.9,0.3,1.5,0.7,2C6,12,6.1,12.1,6,12.4c0,0.2-0.2,0.6-0.2,0.8c-0.1,0.3-0.3,0.3-0.5,0.3c-1.4-0.6-2-2.1-2-3.8c0-2.8,2.4-6.2,7.1-6.2c3.8,0,6.3,2.8,6.3,5.7c0,3.9-2.2,6.9-5.4,6.9c-1.1,0-2.1-0.6-2.4-1.2c0,0-0.6,2.3-0.7,2.7c-0.2,0.8-0.6,1.5-1,2.1C8.1,19.9,9,20,10,20c5.5,0,10-4.5,10-10C20,4.5,15.5,0,10,0z"/>
    </svg>',
    ],

    'pocket' => [
      'label' => __( 'Pocket' ),
      'color' => '#ef4155',
      'placeholder' => 'https://getpocket.com/',
      'svg' => '<svg width="20px" height="20px" viewBox="0 0 448 512">
      <path d="M407.6 64h-367C18.5 64 0 82.5 0 104.6v135.2C0 364.5 99.7 464 224.2 464c124 0 223.8-99.5 223.8-224.2V104.6c0-22.4-17.7-40.6-40.4-40.6zm-162 268.5c-12.4 11.8-31.4 11.1-42.4 0C89.5 223.6 88.3 227.4 88.3 209.3c0-16.9 13.8-30.7 30.7-30.7 17 0 16.1 3.8 105.2 89.3 90.6-86.9 88.6-89.3 105.5-89.3 16.9 0 30.7 13.8 30.7 30.7 0 17.8-2.9 15.7-114.8 123.2z"/></svg>',
    ],

    'skype' => [
      'label' => __( 'Skype' ),
      'color' => '#0478d7',
      'placeholder' => 'skype:your-username?chat',
      'svg' => '<svg width="20px" height="20px" viewBox="0 0 448 512">
      <path d="M424.7 299.8c2.9-14 4.7-28.9 4.7-43.8 0-113.5-91.9-205.3-205.3-205.3-14.9 0-29.7 1.7-43.8 4.7C161.3 40.7 137.7 32 112 32 50.2 32 0 82.2 0 144c0 25.7 8.7 49.3 23.3 68.2-2.9 14-4.7 28.9-4.7 43.8 0 113.5 91.9 205.3 205.3 205.3 14.9 0 29.7-1.7 43.8-4.7 19 14.6 42.6 23.3 68.2 23.3 61.8 0 112-50.2 112-112 .1-25.6-8.6-49.2-23.2-68.1zm-194.6 91.5c-65.6 0-120.5-29.2-120.5-65 0-16 9-30.6 29.5-30.6 31.2 0 34.1 44.9 88.1 44.9 25.7 0 42.3-11.4 42.3-26.3 0-18.7-16-21.6-42-28-62.5-15.4-117.8-22-117.8-87.2 0-59.2 58.6-81.1 109.1-81.1 55.1 0 110.8 21.9 110.8 55.4 0 16.9-11.4 31.8-30.3 31.8-28.3 0-29.2-33.5-75-33.5-25.7 0-42 7-42 22.5 0 19.8 20.8 21.8 69.1 33 41.4 9.3 90.7 26.8 90.7 77.6 0 59.1-57.1 86.5-112 86.5z"/>
    </svg>',
    ],

    'reddit' => [
      'label' => __( 'reddit' ),
      'color' => '#fe4500',
      'placeholder' => 'https://www.reddit.com/user/yourname',
      'svg' => '<svg width="20px" height="20px" viewBox="0 0 512 512">
      <path d="M440.3 203.5c-15 0-28.2 6.2-37.9 15.9-35.7-24.7-83.8-40.6-137.1-42.3L293 52.3l88.2 19.8c0 21.6 17.6 39.2 39.2 39.2 22 0 39.7-18.1 39.7-39.7s-17.6-39.7-39.7-39.7c-15.4 0-28.7 9.3-35.3 22l-97.4-21.6c-4.9-1.3-9.7 2.2-11 7.1L246.3 177c-52.9 2.2-100.5 18.1-136.3 42.8-9.7-10.1-23.4-16.3-38.4-16.3-55.6 0-73.8 74.6-22.9 100.1-1.8 7.9-2.6 16.3-2.6 24.7 0 83.8 94.4 151.7 210.3 151.7 116.4 0 210.8-67.9 210.8-151.7 0-8.4-.9-17.2-3.1-25.1 49.9-25.6 31.5-99.7-23.8-99.7zM129.4 308.9c0-22 17.6-39.7 39.7-39.7 21.6 0 39.2 17.6 39.2 39.7 0 21.6-17.6 39.2-39.2 39.2-22 .1-39.7-17.6-39.7-39.2zm214.3 93.5c-36.4 36.4-139.1 36.4-175.5 0-4-3.5-4-9.7 0-13.7 3.5-3.5 9.7-3.5 13.2 0 27.8 28.5 120 29 149 0 3.5-3.5 9.7-3.5 13.2 0 4.1 4 4.1 10.2.1 13.7zm-.8-54.2c-21.6 0-39.2-17.6-39.2-39.2 0-22 17.6-39.7 39.2-39.7 22 0 39.7 17.6 39.7 39.7-.1 21.5-17.7 39.2-39.7 39.2z"/></svg>',
    ],

    'telegram' => [
      'label' => __( 'Telegram' ),
      'color' => '#08c',
      'placeholder' => 'https://t.me/your-username',
      'svg' => '<svg width="20px" height="20px" viewBox="0 0 20 20">
      <path d="M19.9,3.1l-3,14.2c-0.2,1-0.8,1.3-1.7,0.8l-4.6-3.4l-2.2,2.1c-0.2,0.2-0.5,0.5-0.9,0.5l0.3-4.7L16.4,5c0.4-0.3-0.1-0.5-0.6-0.2L5.3,11.4L0.7,10c-1-0.3-1-1,0.2-1.5l17.7-6.8C19.5,1.4,20.2,1.9,19.9,3.1z"/>
    </svg>',
    ],

    'tumblr' => [
      'label' => __( 'Tumblr' ),
      'color' => '#011835',
      'placeholder' => 'https://www.tumblr.com/blog/yourname',
      'svg' => '<svg width="20px" height="20px" viewBox="0 0 320 512">
      <path d="M309.8 480.3c-13.6 14.5-50 31.7-97.4 31.7-120.8 0-147-88.8-147-140.6v-144H17.9c-5.5 0-10-4.5-10-10v-68c0-7.2 4.5-13.6 11.3-16 62-21.8 81.5-76 84.3-117.1.8-11 6.5-16.3 16.1-16.3h70.9c5.5 0 10 4.5 10 10v115.2h83c5.5 0 10 4.4 10 9.9v81.7c0 5.5-4.5 10-10 10h-83.4V360c0 34.2 23.7 53.6 68 35.8 4.8-1.9 9-3.2 12.7-2.2 3.5.9 5.8 3.4 7.4 7.9l22 64.3c1.8 5 3.3 10.6-.4 14.5z"/></svg>',
    ],

    'wechat' => [
      'label' => __( 'WeChat' ),
      'color' => '#7bb32e',
      'placeholder' => 'weixin://dl/chat?your-username',
      'svg' => '<svg width="20" height="20" viewBox="0 0 20 20">
      <path d="M13.5,6.8c0.2,0,0.5,0,0.7,0c-0.6-2.9-3.7-5-7.1-5C3.2,1.9,0,4.5,0,7.9c0,1.9,1.1,3.5,2.8,4.8l-0.7,2.1l2.5-1.2c0.9,0.2,1.6,0.4,2.5,0.4c0.2,0,0.4,0,0.7,0c-0.1-0.5-0.2-1-0.2-1.5C7.5,9.3,10.2,6.8,13.5,6.8L13.5,6.8zM9.7,4.9c0.5,0,0.9,0.4,0.9,0.9c0,0.5-0.4,0.9-0.9,0.9c-0.5,0-1.1-0.4-1.1-0.9C8.7,5.2,9.2,4.9,9.7,4.9zM4.8,6.6c-0.5,0-1.1-0.4-1.1-0.9c0-0.5,0.5-0.9,1.1-0.9c0.5,0,0.9,0.4,0.9,0.9C5.7,6.3,5.3,6.6,4.8,6.6z M20,12.3c0-2.8-2.8-5.1-6-5.1c-3.4,0-6,2.3-6,5.1s2.6,5.1,6,5.1c0.7,0,1.4-0.2,2.1-0.4l1.9,1.1l-0.5-1.8C18.9,15.3,20,13.9,20,12.3zM12,11.4c-0.4,0-0.7-0.4-0.7-0.7c0-0.4,0.4-0.7,0.7-0.7c0.5,0,0.9,0.4,0.9,0.7C12.9,11.1,12.6,11.4,12,11.4zM15.9,11.4c-0.4,0-0.7-0.4-0.7-0.7c0-0.4,0.4-0.7,0.7-0.7c0.5,0,0.9,0.4,0.9,0.7C16.8,11.1,16.5,11.4,15.9,11.4z"/>
    </svg>',
    ],

    'youtube' => [
      'label' => __( 'YouTube' ),
      'color' => '#ff0100',
      'placeholder' => 'https://www.youtube.com/channel/your-channel',
      'svg' => '<svg width="20" height="20" viewbox="0 0 20 20">
      <path d="M15,0H5C2.2,0,0,2.2,0,5v10c0,2.8,2.2,5,5,5h10c2.8,0,5-2.2,5-5V5C20,2.2,17.8,0,15,0z M14.5,10.9l-6.8,3.8c-0.1,0.1-0.3,0.1-0.5,0.1c-0.5,0-1-0.4-1-1l0,0V6.2c0-0.5,0.4-1,1-1c0.2,0,0.3,0,0.5,0.1l6.8,3.8c0.5,0.3,0.7,0.8,0.4,1.3C14.8,10.6,14.6,10.8,14.5,10.9z"/>
    </svg>',
    ],
  ] );

  if( isset( $slug ) ) {
    return $list[ $slug ] ?? trigger_error( 'Social Item "' . $slug . '" does not exists' );
  }

  return $list;
}


/**
 * Class with generic methods for internal use
 */
class _H {
  /**
   * Transform Slug into Title format (first letter capitalized, space)
   * 
   * @param $slug
   * @return string
   */
  static function to_title( $slug ) {
    $title = ucwords( str_replace( array('_', '-'), ' ', $slug ) );
    $title = trim( $title, '^' );
    return $title;
  }

  /**
   * Transform Title into Slug format (lower case, underscore).
   */
  static function to_slug( $text, $separator = '_' ) {
    $targets = array( ' ', '[' , ']' );
    $replace_with = array( $separator, $separator, '' );

    $slug = strtolower( str_replace( $targets, $replace_with, $text ) );
    $slug = trim( $slug, '^' );
    return $slug;
  }

  /**
   * Alias for to_slug
   */
  static function to_param( $title ) {
    return self::to_slug( $title );
  }

  /**
   * Transform text to dashicons icon.
   */
  static function to_icon( $name ) {
    $full_name = 'dashicons-' . str_replace( 'dashicons-', '', $name );
    return $full_name;
  }

  /**
   * Check whether a plugin is active
   * 
   * @deprecated - Just use class_exists() instead
   * @param $slug string - The slug of a plugin, it's a pre-determinated keyword.
   * @return bool
   */
  static function is_plugin_active( $slug ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $path = array();

    switch( $slug ) {
      case 'yoast':
        array_push( $path,
          'wordpress-seo/wp-seo.php',
          'wordpress-seo-premium/wp-seo-premium.php',
          'wordpress-seo-premium-trial/wp-seo-premium.php'
        );
        break;

      case 'the-seo-framework':
      case 'tsf':
        $path[] = 'autodescription/autodescription.php';
        break;

      case 'jetpack':
        $path[] = 'jetpack/jetpack.php';
        break;

      case 'woocommerce':
        $path[] = 'woocommerce/woocommerce.php';
        break;

      case 'timber':
        $path[] = 'timber-library/timber.php';
        $path[] = 'timber-library-150/timber.php';
        $path[] = 'timber-library-160/timber.php';
        $path[] = 'timber-library-170/timber.php';
        $path[] = 'timber-library-180/timber.php';
        $path[] = 'timber-library-190/timber.php';
        break;

      case 'acf':
        $path[] = 'advanced-custom-fields/acf.php';
        $path[] = 'advanced-custom-fields-pro/acf.php';
        $path[] = 'advanced-custom-fields-beta/acf.php';
        break;
    }

    // if at least 1 is active, returns true
    foreach( $path as $p ) {
      if( is_plugin_active( $p ) ) { return true; }
    }

    return false;
  }
}