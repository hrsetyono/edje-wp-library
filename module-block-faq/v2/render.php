<?php
  $atts = $attributes;

  $extra_classes = $atts['className'] ?? '';
  $extra_classes .= $atts['noIndex'] ? ' --noindex ' : ' ';

  $style = '';
  $style .= $atts['textColor'] ? "--textColor: {$atts['textColor']};" : '';
  $style .= $atts['bgColor'] ? "--bgColor: {$atts['bgColor']};" : '';

  $is_open = $atts['initiallyOpen'] ? 'open ' : '';
?>

<details class='wp-block-h-faq <?= $extra_classes ?>' style="<?= $style ?>" <?= $is_open ?>>
  <summary class='wp-block-h-faq__question'>
    <?= $atts['question'] ?>
  </summary>
  <div class='wp-block-h-faq__answer'>
    <?= $atts['answer'] ?>
  </div>
</details>