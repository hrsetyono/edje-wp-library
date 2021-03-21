<?php
/**
 * Create a custom FAQ block and add FAQ schema data
 */

if( is_admin() ) {
  _h_register_faq_block();
  add_filter( 'safe_style_css', '_h_faq_safe_style' );
} else {
  add_action( 'wp_footer', '_h_add_faq_schema', 100 );
}


/**
 * Register a custom FAQ block
 */
function _h_register_faq_block() {
  $dir = plugin_dir_url(__FILE__);

  wp_register_script( 'h-faq', $dir . 'js/h-faq.js', [ 'wp-blocks', 'wp-dom' ] , H_VERSION, true );
  wp_register_style( 'h-faq', $dir . 'css/h-faq.css', [ 'wp-edit-blocks' ], H_VERSION );

  register_block_type( 'h/faq', [
    'editor_style' => 'h-faq',
    'editor_script' => 'h-faq',
  ] );
}

/**
 * Allow this CSS Var to be saved in database
 * 
 * @filter safe_style_css
 */
function _h_faq_safe_style( $attr ) {
  $attr[] = '--textColor';
  $attr[] = '--bgColor';
  $attr[] = '--faqTitleBg';
  $attr[] = '--faqTitleColor';
  return $attr;
}


/**
 * Scrap the content for H-FAQ block and format its data as JSON LD
 * 
 * @action wp_footer
 */
function _h_add_faq_schema() {
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