import {
  useBlockProps,
  RichText,
  InspectorControls } from '@wordpress/block-editor';
import {
  ToggleControl,
  PanelBody } from '@wordpress/components';

export default function (props) {
  let atts = props.attributes;
  const blockProps = useBlockProps();

  return (<>
    <InspectorControls>
      <PanelBody
        title='Settings'
        initialOpen={true}>
        
        <ToggleControl
          label='Initially Open?'
          checked={atts.initiallyOpen}
          onChange={(value) => {
            props.setAttributes({ initiallyOpen: value });
          }}
        />

        <ToggleControl
          label='No Index?'
          checked={atts.noIndex}
          onChange={(value) => {
            props.setAttributes({ noIndex: value });
          }}
        />
      </PanelBody>
    </InspectorControls>

    <div
      {...blockProps}
      open={atts.initiallyOpen}
    >
      <RichText
        tagName='h4'
        className='px-block-faq__question'
        value={ atts.question }
        placeholder='Enter the Question...'
        onChange={(value) => {
          props.setAttributes({ question: value });
        }} />

      {atts.noIndex &&
        <span
          title='This FAQ is hidden from Google. Click here to disable noindex'
          className='dashicons-before dashicons-hidden'
          onClick={() => {
            props.setAttributes({ noIndex: false })
          }}
        />
      }

      <RichText
        tagName='div'
        className='px-block-faq__answer'
        value={atts.answer}
        multiline='p'
        placeholder='Enter the Answer...'
        onChange={(value) => {
          props.setAttributes({ answer: value });
        }}
      />
    </div>
  </>);
}