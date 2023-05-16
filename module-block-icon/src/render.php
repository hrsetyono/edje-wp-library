<?php
  $atts = $attributes;
  $has_description = $atts['description'] === '<p></p>' || $atts['description'] === '';
  $has_link = isset($atts['url']) && $atts['isFullyClickable'];

  $base_classes = 'px-block-icon ';
  $base_classes .= "has-icon-position-{$atts['iconPosition']} ";
  $base_classes .= $has_description ? 'has-description ' : 'has-no-description ';
  $base_classes .= $atts['useImage'] ? 'use-image ' : '';

  $wrapper_args = [
    'class' => $base_classes,
  ];

  if ($has_link) {
    $wrapper_args['href'] = $atts['url'];
    $wrapper_args['target'] = $atts['linkTarget'];
  }

  $html_atts = get_block_wrapper_attributes($wrapper_args);
?>

<?php if ($has_link): ?>
  <a <?= $html_atts ?>>
<?php else: ?>
  <div <?= $html_atts ?>>
<?php endif; ?>

  <figure class='px-block-icon__figure'>
    <?php if ($atts['useImage']): ?>
      <img src='<?= $atts['imageURL'] ?>'>
    <?php else: ?>
      <?= $atts['iconMarkup'] ?>
    <?php endif; ?>
  </figure>

  <dl class='px-block-icon__content'>
    <dt>
      <?= $atts['heading'] ?>
    </dt>
    <?php if ($has_description): ?>
      <dd>
        <?= $atts['description'] ?>
      </dd>
    <?php endif; ?>
  </dl>

<?php if ($has_link): ?>
  </a>
<?php else: ?>
  </div>
<?php endif; ?>