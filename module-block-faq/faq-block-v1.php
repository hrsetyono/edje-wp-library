<?php


_h_register_faq_block_v1();
add_action( 'wp_footer', '_h_add_faq_schema_v1', 100 );



/*
 * Register a custom FAQ block
 */
function _h_register_faq_block_v1() {
 $dir = plugin_dir_url(__FILE__);

 wp_register_script( 'h-faq', $dir . 'v1/h-faq-v1.js', [ 'wp-blocks', 'wp-dom' ] , H_VERSION, true );
 wp_register_style( 'h-faq', $dir . 'v1/h-faq-v1.css', [ 'wp-edit-blocks' ], H_VERSION );

 register_block_type( 'h/faq', [
   'editor_style' => 'h-faq',
   'editor_script' => 'h-faq',
 ] );
}


/**
 * Scrap the content for H-FAQ block and format its data as JSON LD
 * 
 * @action wp_footer
 */
function _h_add_faq_schema_v1() {
  if( is_home() ) { return; } // abort if blog page

  global $post;
  $content = isset( $post ) ? $post->post_content : null;

  // Find FAQ with --noindex class
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