/**
 * Block Name
 * 
 * Write short description here
 */
( function( blocks, editor, element, components ) { 'use strict';

const el = element.createElement;
const { RichText, InspectorControls, PanelColorSettings } = editor;
const { ToggleControl, PanelBody } = components;

blocks.registerBlockType( 'h/faq', {
  title: 'FAQ',
  description: 'Toggle-able Question to reveal the answer',
  icon: 'editor-help',
  category: 'layout',

  attributes: {
    question: { type: 'array', source: 'children', selector: '.h-faq-question' },
    answer: { type: 'array', source: 'children', selector: '.h-faq-answer' },

    titleColor: { type: 'string' },
    titleBg: { type: 'string' },
    initiallyOpen: { type: 'boolean' },
    noIndex:  { type: 'boolean' }
  },

  example: {},

  //
  edit: ( props ) => {
    let atts = props.attributes;

    return [
      ///// SIDEBAR

      el( InspectorControls, {},
        el( PanelBody, { title: 'Settings', initialOpen: true },
          el( ToggleControl, {
            label: 'Initially Open?',
            checked: atts.initiallyOpen,
            onChange: ( value ) => {
              props.setAttributes( { initiallyOpen: value } );
            },
          } ),

          el( ToggleControl, {
            label: 'No Index?',
            checked: atts.noIndex,
            onChange: ( value ) => {
              props.setAttributes( { noIndex: value } );
            },
          } )
        ),
        el( PanelColorSettings, {
          title: 'Color',
          initialOpen: true,
          colorSettings: [
            {
              label: 'Title Text',
              value: atts.titleColor,
              onChange: (value) => {
                props.setAttributes( { titleColor: value ? value : '' } )
              }
            },
            {
              label: 'Title Background',
              value: atts.titleBg,
              onChange: (value) => {
                props.setAttributes( { titleBg: value ? value : '' } )
              }
            },
          ],
        } ),
      ),

      ///// FIELDS

      el( 'div', {
          className: props.className,
          open: atts.initiallyOpen,
          style: { '--faqTitleColor': atts.titleColor, '--faqTitleBg': atts.titleBg },
        },
        // Question
        el( RichText, {
          tagName: 'h4',
          className: 'h-faq-question',
          value: atts.question,
          placeholder: 'Enter the Question...',
          onChange: ( value ) => {
            props.setAttributes( { question: value } );
          },
        } ),

        // Visibile Icon
        el( 'span', {
          className: 'dashicons-before dashicons-hidden ' + (atts.noIndex ? '' : 'hidden'),
          title: 'Click to disable noindex',
          onClick: () => {
            props.setAttributes( { noIndex: false } )
          }
        } ),

        // Answer
        el( RichText, {
          tagName: 'div',
          className: 'h-faq-answer',
          value: atts.answer,
          multiline: 'p',
          placeholder: 'Enter the Answer...',

          onChange: ( value ) => {
            props.setAttributes( { answer: value } );
          },
        }),

      )
    ];
  },

  /**
   *   <details class="wp-block-h-faq">
   *     <summary class="h-faq-question"> ... </summary>
   *     <div class="h-faq-answer">
   *       ...
   *     </div>
   *   </details>
   */
  save: ( props ) => {
    let atts = props.attributes;

    return el( 'details', {
      className: ( atts.noIndex ? '--noindex' : '' ),
      open: atts.initiallyOpen,
      style: { '--faqTitleColor': atts.titleColor, '--faqTitleBg': atts.titleBg },
    }, [
      el( 'summary', { className: 'h-faq-question' }, atts.question ),
      el( 'div', { className: 'h-faq-answer' }, atts.answer ),
    ] );
  },

} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components );