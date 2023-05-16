<?php
_px_register_faq_block();
add_action('wp_footer', '_px_add_faq_schema', 100);


/**
 * Register a custom FAQ block
 */
function _px_register_faq_block() {
  wp_register_script('px-faq', H_DIST . '/px-faq.js', [ 'wp-blocks', 'wp-dom' ] , H_VERSION, true);
  wp_register_style('px-faq', H_DIST . '/px-faq.css', [ 'wp-edit-blocks' ], H_VERSION);

  register_block_type(__DIR__ . '/src');
}


/**
 * Scrap the content for PX-FAQ block and format its data as JSON LD
 * 
 * @action wp_footer
 * @since 6.2.0
 */
function _px_add_faq_schema() {
  if (is_home()) { return; } // abort if blog page

  global $post;
  $content = isset($post) ? $post->post_content : null;

  // Find the FAQ with noIndex attribute
  preg_match_all('/wp:px\/faq.+noIndex":true/Ui', $content, $noindex_faqs);

  // if noindex FAQ not found
  if (empty($noindex_faqs[0])) { return; }

  $data = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [],
  ];

  foreach ($noindex_faqs[0] as $f) {
    // parse the Question and Answer
    preg_match('/question":"(.+)"/Ui', $f, $question);
    preg_match('/answer":"(.+)"/Ui', $f, $answer);

    // abort if question or answer is empty
    if (!isset( $question[1]) || !isset($answer[1])) { continue; }

    $question = json_decode('"' . $question[1] . '"');
    $answer = json_decode('"' . $answer[1] . '"');

    // Add to question lists
    $data['mainEntity'][] = [
      '@type' => 'Question',
      'name' => $question,
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => $answer,
      ]
    ];
  }
    
  $json_ld = json_encode($data);
  echo "<!-- Pixel FAQ --><script type='application/ld+json'>$json_ld</script>";
}