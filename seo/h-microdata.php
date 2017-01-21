<?php
/*
* Add microdata to Posts and Products automatically
*
* Validator: https://search.google.com/structured-data/testing-tool/u/0/
*/

new H_SEO_Microdata();
class H_SEO_Microdata {
  function __construct() {
    add_action('wp_head', array($this, 'add_microdata'), 100);
  }

  /*
    Add relevant microdata based on post type

    @filter the_content
    @param str $content - The WP Content
    @return str
  */
  function add_microdata($content) {
    global $post;

    // Each post type has the function to customize microdata
    $targets = apply_filters('h_seo_microdata', array(
      'post' => array($this, 'get_post_microdata'),
      'product' => array($this, 'get_product_microdata')
    ) );

    // if not targeted, abort
    $is_targetted = isset($post) && array_key_exists($post->post_type, $targets);
    if(empty($post) || !$is_targetted) {
      return $content;
    }

    // create base JSON
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
    $logo = wp_get_attachment_image_src(get_theme_mod('custom_logo') , 'full');
    $user = get_userdata($post->post_author, 'display_name');

    // var_dump($user->get('twitter'));

    $schema = array(
      '@context' => 'http://schema.org',
      'name' => $post->post_title,
      'url' => get_permalink($post),
      'description' => $post->post_excerpt ? $post->post_excerpt : wp_trim_words($post->post_content, 25),
      'image' => array(
        '@type' => 'ImageObject',
        'url' => $image[0],
        'width' => $image[1],
        'height' => $image[2]
      ),
      'author' => array(
        '@type' => 'Person',
        'name' => $user->data->display_name,
        'url' => $user->data->user_url,
        'description' => $user->get('description'),
        'image' => array(
          '@type' => 'ImageObject',
          'url' => get_avatar_url($user->data->user_email)
        ),
        'sameAs' => array(
          $user->data->user_url,
          $user->get('twitter') ? 'https://twitter.com/' . $user->get('twitter') : '',
          $user->get('facebook'),
          $user->get('googleplus')
        ),
      ),
      'publisher' => array(
        '@type' => 'Organization',
        'name' => get_bloginfo(),
        'logo' => $logo[0]
      ),
    );

    // Select the specified function for that post type
    $target_function = $targets[$post->post_type];
    $schema = $target_function($schema, $post);

    echo $content . '<script type="application/ld+json">' . json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
  }

  /////

  /*
    Get microdata for Post
  */
  private function get_post_microdata($schema, $post) {
    $addon = array(
      '@type' => 'Article',
      'headline' => $post->post_title,
      'datePublished' => $post->post_date,
      'dateModified' => $post->post_modified,

      'mainEntityOfPage' => array(
        '@type' => 'WebPage',
        '@id' => get_permalink($post)
      )
    );

    return array_merge($schema, $addon);
  }

  /*
    Get microdata for Product
  */
  private function get_product_microdata($schema, $post) {
    $addon = array(
      '@type' => 'Product'
    );

    // get WC data
    $currency = get_woocommerce_currency();
    $price = $post->custom['_price'];

    // if variation, add price range
    if(is_array($price) ) {
      $addon['offers'] = array(
        '@type' => 'Offer',
        'priceSpecification' => array(
          '@type' => 'PriceSpecification',
          'maxPrice' => $price[1],
          'minPrice' => $price[0],
          'price' => $price[0],
          'priceCurrency' => $currency
        )
      );
    }
    // if single product, add single price
    else {
      $addon['offers'] = array(
        '@type' => 'Offer',
        'price' => $price,
        'priceCurrency' => $currency
      );
    }

    return array_merge($schema, $addon);
  }
}
/*

*/
