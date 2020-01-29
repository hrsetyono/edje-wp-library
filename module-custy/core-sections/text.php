<?php
$textUnits = [
  'px' => [ 'min' => 12, 'max' => 32, ],
  'rem' => [ 'min' => 0, 'max' => 2 ],
  'em' => [ 'min' => 0, 'max' => 2 ],
];

$headingUnits = [
  'px' => [ 'min' => 14, 'max' => 64, ],
  'rem' => [ 'min' => 0, 'max' => 4 ],
  'em' => [ 'min' => 0, 'max' => 4 ],
];

$section = [
  'title' => __( 'Text' ), 
  'container' => [ 'priority' => 1 ],
  'css_selector' => ':root',
  'options' => [

    'rootTypography' => [
      'label' => __( 'Root Typography' ),
      'type' => 'ct-typography',
      'isDefault' => true,
      'css' => '--$',
    ],

    blocksy_rand_md5() => [ 'type' => 'ct-divider' ],

    'smallFontSize' => [
      'label' => __( 'Small Font Size' ),
      'type' => 'ct-slider',
      'units' => $textUnits,
      'css' => '--smallFontSize',
    ],
    'mediumFontSize' => [
      'label' => __( 'Medium Font Size' ),
      'type' => 'ct-slider',
      'responsive' => true,
      'units' => $textUnits,
      'css' => '--mediumFontSize',
    ],
    'largeFontSize' => [
      'label' => __( 'Large Font Size' ),
      'type' => 'ct-slider',
      'responsive' => true,
      'units' => $textUnits,
      'css' => '--largeFontSize',
    ],
    'hugeFontSize' => [
      'label' => __( 'Huge Font Size' ),
      'type' => 'ct-slider',
      'responsive' => true,
      'units' => $textUnits,
      'css' => '--hugeFontSize',
    ],

    blocksy_rand_md5() => [ 'label' => __( 'Heading' ), 'type' => 'ct-title' ],

    'headingTypography' => [
      'type' => 'ct-typography',
      'label' => __( 'Heading Typography' ),
      'desc' => "Applies to H1-H6. Leave size as 0.",
      'isDefault' => true,
      'css' => '--h$'
    ],

    blocksy_rand_md5() => [ 'type' => 'ct-divider' ],

    'h1Size' => [
      'label' => __( 'H1 Size' ),
      'type' => 'ct-slider',
      'responsive' => true,
      'units' => $headingUnits,
      'css' => '--h1Size',
    ],

    'h2Size' => [
      'label' => __( 'H2 Size' ),
      'type' => 'ct-slider',
      'responsive' => true,
      'units' => $headingUnits,
      'css' => '--h2Size',
    ],

    'h3Size' => [
      'label' => __( 'H3 Size' ),
      'type' => 'ct-slider',
      'responsive' => true,
      'units' => $headingUnits,
      'css' => '--h3Size'
    ],

    'h4Size' => [
      'label' => __( 'H4 Size' ),
      'type' => 'ct-slider',
      'responsive' => true,
      'units' => $headingUnits,
      'css' => '--h4Size'
    ],

    'h5Size' => [
      'label' => __( 'H5 Size' ),
      'type' => 'ct-slider',
      'responsive' => true,
      'units' => $headingUnits,
      'css' => '--h5Size',
    ],

    'h6Size' => [
      'label' => __( 'H6 Size' ),
      'type' => 'ct-slider',
      'responsive' => true,
      'units' => $headingUnits,
      'css' => '--h6Size'
    ],
  ],
];