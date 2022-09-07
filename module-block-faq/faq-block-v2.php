<?php
_h_register_faq_block_v2();
add_action('wp_footer', '_h_add_faq_schema_v2', 100);


/**
 * Register a custom FAQ block v2
 */
function _h_register_faq_block_v2() {
  wp_register_script('h-faq', H_DIST . '/h-faq.js', [ 'wp-blocks', 'wp-dom' ] , H_VERSION, true);
  wp_register_style('h-faq', H_DIST . '/h-faq.css', [ 'wp-edit-blocks' ], H_VERSION);

  $default_atts = apply_filters('h_block_faq_defaults', [
    'question' => [ 'type' => 'string' ],
    'answer' => [ 'type' => 'string' ],

    'textColor' => [ 'type' => 'string', 'default' => '' ],
    'bgColor' => [ 'type' => 'string', 'default' => '' ],
    'initiallyOpen' => [ 'type' => 'boolean', 'default' => false ],
    'noIndex' => [ 'type' => 'boolean', 'default' => false ]
  ]);

  wp_localize_script('h-faq', 'hLocalizeFAQ', [
    'defaultAtts' => $default_atts
  ]);

  register_block_type('h/faq', [
    'editor_style' => 'h-faq',
    'editor_script' => 'h-faq',
    'render_callback' => function($atts) use ($default_atts) {
      return _h_render_faq_block($atts, $default_atts);
    }
  ]);
}


/**
 * 
 */
function _h_render_faq_block($atts, $default_atts) {
  // prevent loading in Editor screen
  if (function_exists('get_current_screen')) { return; }

  $default_values = array_map(function($a) {
    return $a['default'] ?? '';
  }, $default_atts);

  $atts = wp_parse_args($atts, $default_values);

  // Take over the rendering process, if any
  $render = apply_filters('h_block_faq_render', '', $atts);
  if ($render) {
    return $render;
  }

  $extra_classes = $atts['className'] ?? '';
  $extra_classes .= $atts['noIndex'] ? ' --noindex ' : ' ';

  $is_open = $atts['initiallyOpen'] ? 'open ' : '';

  $style = '';
  $style .= $atts['textColor'] ? "--textColor: {$atts['textColor']};" : '';
  $style .= $atts['bgColor'] ? "--bgColor: {$atts['bgColor']};" : '';

  return "<details class='wp-block-h-faq {$extra_classes}' style='{$style}' {$is_open}>
    <summary class='wp-block-h-faq__question'>{$atts['question']}</summary>
    <div class='wp-block-h-faq__answer'>{$atts['answer']}</div>
  </details>";
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