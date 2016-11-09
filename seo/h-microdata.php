<?php
/*
* Add microdata to Posts and Products automatically
*
* Validator: https://search.google.com/structured-data/testing-tool/u/0/
*/

new H_SEO_Microdata();
class H_SEO_Microdata {
  function __construct() {
    add_filter('the_content', array($this, 'add_microdata') );
  }

  /*
    Add relevant microdata based on post type

    @filter the_content
    @param str $content - The WP Content
    @return str
  */
  function add_microdata($content) {
    global $post;

    $targets = apply_filters('h_seo_microdata', array(
      'post' => array($this, 'get_post_microdata'),
      'product' => array($this, 'get_post_microdata')
    ) );

    // if not targeted, abort
    $is_targetted = isset($post) && array_key_exists($post->post_type, $targets);
    if(empty($post) || !$is_targetted) {
      return $content;
    }

    // create base JSON
    // TODO: decide whether large or medium image
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
    $schema = array(
      '@context' => 'http://schema.org',
      'name' => $post->post_title,
      'url' => get_permalink($post),
      'image' => array(
        '@type' => 'ImageObject',
        'url' => $image[0],
        'width' => $image[1],
        'height' => $image[2]
      ),
    );

    // run the function
    $target_fn = $targets[$post->post_type];
    $schema = $target_fn($schema, $post);

    return $content . '<script type="application/ld+json">' . json_encode($schema) . '</script>';
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
      'articleBody' => wp_trim_words($post->post_content, 16),
      'author' => get_the_author_meta('display_name', $post->post_author),
      'publisher' => array(
        '@type' => 'Organization',
        'name' => get_bloginfo()
        // TODO: need logo
      ),
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
    $schema['@type'] = 'Product';
    $schema['description'] = $post->post_excerpt;

    $currency = get_woocommerce_currency();
    $price = $post->custom['_price'];

    // if variation
    if(is_array($price) ) {
      $schema['offers'] = array(
        '@type' => 'Offer',
        'priceSpecification' => array(
          '@type' => 'PriceSpecification',
          'maxPrice' => $price[1],
          'minPrice' => $price[0],
          'price' => $price[0],
          'priceCurrency' => $currency
        )
      );
    } else {
      $schema['offers'] = array(
        '@type' => 'Offer',
        'price' => $price,
        'priceCurrency' => $currency
      );
    }

    return $schema;
  }
}
/*

*/
