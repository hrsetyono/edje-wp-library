<?php namespace h;

/**
 * Add FAQ structured data taken from Pullquote block
 */
class PullFAQ_Schema {
  function __construct() {
    add_action( 'wp_footer', [$this, 'add_faq_data'], 100 );
    $this->faq_style();
  }

  /**
   * Scrap the content for Pullquote and format its data as JSON LD
   */
  function add_faq_data() {
    global $post;
    $content = isset( $post ) ? $post->post_content : null;

    // this regex only works for latest Gutenberg version where they wrap Pullquote with <figure>
    preg_match_all( '/wp-block-pullquote.+<blockquote[^<]*>(<p>.+)<\/blockquote/', $content, $faqs );

    // if FAQ found
    if( empty( $faqs[1] ) ) { return; }

    $data = [
      '@context' => 'https://schema.org',
      '@type' => 'FAQPage',
      'mainEntity' => [],
    ];

    foreach( $faqs[1] as $f ) {
      if( $f == '<p></p>' ) { continue; } // if empty

      // parse the Question and Answer
      preg_match( '/<cite>(.+)<\/cite>/', $f, $question );
      preg_match( '/(.+)<cite>/', $f, $answer );

      // Add to question lists
      $data['mainEntity'][] = [
        '@type' => 'Question',
        'name' => $question[1],
        'acceptedAnswer' => [
          '@type' => 'Answer',
          'text' => $answer[1]
        ]
      ];
    }
      
    $json_ld = json_encode( $data );
    echo "<!-- Edje FAQ --><script type='application/ld+json'>$json_ld</script>";
  }

  /**
   * Add FAQ style
   */
  function faq_style() {
    if( !function_exists('register_block_style') ) { return; }

    register_block_style( 'core/pullquote', array(
      'name'  => 'hidden-from-google',
      'label' => 'Hidden from Google',
    ));
  }
}

new PullFAQ_Schema();