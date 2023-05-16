<?php
  $atts = $attributes;

  $base_classes = 'px-block-faq ';
  $base_classes .= $atts['noIndex'] ? ' --noindex ' : '';
  $wrapper_args = [
    'class' => $base_classes,
  ];

  if ($atts['initiallyOpen']) {
    $wrapper_args['open'] = 'open';
  }

  $html_atts = get_block_wrapper_attributes($wrapper_args);
?>

<details <?= $html_atts ?>>
  <summary class='px-block-faq__question'>
    <?= $atts['question'] ?>
  </summary>
  <div class='px-block-faq__answer'>
    <?= $atts['answer'] ?>
  </div>
</details>