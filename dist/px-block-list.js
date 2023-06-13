!function(e){var t={};function r(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(n,o,function(t){return e[t]}.bind(null,o));return n},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=53)}([function(e,t){e.exports=window.wp.element},function(e,t){e.exports=window.wp.blockEditor},function(e,t){e.exports=window.wp.blocks},function(e,t){e.exports=window.wp.components},function(e,t){e.exports=window.wp.primitives},function(e,t){e.exports=window.wp.richText},function(e,t){e.exports=window.wp.i18n},function(e,t,r){var n=r(10);e.exports=function(e,t,r){return(t=n(t))in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){function r(t){return e.exports=r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},e.exports.__esModule=!0,e.exports.default=e.exports,r(t)}e.exports=r,e.exports.__esModule=!0,e.exports.default=e.exports},function(e){e.exports=JSON.parse('{"c":"core/list","f":"List","b":"Create a bulleted or numbered list.","a":{"ordered":{"type":"boolean","default":false,"__experimentalRole":"content"},"values":{"type":"string","source":"html","selector":"ol,ul","multiline":"li","__unstableMultilineWrapperTags":["ol","ul"],"default":"","__experimentalRole":"content"},"type":{"type":"string"},"start":{"type":"number"},"reversed":{"type":"boolean"},"placeholder":{"type":"string"}},"e":{"anchor":true,"className":false,"typography":{"fontSize":true,"__experimentalFontFamily":true,"lineHeight":true,"__experimentalFontStyle":true,"__experimentalFontWeight":true,"__experimentalLetterSpacing":true,"__experimentalTextTransform":true,"__experimentalDefaultControls":{"fontSize":true}},"color":{"gradients":true,"link":true},"__unstablePasteTextInline":true,"__experimentalSelector":"ol,ul","__experimentalSlashInserter":true},"d":[]}')},function(e,t,r){var n=r(8).default,o=r(12);e.exports=function(e){var t=o(e,"string");return"symbol"===n(t)?t:String(t)},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=window.wp.domReady},function(e,t,r){var n=r(8).default;e.exports=function(e,t){if("object"!==n(e)||null===e)return e;var r=e[Symbol.toPrimitive];if(void 0!==r){var o=r.call(e,t||"default");if("object"!==n(o))return o;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=function(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n},e.exports.__esModule=!0,e.exports.default=e.exports},,function(e,t,r){var n=r(22),o=r(23),c=r(16),l=r(24);e.exports=function(e){return n(e)||o(e)||c(e)||l()},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t,r){var n=r(13);e.exports=function(e,t){if(e){if("string"==typeof e)return n(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);return"Object"===r&&e.constructor&&(r=e.constructor.name),"Map"===r||"Set"===r?Array.from(e):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?n(e,t):void 0}},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){function r(){return e.exports=r=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)Object.prototype.hasOwnProperty.call(r,n)&&(e[n]=r[n])}return e},e.exports.__esModule=!0,e.exports.default=e.exports,r.apply(this,arguments)}e.exports=r,e.exports.__esModule=!0,e.exports.default=e.exports},,,,,function(e,t,r){var n=r(13);e.exports=function(e){if(Array.isArray(e))return n(e)},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)},e.exports.__esModule=!0,e.exports.default=e.exports},function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")},e.exports.__esModule=!0,e.exports.default=e.exports},,,,,,,,,,,,,,,,,,,,,function(e,t,r){},,,,,,,,function(e,t,r){"use strict";r.r(t);var n=r(7),o=r.n(n),c=r(0),l=r(4),i=Object(c.createElement)(l.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},Object(c.createElement)(l.Path,{d:"M4 4v1.5h16V4H4zm8 8.5h8V11h-8v1.5zM4 20h16v-1.5H4V20zm4-8c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2z"})),a=r(2),u=r(11),s=r.n(u),p=r(1),f=r(17),b=r.n(f),m=r(6),d=r(3),v=Object(c.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)(l.Path,{d:"M4 8.8h8.9V7.2H4v1.6zm0 7h8.9v-1.5H4v1.5zM18 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"})),O=Object(c.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)(l.Path,{d:"M11.1 15.8H20v-1.5h-8.9v1.5zm0-8.6v1.5H20V7.2h-8.9zM6 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-7c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"})),h=Object(c.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)(l.Path,{d:"M3.8 15.8h8.9v-1.5H3.8v1.5zm0-7h8.9V7.2H3.8v1.6zm14.7-2.1V10h1V5.3l-2.2.7.3 1 .9-.3zm1.2 6.1c-.5-.6-1.2-.5-1.7-.4-.3.1-.5.2-.7.3l.1 1.1c.2-.2.5-.4.8-.5.3-.1.6 0 .7.1.2.3 0 .8-.2 1.1-.5.8-.9 1.6-1.4 2.5H20v-1h-.9c.3-.6.8-1.4.9-2.1 0-.3 0-.8-.3-1.1z"})),y=Object(c.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)(l.Path,{d:"M11.1 15.8H20v-1.5h-8.9v1.5zm0-8.6v1.5H20V7.2h-8.9zM5 6.7V10h1V5.3L3.8 6l.4 1 .8-.3zm-.4 5.7c-.3.1-.5.2-.7.3l.1 1.1c.2-.2.5-.4.8-.5.3-.1.6 0 .7.1.2.3 0 .8-.2 1.1-.5.8-.9 1.6-1.4 2.5h2.7v-1h-1c.3-.6.8-1.4.9-2.1.1-.3 0-.8-.2-1.1-.5-.6-1.3-.5-1.7-.4z"})),j=Object(c.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)(l.Path,{d:"M20 5.5H4V4H20V5.5ZM12 12.5H4V11H12V12.5ZM20 20V18.5H4V20H20ZM15.4697 14.9697L18.4393 12L15.4697 9.03033L16.5303 7.96967L20.0303 11.4697L20.5607 12L20.0303 12.5303L16.5303 16.0303L15.4697 14.9697Z"})),g=Object(c.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)(l.Path,{d:"M4 7.2v1.5h16V7.2H4zm8 8.6h8v-1.5h-8v1.5zm-4-4.6l-4 4 4 4 1-1-3-3 3-3-1-1z"})),x=Object(c.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)(l.Path,{d:"M20 5.5H4V4H20V5.5ZM12 12.5H4V11H12V12.5ZM20 20V18.5H4V20H20ZM20.0303 9.03033L17.0607 12L20.0303 14.9697L18.9697 16.0303L15.4697 12.5303L14.9393 12L15.4697 11.4697L18.9697 7.96967L20.0303 9.03033Z"})),w=Object(c.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)(l.Path,{d:"M4 7.2v1.5h16V7.2H4zm8 8.6h8v-1.5h-8v1.5zm-8-3.5l3 3-3 3 1 1 4-4-4-4-1 1z"}));function _(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function S(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?_(Object(r),!0).forEach((function(t){o()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):_(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function P(e){for(var t=e.start,r=e.text,n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:t,o=n;o--;)if("\u2028"===r[o])return o}function E(e){var t=P(e);if(void 0===t)return!1;var r=e.replacements,n=P(e,t),o=r[t]||[],c=r[n]||[];return o.length<=c.length}function M(e,t){if(!E(e))return e;for(var r=P(e),n=P(e,r),o=e.text,c=e.replacements,l=e.end,i=c.slice(),a=function(e,t){for(var r=e.text,n=e.replacements,o=n[t]||[],c=t;c-- >=0;)if("\u2028"===r[c]){var l=n[c]||[];if(l.length===o.length+1)return c;if(l.length<=o.length)return}}(e,r),u=r;u<l;u++)if("\u2028"===o[u])if(a){var s=c[a]||[];i[u]=s.concat((i[u]||[]).slice(s.length-1))}else{var p=c[n]||[],f=p[p.length-1]||t;i[u]=p.concat([f],(i[u]||[]).slice(p.length))}return S(S({},e),{},{replacements:i})}function T(e){return void 0!==e.replacements[P(e,e.start)]}function k(e,t){for(var r=e.text,n=e.replacements,o=n[t]||[],c=t;c-- >=0;){if("\u2028"===r[c])if((n[c]||[]).length===o.length-1)return c}}function B(e){if(!T(e))return e;for(var t=e.text,r=e.replacements,n=e.start,o=e.end,c=P(e,n),l=r.slice(0),i=r[k(e,c)]||[],a=function(e,t){for(var r=e.text,n=e.replacements,o=n[t]||[],c=t,l=t||0;l<r.length;l++)if("\u2028"===r[l]){if(!((n[l]||[]).length>=o.length))return c;c=l}return c}(e,P(e,o)),u=c;u<=a;u++)if("\u2028"===t[u]){var s=l[u]||[];l[u]=i.concat(s.slice(i.length+1)),0===l[u].length&&delete l[u]}return S(S({},e),{},{replacements:l})}function V(e,t,r){var n=e.replacements[P(e,e.start)];return n&&0!==n.length?n[n.length-1].type===t:t===r}function L(e,t){for(var r,n=e.text,o=e.replacements,c=e.start,l=e.end,i=P(e,c),a=o[i]||[],u=o[P(e,l)]||[],s=k(e,i),p=o.slice(),f=a.length-1,b=u.length-1,m=s+1||0;m<n.length;m++)if("\u2028"===n[m]){if((p[m]||[]).length<=f)break;p[m]&&(r=!0,p[m]=p[m].map((function(e,r){return r<f||r>b?e:t})))}return r?S(S({},e),{},{replacements:p}):e}function H(e){var t=e.replacements[P(e,e.start)];return!t||t.length<1}var z=r(9),A=function(e){var t=e.setAttributes,r=e.reversed,n=e.start;return Object(c.createElement)(p.InspectorControls,null,Object(c.createElement)(d.PanelBody,{title:Object(m.__)("Ordered list settings")},Object(c.createElement)(d.TextControl,{label:Object(m.__)("Start value"),type:"number",onChange:function(e){var r=parseInt(e,10);t({start:isNaN(r)?void 0:r})},value:Number.isInteger(n)?n.toString(10):"",step:"1"}),Object(c.createElement)(d.ToggleControl,{label:Object(m.__)("Reverse list numbering"),checked:r||!1,onChange:function(e){t({reversed:e||void 0})}})))};function R(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function C(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?R(Object(r),!0).forEach((function(t){o()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):R(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function D(e){var t=e.attributes,r=e.setAttributes,n=e.mergeBlocks,o=e.onReplace,l=e.style,i=t.ordered,u=t.values,s=t.type,f=t.reversed,_=t.start,S=t.placeholder,P=i?"ol":"ul",k=Object(p.useBlockProps)({style:l});return Object(c.createElement)(c.Fragment,null,Object(c.createElement)(p.RichText,b()({identifier:"values",multiline:"li",tagName:P,onChange:function(e){return r({values:e})},value:u,"aria-label":Object(m.__)("List text"),placeholder:S||Object(m.__)("List"),onMerge:n,onSplit:function(e){return Object(a.createBlock)(z.c,C(C({},t),{},{values:e}))},__unstableOnSplitMiddle:function(){return Object(a.createBlock)("core/paragraph")},onReplace:o,onRemove:function(){return o([])},start:_,reversed:f,type:s},k),(function(e){var t=e.value,n=e.onChange,o=e.onFocus;return Object(c.createElement)(c.Fragment,null,Object(c.createElement)(p.RichTextShortcut,{type:"primary",character:"[",onUse:function(){n(B(t))}}),Object(c.createElement)(p.RichTextShortcut,{type:"primary",character:"]",onUse:function(){n(M(t,{type:P}))}}),Object(c.createElement)(p.RichTextShortcut,{type:"primary",character:"m",onUse:function(){n(M(t,{type:P}))}}),Object(c.createElement)(p.RichTextShortcut,{type:"primaryShift",character:"m",onUse:function(){n(B(t))}}),Object(c.createElement)(p.BlockControls,{group:"block"},Object(c.createElement)(d.ToolbarButton,{icon:Object(m.isRTL)()?v:O,title:Object(m.__)("Unordered"),describedBy:Object(m.__)("Convert to unordered list"),isActive:V(t,"ul",P),onClick:function(){n(L(t,{type:"ul"})),o(),H(t)&&r({ordered:!1})}}),Object(c.createElement)(d.ToolbarButton,{icon:Object(m.isRTL)()?h:y,title:Object(m.__)("Ordered"),describedBy:Object(m.__)("Convert to ordered list"),isActive:V(t,"ol",P),onClick:function(){n(L(t,{type:"ol"})),o(),H(t)&&r({ordered:!0})}}),Object(c.createElement)(d.ToolbarButton,{icon:Object(m.isRTL)()?j:g,title:Object(m.__)("Outdent"),describedBy:Object(m.__)("Outdent list item"),shortcut:Object(m._x)("Backspace","keyboard key"),isDisabled:!T(t),onClick:function(){n(B(t)),o()}}),Object(c.createElement)(d.ToolbarButton,{icon:Object(m.isRTL)()?x:w,title:Object(m.__)("Indent"),describedBy:Object(m.__)("Indent list item"),shortcut:Object(m._x)("Space","keyboard key"),isDisabled:!E(t),onClick:function(){n(M(t,{type:P})),o()}})))})),i&&Object(c.createElement)(A,{setAttributes:r,ordered:i,reversed:f,start:_,placeholder:S}))}function N(e){var t=e.attributes,r=t.ordered,n=t.values,o=t.type,l=t.reversed,i=t.start,a=r?"ol":"ul";return Object(c.createElement)(a,p.useBlockProps.save({type:o,reversed:l,start:i}),Object(c.createElement)(p.RichText.Content,{value:n,multiline:"li"}))}var I=r(15),G=r.n(I),U=r(5);function Z(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function F(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?Z(Object(r),!0).forEach((function(t){o()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):Z(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function W(e){var t=F(F({},e.phrasingContentSchema),{},{ul:{},ol:{attributes:["type","start","reversed"]}});return["ul","ol"].forEach((function(e){t[e].children={li:{children:t}}})),t}[{type:"block",isMultiBlock:!0,blocks:["core/paragraph","core/heading"],transform:function(e){return Object(a.createBlock)("core/list",{values:Object(U.toHTMLString)({value:Object(U.join)(e.map((function(t){var r=t.content,n=Object(U.create)({html:r});return e.length>1?n:Object(U.replace)(n,/\n/g,U.__UNSTABLE_LINE_SEPARATOR)})),U.__UNSTABLE_LINE_SEPARATOR),multilineTag:"li"}),anchor:e.anchor})}},{type:"block",blocks:["core/quote","core/pullquote"],transform:function(e){var t=e.value,r=e.anchor;return Object(a.createBlock)("core/list",{values:Object(U.toHTMLString)({value:Object(U.create)({html:t,multilineTag:"p"}),multilineTag:"li"}),anchor:r})}},{type:"raw",selector:"ol,ul",schema:function(e){return{ol:W(e).ol,ul:W(e).ul}},transform:function(e){var t={ordered:"OL"===e.nodeName,anchor:""===e.id?void 0:e.id};if(t.ordered){var r=e.getAttribute("type");r&&(t.type=r),null!==e.getAttribute("reversed")&&(t.reversed=!0);var n=parseInt(e.getAttribute("start"),10);isNaN(n)||1===n&&!t.reversed||(t.start=n)}return Object(a.createBlock)("core/list",F(F({},Object(a.getBlockAttributes)("core/list",e.outerHTML)),t))}}].concat(G()(["*","-"].map((function(e){return{type:"prefix",prefix:e,transform:function(e){return Object(a.createBlock)("core/list",{values:"<li>".concat(e,"</li>")})}}}))),G()(["1.","1)"].map((function(e){return{type:"prefix",prefix:e,transform:function(e){return Object(a.createBlock)("core/list",{ordered:!0,values:"<li>".concat(e,"</li>")})}}})))),r(45);function q(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function J(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?q(Object(r),!0).forEach((function(t){o()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):q(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}s()((function(){Object(a.unregisterBlockType)("core/list"),Object(a.registerBlockType)(z.c,{icon:i,title:z.f,description:z.b,attributes:z.a,supports:z.e,styles:z.d,example:{attributes:{values:"<li>Alice.</li><li>The White Rabbit.</li><li>The Cheshire Cat.</li><li>The Mad Hatter.</li><li>The Queen of Hearts.</li>"}},merge:function(e,t){var r=t.values;return r&&"<li></li>"!==r?J(J({},e),{},{values:e.values+r}):e},edit:D,save:N})}))}]);