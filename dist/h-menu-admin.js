!function(e){var t={};function n(i){if(t[i])return t[i].exports;var s=t[i]={i:i,l:!1,exports:{}};return e[i].call(s.exports,s,s.exports,n),s.l=!0,s.exports}n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var s in e)n.d(i,s,function(t){return e[t]}.bind(null,s));return i},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=35)}({35:function(e,t,n){"use strict";n.r(t);n(36);const i={init(){window.wpNavMenu&&(this.styleListener(),this.depthChangeListener(),window.wpNavMenu.options.globalMaxDepth=2)},styleListener(){document.querySelectorAll('.acf-field[data-name="dropdown_style"] input[type="radio"]').forEach(e=>{e.addEventListener("click",e=>{const t=e.currentTarget.closest(".menu-item");setTimeout(()=>{this.megaMenuAddClasses(t)})})});document.querySelectorAll(".menu-item.menu-item-depth-0").forEach(e=>{this.megaMenuAddClasses(e)})},depthChangeListener(){document.querySelector(".menu").addEventListener("mouseup",e=>{const t=e.target.classList.contains("menu-item")?e.target:e.target.closest(".menu-item");t&&setTimeout(()=>{const e=t.previousElementSibling,n=e.classList.contains("h-mega-menu__child")||e.classList.contains("h-mega-menu");this.isChildItem(t)&&n?t.classList.add("h-mega-menu__child"):t.classList.remove("h-mega-menu__child")})})},megaMenuAddClasses(e){const t=e.querySelector('[data-name="dropdown_style"] input[type="radio"]:checked'),n=[];let i=e;for(;;){const e=i.nextElementSibling;if(!e)break;if(!this.isChildItem(e))break;n.push(e),i=e}"mega-menu"===t.value?(e.classList.add("h-mega-menu"),n.forEach(e=>{e.classList.add("h-mega-menu__child")})):(e.classList.remove("h-mega-menu"),n.forEach(e=>{e.classList.remove("h-mega-menu__child")}))},isChildItem:e=>e.classList.contains("menu-item-depth-1")||e.classList.contains("menu-item-depth-2")};document.addEventListener("DOMContentLoaded",(function(){i.init()})),window.addEventListener("load",(function(){}))},36:function(e,t,n){}});