<?php
/**
 * Add FAQ structured data taken from Pullquote block
 * 
 * @deprecated - Use the FAQ block instead by adding theme support "h-faq-block"
 */

if( is_admin() ) {
  add_action( 'enqueue_block_editor_assets', '_h_enqueue_pullfaq_editor', 20 );
  add_action( 'wp_enqueue_scripts', '_h_enqueu_pullfaq', 30 );
} else {
  add_action( 'wp_footer', '_h_add_pullquote_faq_schema', 100 );
}


/**
 * Enqueue the editor assets for FAQ Pullquote Block
 * 
 * @action enqueue_block_editor_assets
 */
function _h_enqueue_pullfaq_editor() {
  $assets = plugin_dir_url(__FILE__);
  wp_enqueue_style( 'h-faq-pullquote', $assets . 'css/h-pullfaq-editor.css', ['wp-edit-blocks'] );
}


/**
 * Enqueue the assets for FAQ Pullquote Block
 * 
 * @action wp_enqueue_scripts
 */
function _h_enqueue_pullfaq() {
  $assets = plugin_dir_url(__FILE__);
  wp_enqueue_style( 'h-pullfaq', $assets . 'css/h-pullfaq.css', [] );
  wp_enqueue_script( 'h-pullfaq', $assets . 'js/h-pullfaq.js', [], false, true );
}


/**
 * Scrap the content for Pullquote and format its data as JSON LD
 * 
 * @action wp_footer
 */
function _h_add_pullquote_faq_schema() {
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