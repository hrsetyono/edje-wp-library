/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./module-comment/src/h-comment.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./module-comment/src/h-comment.js":
/*!*****************************************!*\
  !*** ./module-comment/src/h-comment.js ***!
  \*****************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _h_editor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./h-editor */ \"./module-comment/src/h-editor.js\");\n/* harmony import */ var _h_comment_sass__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./h-comment.sass */ \"./module-comment/src/h-comment.sass\");\n/* harmony import */ var _h_comment_sass__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_h_comment_sass__WEBPACK_IMPORTED_MODULE_1__);\n\r\n\r\n\r\n/**\r\n * Create hEditor instance\r\n */\r\nfunction hApplyEditor() {\r\n  const $textarea = document.querySelector('#comment');\r\n\r\n  if ($textarea) {\r\n    Object(_h_editor__WEBPACK_IMPORTED_MODULE_0__[\"default\"])($textarea, {\r\n      buttons: ['bold', 'italic', 'link', '|', 'bullist', 'numlist', 'code', 'pre', '|', 'undo'],\r\n    });\r\n  }\r\n}\r\n\r\ndocument.addEventListener('DOMContentLoaded', hApplyEditor);\r\n\n\n//# sourceURL=webpack:///./module-comment/src/h-comment.js?");

/***/ }),

/***/ "./module-comment/src/h-comment.sass":
/*!*******************************************!*\
  !*** ./module-comment/src/h-comment.sass ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// extracted by mini-css-extract-plugin\n\n//# sourceURL=webpack:///./module-comment/src/h-comment.sass?");

/***/ }),

