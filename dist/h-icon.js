!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=34)}([function(e,t){e.exports=window.wp.element},function(e,t){e.exports=window.wp.components},function(e,t){e.exports=window.wp.blockEditor},function(e,t){e.exports=window.wp.primitives},function(e,t){e.exports=window.wp.blocks},function(e,t){e.exports=window.wp.keycodes},function(e,t){function n(t){return e.exports=n=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)},e.exports.__esModule=!0,e.exports.default=e.exports,n(t)}e.exports=n,e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=window.regeneratorRuntime},function(e,t){e.exports=function(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=window.wp.i18n},function(e,t){function n(e,t,n,o,r,i,c){try{var l=e[i](c),a=l.value}catch(e){return void n(e)}l.done?t(a):Promise.resolve(a).then(o,r)}e.exports=function(e){return function(){var t=this,o=arguments;return new Promise((function(r,i){var c=e.apply(t,o);function l(e){n(c,r,i,l,a,"next",e)}function a(e){n(c,r,i,l,a,"throw",e)}l(void 0)}))}},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){function n(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}e.exports=function(e,t,o){return t&&n(e.prototype,t),o&&n(e,o),Object.defineProperty(e,"prototype",{writable:!1}),e},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t,n){var o=n(17);e.exports=function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),Object.defineProperty(e,"prototype",{writable:!1}),t&&o(e,t)},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t,n){var o=n(18).default,r=n(19);e.exports=function(e,t){if(t&&("object"===o(t)||"function"==typeof t))return t;if(void 0!==t)throw new TypeError("Derived constructors may only return object or undefined");return r(e)},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t,n){var o=n(20),r=n(21),i=n(22),c=n(24);e.exports=function(e,t){return o(e)||r(e,t)||i(e,t)||c()},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t,n){},function(e,t){function n(t,o){return e.exports=n=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e},e.exports.__esModule=!0,e.exports.default=e.exports,n(t,o)}e.exports=n,e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){function n(t){return e.exports=n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},e.exports.__esModule=!0,e.exports.default=e.exports,n(t)}e.exports=n,e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=function(e){if(Array.isArray(e))return e},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=function(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var o,r,i=[],c=!0,l=!1;try{for(n=n.call(e);!(c=(o=n.next()).done)&&(i.push(o.value),!t||i.length!==t);c=!0);}catch(e){l=!0,r=e}finally{try{c||null==n.return||n.return()}finally{if(l)throw r}}return i}},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t,n){var o=n(23);e.exports=function(e,t){if(e){if("string"==typeof e)return o(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?o(e,t):void 0}},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=function(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,o=new Array(t);n<t;n++)o[n]=e[n];return o},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")},e.exports.__esModule=!0,e.exports.default=e.exports},,,,,,,,,,function(e,t,n){"use strict";n.r(t);n(16);var o=n(4),r=n(0),i=n(2),c=n(1),l=n(10),a=n.n(l),s=n(11),u=n.n(s),p=n(12),f=n.n(p),b=n(13),d=n.n(b),m=n(14),h=n.n(m),g=n(6),x=n.n(g),y=n(7),v=n.n(y),w={API:{get(e,t={}){return window.fetch(e,{method:"GET",headers:{Accept:"application/json"},...t}).then(this._handleError).then(this._handleContentType).catch(this._throwError)},post(e,t,n={}){return window.fetch(e,{method:"POST",headers:{"content-type":"application/json"},body:JSON.stringify(t),...n}).then(this._handleError).then(this._handleContentType).catch(this._throwError)},_handleError:e=>e.ok?e:Promise.reject(e.statusText),_handleContentType(e){const t=e.headers.get("content-type");return t&&t.includes("application/json")?e.json():t&&t.includes("image/svg+xml")?Promise.resolve(e.text()):Promise.reject("Oops, we haven't got JSON!")},_throwError(e){throw new Error(e)}}};function _(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,o=x()(e);if(t){var r=x()(this).constructor;n=Reflect.construct(o,arguments,r)}else n=o.apply(this,arguments);return h()(this,n)}}var O=function(e){d()(o,e);var t,n=_(o);function o(){var e;return u()(this,o),(e=n.call(this)).abortController=new AbortController,e.timer=null,e.state={markup:null},e}return f()(o,[{key:"render",value:function(){return this.state.markup?Object(r.createElement)("span",{className:"h-svg-inline",dangerouslySetInnerHTML:{__html:this.state.markup}}):Object(r.createElement)("span",{className:"h-svg-inline"},"Icon not found")}},{key:"componentDidMount",value:function(){this._getMarkup(this.props.src)}},{key:"componentDidUpdate",value:function(e,t){var n=this;this.props.src!==e.src&&(clearTimeout(this.timer),this.timer=setTimeout((function(){n._getMarkup(n.props.src)}),1e3))}},{key:"_getMarkup",value:(t=a()(v.a.mark((function e(t){var n;return v.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(n=localStorage.getItem(t)){e.next=6;break}return e.next=4,w.API.get(t,{signal:this.abortController.signal});case 4:(n=e.sent)&&localStorage.setItem(t,n);case 6:this.props.onFound(n),this.setState({markup:n});case 8:case"end":return e.stop()}}),e,this)}))),function(e){return t.apply(this,arguments)})},{key:"componentWillUnmount",value:function(){this.abortController.abort()}}]),o}(React.Component),j=n(8),k=n.n(j),C=n(15),E=n.n(C),S=n(9),T=n(5),I=n(3),M=Object(r.createElement)(I.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(r.createElement)(I.Path,{d:"M15.6 7.2H14v1.5h1.6c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.8 0 5.2-2.3 5.2-5.2 0-2.9-2.3-5.2-5.2-5.2zM4.7 12.4c0-2 1.7-3.7 3.7-3.7H10V7.2H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H10v-1.5H8.4c-2 0-3.7-1.7-3.7-3.7zm4.6.9h5.3v-1.5H9.3v1.5z"})),P=Object(r.createElement)(I.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(r.createElement)(I.Path,{d:"M15.6 7.3h-.7l1.6-3.5-.9-.4-3.9 8.5H9v1.5h2l-1.3 2.8H8.4c-2 0-3.7-1.7-3.7-3.7s1.7-3.7 3.7-3.7H10V7.3H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H9l-1.4 3.2.9.4 5.7-12.5h1.4c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.9 0 5.2-2.3 5.2-5.2 0-2.9-2.4-5.2-5.2-5.2z"}));var A=function(e){var t,n=e.isSelected,o=e.url,l=e.setAttributes,a=e.opensInNewTab,s=e.onToggleOpenInNewTab,u=Object(r.useState)(!1),p=E()(u,2),f=p[0],b=p[1],d=!!o,m=d&&n,h=function(){return b(!0),!1},g=function(){l({url:void 0,linkTarget:void 0,rel:void 0}),b(!1)},x=(f||m)&&Object(r.createElement)(c.Popover,{position:"bottom center",onClose:function(){return b(!1)}},Object(r.createElement)(i.__experimentalLinkControl,{className:"wp-block-navigation-link__inline-link-input",value:{url:o,opensInNewTab:a},onChange:function(e){var t=e.url,n=void 0===t?"":t,o=e.opensInNewTab;l({url:n}),a!==o&&s(o)}}));return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(i.BlockControls,null,Object(r.createElement)(c.ToolbarGroup,null,!d&&Object(r.createElement)(c.ToolbarButton,{name:"link",icon:M,title:Object(S.__)("Link"),shortcut:T.displayShortcut.primary("k"),onClick:h}),m&&Object(r.createElement)(c.ToolbarButton,{name:"link",icon:P,title:Object(S.__)("Unlink"),shortcut:T.displayShortcut.primaryShift("k"),onClick:g,isActive:!0}))),n&&Object(r.createElement)(c.KeyboardShortcuts,{bindGlobal:!0,shortcuts:(t={},k()(t,T.rawShortcut.primary("k"),h),k()(t,T.rawShortcut.primaryShift("k"),g),t)}),x)};Object(o.registerBlockType)("h/icon",{title:"Icon",description:"Icon with texts",icon:"id",category:"layout",example:{},attributes:window.hLocalizeIcon.defaultAtts,styles:[{name:"boxed",label:"Boxed"}],edit:function(e){var t=e.attributes,n=["core/bold","core/italic","core/strikethrough","core/subscript","core/superscript","core/image","core/text-color","core/code"];t.isFullyClickable||n.push("core/link");var o="".concat(e.className,"\n    has-icon-position-").concat(t.iconPosition,"\n    has-text-align-").concat(t.align,"\n    ").concat("none"===t.bgColor?"":"has-background","\n    ").concat("<p></p>"===t.description||""===t.description?"has-no-description":"has-description","\n    ").concat(t.useImage?"use-image":""),l=!t.useRawSVG&&!t.useImage,a=[{label:"Text Color",value:t.textColor,onChange:function(t){e.setAttributes({textColor:t||""})}},{label:"Background Color",value:t.bgColor,onChange:function(t){e.setAttributes({bgColor:t||""})}}];return t.useImage||a.push({label:"Icon Color",value:t.iconColor,onChange:function(t){e.setAttributes({iconColor:t||""})}}),Object(r.createElement)(r.Fragment,null,Object(r.createElement)(i.InspectorControls,null,Object(r.createElement)(c.PanelBody,{title:"Settings",initialOpen:"true"},Object(r.createElement)(c.ToggleControl,{label:"Is Fully Clickable?",checked:t.isFullyClickable,onChange:function(n){var o={isFullyClickable:n};if(n){var r=t.heading.replace(/<\/?a[^>]*>/g,""),i=t.description.replace(/<\/?a[^>]*>/g,"");o.heading=r,o.description=i}e.setAttributes(o)}}),l&&Object(r.createElement)("div",{className:"h-icon-control"},Object(r.createElement)("div",null,Object(r.createElement)(c.TextControl,{label:"Icon Name",value:t.iconName,onChange:function(t){e.setAttributes({iconName:t})}}),Object(r.createElement)("small",{style:{display:"block",marginTop:"-1.5rem"}},"Visit here to see list of icons: ",Object(r.createElement)("a",{href:"https://fontawesome.com/v5/search?m=free&s=solid",target:"_blank"},"FontAwesome.com"))),Object(r.createElement)(O,{src:hLocalizeIcon.iconURL+"/"+t.iconName+".svg",onFound:function(t){return e.setAttributes({iconMarkup:t})}})),Object(r.createElement)(c.ToggleControl,{label:"Use Raw SVG?",checked:t.useRawSVG,onChange:function(t){return e.setAttributes({useRawSVG:t,useImage:!1})}}),t.useRawSVG&&Object(r.createElement)(c.TextareaControl,{label:"Raw SVG",value:t.iconMarkup,help:"Paste in the SVG code here",onChange:function(t){return e.setAttributes({iconMarkup:t})}}),Object(r.createElement)(c.ToggleControl,{label:"Use Image?",checked:t.useImage,onChange:function(t){return e.setAttributes({useImage:t,useRawSVG:!1,iconMarkup:""})}}),t.useImage&&Object(r.createElement)(i.MediaUpload,{allowedTypes:"image",value:t.mediaID,onSelect:function(t){e.setAttributes({imageURL:t.url,imageID:t.id})},render:function(e){var n=t.imageID?"button button--transparent":"button";return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(c.Button,{className:n,onClick:e.open},t.imageID?"Change Image":"Upload Image"),t.imageID&&Object(r.createElement)("img",{class:"wp-block-h-icon__image-preview",src:t.imageURL}))}})),Object(r.createElement)(i.PanelColorSettings,{title:"Color",initialOpen:"true",colorSettings:a})),Object(r.createElement)(i.BlockControls,null,Object(r.createElement)(c.ToolbarGroup,null,Object(r.createElement)(c.ToolbarButton,{icon:"table-col-before",title:"Icon on Left",className:"left"==t.iconPosition?"is-pressed":"",onClick:function(){return e.setAttributes({iconPosition:"left"})}}),Object(r.createElement)(c.ToolbarButton,{icon:"table-row-before",title:"Icon on Top",className:"top"==t.iconPosition?"is-pressed":"",onClick:function(){return e.setAttributes({iconPosition:"top"})}}),Object(r.createElement)(c.ToolbarButton,{icon:"table-col-after",title:"Icon on Right",className:"right"==t.iconPosition?"is-pressed":"",onClick:function(){return e.setAttributes({iconPosition:"right"})}})),Object(r.createElement)(i.AlignmentToolbar,{value:t.align,onChange:function(t){return e.setAttributes({align:t||"none"})}})),t.isFullyClickable&&Object(r.createElement)(A,{url:t.url,setAttributes:e.setAttributes,isSelected:e.isSelected,opensInNewTab:"_blank"===t.linkTarget,onToggleOpenInNewTab:function(t){var n=t?"_blank":void 0;e.setAttributes({linkTarget:n})}}),Object(r.createElement)("div",{className:o,style:{"--textColor":t.textColor,"--bgColor":t.bgColor,"--iconColor":t.iconColor}},t.useImage?Object(r.createElement)("figure",{className:"wp-block-h-icon__figure"},Object(r.createElement)("img",{src:t.imageURL})):Object(r.createElement)("figure",{className:"wp-block-h-icon__figure",dangerouslySetInnerHTML:{__html:t.iconMarkup}}),Object(r.createElement)("dl",{className:"wp-block-h-icon__content"},Object(r.createElement)(i.RichText,{tagName:"dt",inline:!0,placeholder:"Enter title…",value:t.heading,allowedFormats:n,onChange:function(t){return e.setAttributes({heading:t})}}),Object(r.createElement)(i.RichText,{tagName:"dd",multiline:"p",placeholder:"Enter description…",value:t.description,allowedFormats:n,onChange:function(t){return e.setAttributes({description:t})}}))))}})}]);