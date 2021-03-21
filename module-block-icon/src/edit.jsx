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
import Helper from './_helpers.js';
import URLPicker from './_url-picker.jsx';


export default function ( props ) {
  let atts = props.attributes;

  const colorSettings = [
    {
      label: 'Text Color',
      value: atts.textColor,
      onChange: (value) => {
        props.setAttributes( { textColor: value ? value : 'none' } )
      }
    },
    {
      label: 'Background Color',
      value: atts.bgColor,
      onChange: (value) => {
        props.setAttributes( { bgColor: value ? value : 'none' } )
      }
    },
  ];

  const blockControls = [
    {
      icon: 'table-col-before',
      title: 'Icon on Left',
      className: atts.iconPosition === 'left' ? 'is-pressed' : '',
      onClick: () => {
        props.setAttributes( { iconPosition: 'left' } );
      },
    },
    {
      icon: 'table-row-before',
      title: 'Icon on Top',
      className: atts.iconPosition === 'top' ? 'is-pressed' : '',
      onClick: () => {
        props.setAttributes( { iconPosition: 'top' } );
      },
    },
    {
      icon: 'table-col-after',
      title: 'Icon on Right',
      className: atts.iconPosition === 'right' ? 'is-pressed' : '',
      onClick: () => {
        props.setAttributes( { iconPosition: 'right' } );
      },
    },
  ];

  return ( <div className={ Helper.formatClassName( props ) }
    style={{
      '--textColor': atts.textColor,
      '--bgColor': atts.bgColor,
    }}>

    <InspectorControls>
      <PanelBody title="Settings" initialOpen="true">

        <ToggleControl label="Is Fully Clickable?"
          checked={ atts.isFullyClickable }
          onChange={ _onToggleFullyClickable } />

        <ToggleControl label="Has Description?"
          checked={ atts.hasDescription }
          onChange={ value => props.setAttributes({ hasDescription: value }) } />

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
        colorSettings={ colorSettings }>
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

    <figure dangerouslySetInnerHTML={{ __html: atts.iconMarkup }}></figure>

    <dl>
      <RichText tagName='dt'
        inline={ true }
        placeholder='Enter heading…'
        value={ atts.heading }
        withoutInteractiveFormatting={ atts.isFullyClickable }
        onChange={ value => props.setAttributes({ heading: value }) }	/>

      { atts.hasDescription &&
        <RichText tagName='dd'
          multiline='p'
          placeholder='Enter description…'
          value={ atts.description }
          withoutInteractiveFormatting={ atts.isFullyClickable }
          onChange={ value => props.setAttributes({ description: value }) } />
      }
    </dl>

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
  </div> );


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