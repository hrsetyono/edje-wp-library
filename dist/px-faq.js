!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=56)}({0:function(e,t){e.exports=window.wp.element},1:function(e,t){e.exports=window.wp.blockEditor},17:function(e,t){function n(){return e.exports=n=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},e.exports.__esModule=!0,e.exports.default=e.exports,n.apply(this,arguments)}e.exports=n,e.exports.__esModule=!0,e.exports.default=e.exports},2:function(e,t){e.exports=window.wp.blocks},3:function(e,t){e.exports=window.wp.components},42:function(e,t,n){},56:function(e,t,n){"use strict";n.r(t);n(42);var o=n(2),r=n(17),i=n.n(r),l=n(0),c=n(1),a=n(3);Object(o.registerBlockType)("px/faq",{edit:function(e){var t=e.attributes,n=Object(c.useBlockProps)();return Object(l.createElement)(l.Fragment,null,Object(l.createElement)(c.InspectorControls,null,Object(l.createElement)(a.PanelBody,{title:"Settings",initialOpen:!0},Object(l.createElement)(a.ToggleControl,{label:"Initially Open?",checked:t.initiallyOpen,onChange:function(t){e.setAttributes({initiallyOpen:t})}}),Object(l.createElement)(a.ToggleControl,{label:"No Index?",checked:t.noIndex,onChange:function(t){e.setAttributes({noIndex:t})}}))),Object(l.createElement)("div",i()({},n,{open:t.initiallyOpen}),Object(l.createElement)(c.RichText,{tagName:"h4",className:"px-block-faq__question",value:t.question,placeholder:"Enter the Question...",onChange:function(t){e.setAttributes({question:t})}}),t.noIndex&&Object(l.createElement)("span",{title:"This FAQ is hidden from Google. Click here to disable noindex",className:"dashicons-before dashicons-hidden",onClick:function(){e.setAttributes({noIndex:!1})}}),Object(l.createElement)(c.RichText,{tagName:"div",className:"px-block-faq__answer",value:t.answer,multiline:"p",placeholder:"Enter the Answer...",onChange:function(t){e.setAttributes({answer:t})}})))}})}});