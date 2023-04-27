GENERAL

- [Head] Removed the customizer to append Head and Footer code. Replaced by ACF Options.
- [CSS] Removed the `core-block-supports` CSS from being enqueued.

GUTENBERG

- Added styling that fits the Pixel Theme.
- Disabled the inspector tab on some core blocks.
- [Text] Removed "No Spacing" style from Paragraph and Heading. Replaced by the native Margin control.
- [Media] Removed "Thumbnail Wide" and "Thumbnail Tall" style from Image. Replaced by using the native Alignwide and Alignfull.
- [Media] Added better styling for Slider and Thumbnails Gallery.
- [Design] Removed the filter that added back the Group's inner-container.
- [Design] Added a filter to add Group's justify and orientation classes.

CUSTOM POST TYPE

- Deprecated the code to register post type and taxonomy. Replaced by ACF.

WIDGET

- Removed the `theme_suppport` requirement. Now always enabled to prevent widgets being stripped from all areas if plugin is disabled.