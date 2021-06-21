import { RichText,
  BlockControls,
  AlignmentToolbar,
  InspectorControls,
  PanelColorSettings } from '@wordpress/block-editor';
import { ToolbarButton,
  ToolbarGroup,
  ToggleControl,
  PanelBody,
  TextControl,
  TextareaControl } from '@wordpress/components';
import SVGInline from './_react-svg-inline.jsx';
import URLPicker from './_url-picker.jsx';


export default function ( props ) {
  let atts = props.attributes;

  let allowedRichTextFormats = [
    'core/bold', 'core/italic', 'core/strikethrough', 'core/subscript', 'core/superscript',
    'core/image', 'core/text-color', 'core/code'
  ];

  // allow link if not fully clickable
  if( !atts.isFullyClickable ) {
    allowedRichTextFormats.push( 'core/link' );
  }

  // format className for the div
  let className = `${ props.className }
    has-icon-position-${ atts.iconPosition }
    has-text-align-${ atts.align }
    ${ atts.bgColor === 'none' ? '' : 'has-background'  }
    ${ atts.description === '<p></p>' || atts.description === '' ? 'has-no-description' : 'has-description' }`;

  return ( <>
    <InspectorControls>
      <PanelBody title="Settings" initialOpen="true">

        <ToggleControl label="Is Fully Clickable?"
          checked={ atts.isFullyClickable }
          onChange={ _onToggleFullyClickable } />

        { atts.useRawSVG || <div className="h-icon-control">
          <div>
            <TextControl label="Icon Name"
              value={ atts.iconName }
              onChange={ _updateIconMarkup } />

            <small style={{display: 'block', marginTop: '-1.5rem'}}>
              Visit here to see list of icons: <a href="https://fontawesome.com/icons?d=gallery&s=solid&m=free" target="_blank">FontAwesome.com</a>
            </small>
          </div>

          <SVGInline src={ 'https://cdn.pixelstudio.id/h-block-icon/' + atts.iconName + '.svg' }
            onFound={ markup => props.setAttributes({ iconMarkup: markup }) } />
        </div> }

        <ToggleControl label="Use Raw SVG?"
          checked={ atts.useRawSVG }
          onChange={ value => props.setAttributes({ useRawSVG: value }) } />

        { atts.useRawSVG && <TextareaControl
          label="Raw SVG"
          value={ atts.iconMarkup }
          help="Paste in the SVG code here"
          onChange={ value => props.setAttributes({ iconMarkup: value }) }
        /> }
        
      </PanelBody>

      <PanelColorSettings title="Color"
        initialOpen="true"
        colorSettings={ [
          {
            label: 'Text Color',
            value: atts.textColor,
            onChange: (value) => {
              props.setAttributes( { textColor: value ? value : '' } )
            }
          },
          {
            label: 'Background Color',
            value: atts.bgColor,
            onChange: (value) => {
              props.setAttributes( { bgColor: value ? value : '' } )
            }
          },
          {
            label: 'Icon Color',
            value: atts.iconColor,
            onChange: (value) => {
              props.setAttributes( { iconColor: value ? value : '' } )
            }
          },
        ] }>
      </PanelColorSettings>

    </InspectorControls>

    <BlockControls>
      <ToolbarGroup>
        <ToolbarButton icon="table-col-before"
          title="Icon on Left"
          className={ atts.iconPosition == 'left' ? 'is-pressed' : '' }
          onClick={ () => props.setAttributes( { iconPosition: 'left' } ) } />

        <ToolbarButton icon="table-row-before"
          title="Icon on Top"
          className={ atts.iconPosition == 'top' ? 'is-pressed' : '' }
          onClick={ () => props.setAttributes( { iconPosition: 'top' } ) } />

        <ToolbarButton icon="table-col-after"
          title="Icon on Right"
          className={ atts.iconPosition == 'right' ? 'is-pressed' : '' }
          onClick={ () => props.setAttributes( { iconPosition: 'right' } ) } />
      </ToolbarGroup>
        
      <AlignmentToolbar value={ atts.align }
        onChange={ value => props.setAttributes( { align: value ? value : 'none' } ) } />
    </BlockControls>

    { atts.isFullyClickable && <URLPicker
      url={ atts.url }
      setAttributes={ props.setAttributes }
      isSelected={ props.isSelected }
      opensInNewTab={ atts.linkTarget === '_blank' }
      onToggleOpenInNewTab={ ( value ) => {
        let linkTarget = value ? '_blank' : undefined;
        props.setAttributes( { linkTarget: linkTarget } );
      } }
    /> }

    <div className={ className }
      style={{
        '--textColor': atts.textColor,
        '--bgColor': atts.bgColor,
        '--iconColor': atts.iconColor,
      }}>

      <figure dangerouslySetInnerHTML={{ __html: atts.iconMarkup }}></figure>

      <dl>
        <RichText tagName='dt'
          className='wp-block-h-icon__title'
          inline={ true }
          placeholder='Enter title…'
          value={ atts.heading }
          allowedFormats={ allowedRichTextFormats }
          onChange={ value => props.setAttributes({ heading: value }) }	/>

        <RichText tagName='dd'
          className='wp-block-h-icon__description'
          multiline='p'
          placeholder='Enter description…'
          value={ atts.description }
          allowedFormats={ allowedRichTextFormats }
          onChange={ value => props.setAttributes({ description: value }) } />
      </dl>
    </div>
  </> );


  /**
   * Add slight delay before requesting for update 
   */
  function _updateIconMarkup( value ) {
    props.setAttributes({ iconName: value });
  }

  /**
   * Clean the anchor inside heading and description 
   */
  function _onToggleFullyClickable( value ) {
    let attsToSet = {
      isFullyClickable: value
    };

    // remove all anchor inside heading and description
    if( value ) { 
      let newHeading = atts.heading.replace( /<\/?a[^>]*>/g, '' );
      let newDescription = atts.description.replace( /<\/?a[^>]*>/g, '' );

      attsToSet[ 'heading' ] = newHeading;
      attsToSet[ 'description' ] = newDescription;
    }

    props.setAttributes( attsToSet );
  }
}