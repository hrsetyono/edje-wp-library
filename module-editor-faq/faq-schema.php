<?php namespace h;

/**
 * Add FAQ structured data taken from FAQ block
 */
class FAQ_Schema {
  function __construct() {
    add_action( 'wp_footer', [$this, 'add_faq_data'], 100 );
  }

  /**
   * Scrap the content for H-FAQ block and format its data as JSON LD
   */
  function add_faq_data() {
    if( is_home() ) { return; } // abort if blog page

    global $post;
    $content = isset( $post ) ? $post->post_content : null;

    // this regex only works for latest Gutenberg version where they wrap Pullquote with <figure>
    preg_match_all( '/wp-block-h-faq(?!.*--noindex).*>(.+)<\/details/Ui', $content, $faqs );

    // if FAQ found
    if( empty( $faqs[1] ) ) { return; }

    $data = [
      '@context' => 'https://schema.org',
      '@type' => 'FAQPage',
      'mainEntity' => [],
    ];

    foreach( $faqs[1] as $f ) {
      // parse the Question and Answer
      preg_match( '/<summary.+>(.+)<\/summary>/Ui', $f, $question );
      preg_match( '/h-faq-answer.+>(.+)<\/div>$/Ui', $f, $answer );

      // abort if question or answer is empty
      if( !isset( $question[1] ) || !isset( $answer[1] ) ) { continue; }

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
}

new FAQ_Schema();