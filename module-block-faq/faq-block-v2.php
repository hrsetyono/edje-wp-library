<?php
_h_register_faq_block_v2();
add_action('wp_footer', '_h_add_faq_schema_v2', 100);


/**
 * Register a custom FAQ block v2
 */
function _h_register_faq_block_v2() {
  wp_register_script('h-faq', H_DIST . '/h-faq.js', [ 'wp-blocks', 'wp-dom' ] , H_VERSION, true);
  wp_register_style('h-faq', H_DIST . '/h-faq.css', [ 'wp-edit-blocks' ], H_VERSION);

  register_block_type(__DIR__ . '/v2');
}

/**
 * Scrap the content for H-FAQ block and format its data as JSON LD
 * 
 * @action wp_footer
 */
function _h_add_faq_schema_v2() {
  if (is_home()) { return; } // abort if blog page

  global $post;
  $content = isset($post) ? $post->post_content : null;

  // Find the FAQ with noIndex attribute
  preg_match_all('/wp:h\/faq.+noIndex":true/Ui', $content, $noindex_faqs);

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
  echo "<!-- Edje FAQ --><script type='application/ld+json'>$json_ld</script>";
}