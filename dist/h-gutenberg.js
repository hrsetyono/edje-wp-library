!function(e){var t={};function r(o){if(t[o])return t[o].exports;var a=t[o]={i:o,l:!1,exports:{}};return e[o].call(a.exports,a,a.exports,r),a.l=!0,a.exports}r.m=e,r.c=t,r.d=function(e,t,o){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(r.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)r.d(o,a,function(t){return e[t]}.bind(null,a));return o},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=333)}({333:function(e,t,r){"use strict";r.r(t);r(334);wp.domReady(()=>{localizeH.disallowedBlocks.forEach(e=>{wp.blocks.unregisterBlockType(e)})}),wp.hooks.addFilter("blocks.registerBlockType","h/set_default_alignment",(e,t)=>{switch(t){case"core/paragraph":case"core/list":case"core/gallery":case"core/code":case"core/verse":case"core/preformatted":case"core/table":case"core/pullquote":case"core/heading":e.supports={...e.supports,align:["wide"]};break;case"core/file":case"core/audio":e.supports={...e.supports,align:[]};break;case"core/social-links":e.supports={...e.supports,align:["center"]};break;case"core/columns":e.supports={...e.supports,align:["wide"]},e.attributes={...e.attributes,align:{type:"string",default:"wide"}};break;case"core/group":e.supports={...e.supports,__experimentalLayout:!1,layout:!1,spacing:!1},e.attributes={...e.attributes,align:{type:"string",default:"full"},layout:{type:[Object],default:{inherit:!0}}};break;case"core/cover":e.attributes={...e.attributes,align:{type:"string",default:"full"}}}return e})},334:function(e,t,r){}});