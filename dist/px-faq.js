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
/******/ 	return __webpack_require__(__webpack_require__.s = "./module-block-faq/src/index.jsx");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./module-block-faq/src/edit.jsx":
/*!***************************************!*\
  !*** ./module-block-faq/src/edit.jsx ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ \"./node_modules/@babel/runtime/helpers/extends.js\");\n/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ \"@wordpress/element\");\n/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ \"@wordpress/block-editor\");\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ \"@wordpress/components\");\n/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);\n\n\n\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (function (props) {\n  var atts = props.attributes;\n  var blockProps = Object(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__[\"useBlockProps\"])();\n  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"Fragment\"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__[\"InspectorControls\"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__[\"PanelBody\"], {\n    title: \"Settings\",\n    initialOpen: true\n  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__[\"ToggleControl\"], {\n    label: \"Initially Open?\",\n    checked: atts.initiallyOpen,\n    onChange: function onChange(value) {\n      props.setAttributes({\n        initiallyOpen: value\n      });\n    }\n  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__[\"ToggleControl\"], {\n    label: \"No Index?\",\n    checked: atts.noIndex,\n    onChange: function onChange(value) {\n      props.setAttributes({\n        noIndex: value\n      });\n    }\n  }))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(\"div\", _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default()({}, blockProps, {\n    open: atts.initiallyOpen\n  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__[\"RichText\"], {\n    tagName: \"h4\",\n    className: \"px-block-faq__question\",\n    value: atts.question,\n    placeholder: \"Enter the Question...\",\n    onChange: function onChange(value) {\n      props.setAttributes({\n        question: value\n      });\n    }\n  }), atts.noIndex && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(\"span\", {\n    title: \"This FAQ is hidden from Google. Click here to disable noindex\",\n    className: \"dashicons-before dashicons-hidden\",\n    onClick: function onClick() {\n      props.setAttributes({\n        noIndex: false\n      });\n    }\n  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__[\"RichText\"], {\n    tagName: \"div\",\n    className: \"px-block-faq__answer\",\n    value: atts.answer,\n    multiline: \"p\",\n    placeholder: \"Enter the Answer...\",\n    onChange: function onChange(value) {\n      props.setAttributes({\n        answer: value\n      });\n    }\n  })));\n});\n\n//# sourceURL=webpack:///./module-block-faq/src/edit.jsx?");

/***/ }),

/***/ "./module-block-faq/src/index.jsx":
/*!****************************************!*\
  !*** ./module-block-faq/src/index.jsx ***!
  \****************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _style_sass__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./style.sass */ \"./module-block-faq/src/style.sass\");\n/* harmony import */ var _style_sass__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_style_sass__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/blocks */ \"@wordpress/blocks\");\n/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _edit_jsx__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit.jsx */ \"./module-block-faq/src/edit.jsx\");\n\n\n\nObject(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__[\"registerBlockType\"])('px/faq', {\n  edit: _edit_jsx__WEBPACK_IMPORTED_MODULE_2__[\"default\"]\n});\n\n//# sourceURL=webpack:///./module-block-faq/src/index.jsx?");

/***/ }),

/***/ "./module-block-faq/src/style.sass":
/*!*****************************************!*\
  !*** ./module-block-faq/src/style.sass ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// extracted by mini-css-extract-plugin\n\n//# sourceURL=webpack:///./module-block-faq/src/style.sass?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/extends.js":
/*!********************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/extends.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("function _extends() {\n  module.exports = _extends = Object.assign ? Object.assign.bind() : function (target) {\n    for (var i = 1; i < arguments.length; i++) {\n      var source = arguments[i];\n      for (var key in source) {\n        if (Object.prototype.hasOwnProperty.call(source, key)) {\n          target[key] = source[key];\n        }\n      }\n    }\n    return target;\n  }, module.exports.__esModule = true, module.exports[\"default\"] = module.exports;\n  return _extends.apply(this, arguments);\n}\nmodule.exports = _extends, module.exports.__esModule = true, module.exports[\"default\"] = module.exports;\n\n//# sourceURL=webpack:///./node_modules/@babel/runtime/helpers/extends.js?");

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("(function() { module.exports = window[\"wp\"][\"blockEditor\"]; }());\n\n//# sourceURL=webpack:///external_%5B%22wp%22,%22blockEditor%22%5D?");

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("(function() { module.exports = window[\"wp\"][\"blocks\"]; }());\n\n//# sourceURL=webpack:///external_%5B%22wp%22,%22blocks%22%5D?");

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("(function() { module.exports = window[\"wp\"][\"components\"]; }());\n\n//# sourceURL=webpack:///external_%5B%22wp%22,%22components%22%5D?");

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("(function() { module.exports = window[\"wp\"][\"element\"]; }());\n\n//# sourceURL=webpack:///external_%5B%22wp%22,%22element%22%5D?");

/***/ })

/******/ });