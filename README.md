# Pixel WordPress Library

This repo has been moved to https://github.com/pixelstudio-id/pixel-wp-library in order to fix the versioning.

This plugin contains features that we keep using in our client's website. They are:

1. [Custom Table Columns](#custom-table-columns)
1. [Mega Menu](#mega-menu)
1. [Header and Footer Builder](#header-and-footer-builder)
1. [Header and Footer Code](#header-and-footer-code)
1. [FAQ Block](#faq-block)
1. [Icon Block](#icon-block)
1. [Comment Editor](#comment-editor)
1. [Other Features](#other-features)

**Requirement**: PHP 7.4 and WordPress 6.2.

## Custom Table Columns

Customize the columns of any post type in your WP Admin.

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Custom-Table-Columns)

![Edje WordPress - Complex Column](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/column.jpg)

## Mega Menu

Create a large menu split into 2, 3, or 4 columns. Built using native WP Menu and not even a custom Walker.

⚠️ Requires: ACF Pro and Theme Support `h-mega-menu`

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Mega-Menu)

![Edje WordPress - Mega Menu](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/mega-menu.jpg)

## Header and Footer Builder

Use classic widgets to create Header and Footer. Much easier and simpler than using the new Full Site Editor.

⚠️ Requires: ACF Pro and Theme Support `h-widget-builder-v2`

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Header-and-Footer-Builder)

![Edje WordPress - Widget Builder](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/widget-builder.jpg)

## Header and Footer Code

Insert Google Analytics code or Facebook Pixel here.

![Edje WordPress - Customizer Head Footer](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/customizer-head-footer.jpg)

## FAQ Block

Create a question where you can click to show the answer. Automatically generates JSON-LD Schema.

⚠️ Requires: Theme Support `h-faq-block-v2`

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Gutenberg-–-FAQ-Block)

![Edje WordPress - FAQ Block](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/gutenberg-faq-block-v2.jpg)

## Icon Block

Create a block with SVG icon and description.

⚠️ Requires: Theme Support `h-icon-block`

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Gutenberg-–-Icon-Block)

![Edje WordPress - Icon Block](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/gutenberg-icon-block.jpg)

## Comment Editor

Enable a Markdown editor in the comment form and email notification whenever someone wrote a comment reply.

⚠️ Requires: Theme Support `h-comment-editor`

[Read full documentation »](https://github.com/hrsetyono/edje-wp-library/wiki/Comment-%E2%80%93-Editor-&-Reply-Notification)

![Edje WordPress - Comment Markdown](https://raw.github.com/hrsetyono/cdn/master/edje-wp-library/comment-md-editor.jpg)


## Other Features

All these features are enabled by default:

**JavaScript**

- Removed emoji converter.
- Removed Jetpack's Device-px script because it's useless.
- Removed Jetpack's Sharing script. It's only for sharing via email which is rarely used.

**SEO**

- Disabled automatic URL guessing if a visitor enters 404 page.
- Disabled Jetpack's Open Graph module when Yoast or The SEO Framework is installed.

**GUTENBERG**

- Added back Group's inner container that's removed in WP 5.9.
- Removed layout and dimensions setting in Group that's introduced in WP 5.9.
- Removed "Circle Mask" style from Image.
- Added "Transparent" style to Button.
- Added "Full Color" style to Table.
- Added "Larger Image" and "Smaller Image" style to Media-Text.
- Created a filter `h_disallowed_blocks` that returns an array of disabled blocks. By default it disables only three: `core/pullquote`, `core/nextpage` and `core/more`.
- Added better styling for ACF Block (as see in the ACF Block's screenshot above).
- Changed the Category checklist to always be in same the position.
- Removed Medium-Large size when uploading new image.

**OTHER**

- Removed "Created by Wordpress" message in the bottom-left of WP Admin
- Changed the login error message to "Sorry, your username or password is wrong" instead of giving hint of which one is wrong.
- Changed the Wordpress logo in login page to the one you have set in Customizer > Site Identity.
- Added `H::markdown($text)` function to parse markdown text.
=======
We are planning to follow WordPress version. So if our plugin version is 5.9.x that means it's for WP 5.9
