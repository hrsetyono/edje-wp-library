import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent, useInstanceId } from '@wordpress/compose';
import { Fragment } from '@wordpress/element';
import {
  InspectorControls,
  MediaUpload,
} from '@wordpress/block-editor';
import {
  Button,
  PanelBody,
  __experimentalUnitControl as UnitControl,
} from '@wordpress/components';

/**
 * Add a new setting in Inspector to upload mobile image
 */
const addControl = createHigherOrderComponent((BlockEdit) => {
  return (props) => {
    // Do nothing if it's another block than our defined ones.
    if (!['core/cover'].includes(props.name)) {
      return (
        <BlockEdit { ...props } />
      );
    }

    let atts = props.attributes;

    return (
      <Fragment>
        <BlockEdit { ...props } />
        <InspectorControls>
          <PanelBody title="Mobile Cover" initialOpen="true">
            <UnitControl
              id={`block-cover-mobile-height-input-${useInstanceId(UnitControl)}`}
              label="Mobile Height"
              value={atts.hMobileHeight}
              onChange={ (newValue) => {
                props.setAttributes({ hMobileHeight: newValue });
              } }
              isResetValueOnUnitChange
              __unstableInputWidth={ '80px' }
            />
            <p>&nbsp;</p>
            <p>Leave empty to use the primary image in mobile.</p>
            <div>
              { atts.hMobileMediaURL && <img src={atts.hMobileMediaURL} /> }

              <MediaUpload allowedTypes="image"
                value={atts.hMobileMediaID}
                onSelect={ (media) => {
                  props.setAttributes({
                    hMobileMediaID: media.id,
                    hMobileMediaURL: media.url,
                  });
                } }
                render={_renderImageButton}
              />
            </div>
          </PanelBody>
        </InspectorControls>
      </Fragment>
    );

    /**
     * Render image upload button in sidebar
     */
    function _renderImageButton(obj) {
      return (
        <>
          <Button className="button" onClick={obj.open}>
            { atts.hMobileMediaID ? 'Change image' : 'Upload image' }
          </Button>
          { atts.hMobileMediaID &&
            <Button onClick={() => {
              props.setAttributes({ hMobileMediaURL: null, hMobileMediaID: null })
            }}>
              Remove
            </Button>
          }
        </>
      );
    }
  };
}, 'withInspectorControl');

/**
 * Add extra attribute to Cover block for the mobile image
 */
addFilter('blocks.registerBlockType', 'extend-cover/attributes', (settings, name) => {
  // Do nothing if it's another block than our defined ones.
  if (!['core/cover'].includes(name)) {
    return settings;
  }

  settings.attributes = {
    ...settings.attributes,
    hMobileMediaID: { type: 'number' },
    hMobileMediaURL: { type: 'string' },
    hMobileHeight: { type: 'string', default: '400px' },
  };

  return settings;
});

addFilter('editor.BlockEdit', 'extend-cover/edit', addControl);