/***/ "./module-comment/src/h-editor.js":
/*!****************************************!*\
  !*** ./module-comment/src/h-editor.js ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/**!\r\n * hEditor v1.1.2 | @license MIT\r\n * \r\n * Add Markdown toolbar to textarea that outputs Markdown syntax\r\n * \r\n *     hEditor( textarea, args );\r\n * \r\n * Get the CSS from https://github.com/hrsetyono/hEditor\r\n */\r\nfunction hEditor(a,b){'use strict';function c(a){let b=document.createElement('div');b.classList.add('h-editor__toolbar');let c='';for(let b of a){let a=h(b)?h(b):null;if('|'===b){c+='<span class=\"tool-separator\">|</span>';continue}else if(null===a)continue;let d=a.shortcut?`data-shortcut=\"${a.shortcut}\"`:'',e=a.title&&a.shortcut?`title=\"${a.title} (CTRL + ${a.shortcut.toUpperCase()})\"`:a.title?`title=\"${a.title}\"`:'',f=a.icon?a.icon:`<i>${a.title[0]}</i>`,g=a.label?`<span>${a.label}</span>`:'';c+=`<a class=\"tool-${b}\" data-tool=\"${b}\" ${d} ${e}>\r\n        ${f} ${g}\r\n      </a>`}return b.innerHTML=c,b}function d(b){b.preventDefault(),a.focus();let c=this.dataset.tool;if('undo'===c||'redo'===c)return void document.execCommand(c);let d=h(c),g={start:a.selectionStart,end:a.selectionEnd},j=a.value.substring(g.start,g.end),k=d.placeholder.trim();if(j!==k){if('link'===c||'image'===c){let a=prompt('image'===c?'Enter image URL':'Enter the URL','https://');if(!a)return;d.end=d.end.replace('URL',a)}if(g.start===g.end){let b=d.start+d.placeholder+d.end;d.isBlock&&''!==a.value.substring(0,g.start).split('\\n').pop()&&(b='\\n\\n'+b,g.end+=2),d.isBlock&&''!==a.value.substring(g.end).split('\\n')[0]&&(b+='\\n',i()&&(b+='\\n'));let c=0===g.start||' '===a.value.charAt(g.start-1);d.isBlock||c||(b=' '+b,g.end+=1),e(b,g),f(a,g.end+d.start.length,g.end+d.start.length+k.length)}else e(d.start+j+d.end,g);return!0}}function e(b,c){i()?a.value=a.value.substring(0,c.start)+b+a.value.substring(c.end):document.execCommand('insertText',!1,b)}function f(a,b,c){if(a.focus(),a.setSelectionRange)a.setSelectionRange(g(a,b),g(a,c));else if(a.createTextRange){var d=a.createTextRange();d.collapse(!0),d.moveEnd('character',c),d.moveStart('character',b),d.select()}let e=getComputedStyle(a).lineHeight,f=a.value.substring(0,a.selectionStart).split('\\n').length;a.scrollTop=e.replace('px','')*f}function g(a,b){let c=a.value,d=b;if(-1<c.indexOf('\\r\\n')){var e=c.replace(/\\r\\n/g,'\\n').slice(0,b).match(/\\n/g);d+=e?e.length:0}return d}function h(a){return{bold:{title:'Bold',shortcut:'b',start:'**',end:'**',placeholder:'Bolded text',icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 384 512\"><path d=\"M333.49 238a122 122 0 0 0 27-65.21C367.87 96.49 308 32 233.42 32H34a16 16 0 0 0-16 16v48a16 16 0 0 0 16 16h31.87v288H34a16 16 0 0 0-16 16v48a16 16 0 0 0 16 16h209.32c70.8 0 134.14-51.75 141-122.4 4.74-48.45-16.39-92.06-50.83-119.6zM145.66 112h87.76a48 48 0 0 1 0 96h-87.76zm87.76 288h-87.76V288h87.76a56 56 0 0 1 0 112z\"/></svg>'},italic:{title:'Italic',shortcut:'i',start:'*',end:'*',placeholder:'Italicized text',icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 320 512\"><path d=\"M320 48v32a16 16 0 0 1-16 16h-62.76l-80 320H208a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16H16a16 16 0 0 1-16-16v-32a16 16 0 0 1 16-16h62.76l80-320H112a16 16 0 0 1-16-16V48a16 16 0 0 1 16-16h192a16 16 0 0 1 16 16z\"/></svg>'},link:{title:'Link',shortcut:'l',start:'[',end:'](URL)',placeholder:'Link text',icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z\"/></svg>'},bullist:{title:'Bullet List',shortcut:'u',start:'- ',end:'',placeholder:'List Item',isBlock:!0,icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M48 48a48 48 0 1 0 48 48 48 48 0 0 0-48-48zm0 160a48 48 0 1 0 48 48 48 48 0 0 0-48-48zm0 160a48 48 0 1 0 48 48 48 48 0 0 0-48-48zm448 16H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z\"/></svg>'},numlist:{title:'Number List',shortcut:'o',start:'1. ',end:'',placeholder:'List Item',isBlock:!0,icon:'<svg  width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M61.77 401l17.5-20.15a19.92 19.92 0 0 0 5.07-14.19v-3.31C84.34 356 80.5 352 73 352H16a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h22.83a157.41 157.41 0 0 0-11 12.31l-5.61 7c-4 5.07-5.25 10.13-2.8 14.88l1.05 1.93c3 5.76 6.29 7.88 12.25 7.88h4.73c10.33 0 15.94 2.44 15.94 9.09 0 4.72-4.2 8.22-14.36 8.22a41.54 41.54 0 0 1-15.47-3.12c-6.49-3.88-11.74-3.5-15.6 3.12l-5.59 9.31c-3.72 6.13-3.19 11.72 2.63 15.94 7.71 4.69 20.38 9.44 37 9.44 34.16 0 48.5-22.75 48.5-44.12-.03-14.38-9.12-29.76-28.73-34.88zM496 224H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM16 160h64a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8H64V40a8 8 0 0 0-8-8H32a8 8 0 0 0-7.14 4.42l-8 16A8 8 0 0 0 24 64h8v64H16a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8zm-3.91 160H80a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8H41.32c3.29-10.29 48.34-18.68 48.34-56.44 0-29.06-25-39.56-44.47-39.56-21.36 0-33.8 10-40.46 18.75-4.37 5.59-3 10.84 2.8 15.37l8.58 6.88c5.61 4.56 11 2.47 16.12-2.44a13.44 13.44 0 0 1 9.46-3.84c3.33 0 9.28 1.56 9.28 8.75C51 248.19 0 257.31 0 304.59v4C0 316 5.08 320 12.09 320z\"/></svg>'},h1:{title:'Heading 1',shortcut:'1',start:'# ',end:'',placeholder:'Heading 1',isBlock:!0,icon:'<svg width=\"30px\" height=\"20px\"  xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 576 512\"><path d=\"M304 96h-98.94A13.06 13.06 0 0 0 192 109.06v37.88A13.06 13.06 0 0 0 205.06 160H224v64H96v-64h18.94A13.06 13.06 0 0 0 128 146.94V112a16 16 0 0 0-16-16H16a16 16 0 0 0-16 16v34.94A13.06 13.06 0 0 0 13.06 160H32v192H13.06A13.06 13.06 0 0 0 0 365.06V400a16 16 0 0 0 16 16h98.94A13.06 13.06 0 0 0 128 402.94v-37.88A13.06 13.06 0 0 0 114.94 352H96v-64h128v64h-18.94A13.06 13.06 0 0 0 192 365.06V400a16 16 0 0 0 16 16h96a16 16 0 0 0 16-16v-34.94A13.06 13.06 0 0 0 306.94 352H288V160h18.94A13.06 13.06 0 0 0 320 146.94V112a16 16 0 0 0-16-16zm256 256h-48V120a24 24 0 0 0-24-24h-40a24 24 0 0 0-21.44 13.26l-24 48A24 24 0 0 0 424 192h24v160h-48a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h160a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z\"/></svg>'},h2:{title:'Heading 2',shortcut:'2',start:'## ',end:'',placeholder:'Heading 2',isBlock:!0,icon:'<svg width=\"30px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 576 512\"><path d=\"M560 352H440.79c17-42.95 135.21-66.57 135.21-159.62C576 132.55 528.33 96 469.14 96c-43.83 0-81.41 21.38-103.42 57a15.66 15.66 0 0 0 4.75 21.4l28.26 18.6a16.15 16.15 0 0 0 21.86-3.83c10.77-14.86 24.94-26 43.85-26s38.22 10.46 38.22 33.84c0 52.18-142.1 73.21-142.1 184.56a155.06 155.06 0 0 0 1.71 20.66A15.94 15.94 0 0 0 378.14 416H560a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM304 96h-98.94A13.06 13.06 0 0 0 192 109.06v37.88A13.06 13.06 0 0 0 205.06 160H224v64H96v-64h18.94A13.06 13.06 0 0 0 128 146.94V112a16 16 0 0 0-16-16H16a16 16 0 0 0-16 16v34.94A13.06 13.06 0 0 0 13.06 160H32v192H13.06A13.06 13.06 0 0 0 0 365.06V400a16 16 0 0 0 16 16h98.94A13.06 13.06 0 0 0 128 402.94v-37.88A13.06 13.06 0 0 0 114.94 352H96v-64h128v64h-18.94A13.06 13.06 0 0 0 192 365.06V400a16 16 0 0 0 16 16h96a16 16 0 0 0 16-16v-34.94A13.06 13.06 0 0 0 306.94 352H288V160h18.94A13.06 13.06 0 0 0 320 146.94V112a16 16 0 0 0-16-16z\"/></svg>'},h3:{title:'Heading 3',shortcut:'1',start:'### ',end:'',placeholder:'Heading 3',isBlock:!0,icon:'<svg width=\"30px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 576 512\"><path d=\"M499 217.69l64.4-72.31a15.48 15.48 0 0 0 4-10.31v-23.32A16 16 0 0 0 551.12 96H384a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h85.18c-2.29 2.45-4.65 5-7.19 7.9l-53.1 61.1a18 18 0 0 0-3.83 10.17 18.36 18.36 0 0 0 1.38 6.34l8.41 18.59c2.35 5.21 9 9.42 14.84 9.42h15.95c28.94 0 57.79 10.32 57.79 38.48 0 21.32-19.93 36.79-47.39 36.79-22.08 0-41.18-9.17-57.7-22.83a16.46 16.46 0 0 0-23.87 3.34l-19.75 28.8a15.46 15.46 0 0 0 2.53 20.35C384.9 403.21 422 416 459.51 416c71 0 116.49-48.86 116.49-106.06 0-47.3-32.73-80.89-77-92.25zM304 96h-98.94A13.06 13.06 0 0 0 192 109.06v37.88A13.06 13.06 0 0 0 205.06 160H224v64H96v-64h18.94A13.06 13.06 0 0 0 128 146.94V112a16 16 0 0 0-16-16H16a16 16 0 0 0-16 16v34.94A13.06 13.06 0 0 0 13.06 160H32v192H13.06A13.06 13.06 0 0 0 0 365.06V400a16 16 0 0 0 16 16h98.94A13.06 13.06 0 0 0 128 402.94v-37.88A13.06 13.06 0 0 0 114.94 352H96v-64h128v64h-18.94A13.06 13.06 0 0 0 192 365.06V400a16 16 0 0 0 16 16h96a16 16 0 0 0 16-16v-34.94A13.06 13.06 0 0 0 306.94 352H288V160h18.94A13.06 13.06 0 0 0 320 146.94V112a16 16 0 0 0-16-16z\"/></svg>'},strike:{title:'Strikethrough',shortcut:'',start:'~~',end:'~~',placeholder:'Striked text',icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M496 224H293.9l-87.17-26.83A43.55 43.55 0 0 1 219.55 112h66.79A49.89 49.89 0 0 1 331 139.58a16 16 0 0 0 21.46 7.15l42.94-21.47a16 16 0 0 0 7.16-21.46l-.53-1A128 128 0 0 0 287.51 32h-68a123.68 123.68 0 0 0-123 135.64c2 20.89 10.1 39.83 21.78 56.36H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h480a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm-180.24 96A43 43 0 0 1 336 356.45 43.59 43.59 0 0 1 292.45 400h-66.79A49.89 49.89 0 0 1 181 372.42a16 16 0 0 0-21.46-7.15l-42.94 21.47a16 16 0 0 0-7.16 21.46l.53 1A128 128 0 0 0 224.49 480h68a123.68 123.68 0 0 0 123-135.64 114.25 114.25 0 0 0-5.34-24.36z\"/></svg>'},hr:{title:'Horizontal Line',shortcut:'',start:'',end:'',placeholder:'-----',isBlock:!0,icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 640 512\"><path d=\"M640 239.87v31.26A15.88 15.88 0 0 1 624.14 287H15.87A15.88 15.88 0 0 1 0 271.13v-31.26A15.88 15.88 0 0 1 15.87 224h608.27A15.88 15.88 0 0 1 640 239.87z\"/></svg>'},image:{title:'Image',shortcut:'g',start:'![',end:'](URL)',placeholder:'Add image description',isBlock:!0,icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 336H54a6 6 0 0 1-6-6V118a6 6 0 0 1 6-6h404a6 6 0 0 1 6 6v276a6 6 0 0 1-6 6zM128 152c-22.091 0-40 17.909-40 40s17.909 40 40 40 40-17.909 40-40-17.909-40-40-40zM96 352h320v-80l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L192 304l-39.515-39.515c-4.686-4.686-12.284-4.686-16.971 0L96 304v48z\"/></svg>'},quote:{title:'Quote',shortcut:'q',start:'> ',end:'',placeholder:'Quoted text',isBlock:!0,icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M464 32H336c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48zm-288 0H48C21.5 32 0 53.5 0 80v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48z\"/></svg>'},code:{title:'Code Inline',shortcut:'k',start:'`',end:'`',placeholder:'code',icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 640 512\"><path d=\"M278.9 511.5l-61-17.7c-6.4-1.8-10-8.5-8.2-14.9L346.2 8.7c1.8-6.4 8.5-10 14.9-8.2l61 17.7c6.4 1.8 10 8.5 8.2 14.9L293.8 503.3c-1.9 6.4-8.5 10.1-14.9 8.2zm-114-112.2l43.5-46.4c4.6-4.9 4.3-12.7-.8-17.2L117 256l90.6-79.7c5.1-4.5 5.5-12.3.8-17.2l-43.5-46.4c-4.5-4.8-12.1-5.1-17-.5L3.8 247.2c-5.1 4.7-5.1 12.8 0 17.5l144.1 135.1c4.9 4.6 12.5 4.4 17-.5zm327.2.6l144.1-135.1c5.1-4.7 5.1-12.8 0-17.5L492.1 112.1c-4.8-4.5-12.4-4.3-17 .5L431.6 159c-4.6 4.9-4.3 12.7.8 17.2L523 256l-90.6 79.7c-5.1 4.5-5.5 12.3-.8 17.2l43.5 46.4c4.5 4.9 12.1 5.1 17 .6z\"/></svg>'},pre:{title:'Code Block',label:'Block',start:'```\\n',end:'\\n```',placeholder:'Code block',isBlock:!0,icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 576 512\"><path d=\"M208 32h-48a96 96 0 0 0-96 96v37.48a32.06 32.06 0 0 1-9.38 22.65L9.37 233.37a32 32 0 0 0 0 45.26l45.25 45.25A32 32 0 0 1 64 346.51V384a96 96 0 0 0 96 96h48a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16h-48a32 32 0 0 1-32-32v-37.48a96 96 0 0 0-28.13-67.89L77.25 256l22.63-22.63A96 96 0 0 0 128 165.48V128a32 32 0 0 1 32-32h48a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zm358.63 201.37l-45.25-45.24a32.06 32.06 0 0 1-9.38-22.65V128a96 96 0 0 0-96-96h-48a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h48a32 32 0 0 1 32 32v37.47a96 96 0 0 0 28.13 67.91L498.75 256l-22.62 22.63A96 96 0 0 0 448 346.52V384a32 32 0 0 1-32 32h-48a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h48a96 96 0 0 0 96-96v-37.49a32 32 0 0 1 9.38-22.63l45.25-45.25a32 32 0 0 0 0-45.26z\"/></svg>'},undo:{title:'Undo',icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M8.309 189.836L184.313 37.851C199.719 24.546 224 35.347 224 56.015v80.053c160.629 1.839 288 34.032 288 186.258 0 61.441-39.581 122.309-83.333 154.132-13.653 9.931-33.111-2.533-28.077-18.631 45.344-145.012-21.507-183.51-176.59-185.742V360c0 20.7-24.3 31.453-39.687 18.164l-176.004-152c-11.071-9.562-11.086-26.753 0-36.328z\"/></svg>'},redo:{title:'Redo',icon:'<svg width=\"20px\" height=\"20px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M503.7,189.8l-176-152C312.3,24.5,288,35.3,288,56v80.1c-160.6,1.8-288,34-288,186.3c0,61.4,39.6,122.3,83.3,154.1 c13.7,9.9,33.1-2.5,28.1-18.6c-45.3-145,21.5-183.5,176.6-185.7V360c0,20.7,24.3,31.5,39.7,18.2l176-152 C514.8,216.6,514.8,199.4,503.7,189.8z\"/></svg>'}}[a]}function i(){return'undefined'!=typeof InstallTrigger}b=Object.assign({buttons:['bold','italic','link','|','bullist','numlist','image','quote']},b);let j=document.createElement('div');j.classList.add('h-editor');let k=c(b.buttons);a.parentNode.insertBefore(j,a),j.appendChild(k),j.appendChild(a),a.addEventListener('keydown',function(a){if(a.ctrlKey){let b=String.fromCharCode(a.keyCode).toLowerCase(),c=document.querySelector(`a[data-shortcut=\"${b}\"]`);c&&c.click()}});let l=j.querySelectorAll('a');for(let c of l)c.addEventListener('click',d)}\r\n\r\n/* harmony default export */ __webpack_exports__[\"default\"] = (hEditor);\n\n//# sourceURL=webpack:///./module-comment/src/h-editor.js?");

/***/ })

/******/ });