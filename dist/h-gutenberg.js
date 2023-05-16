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
/******/ 	return __webpack_require__(__webpack_require__.s = "./module-gutenberg/src/h-gutenberg.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./module-gutenberg/src/h-cover-mobile.jsx":
/*!*************************************************!*\
  !*** ./module-gutenberg/src/h-cover-mobile.jsx ***!
  \*************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/defineProperty */ \"./node_modules/@babel/runtime/helpers/defineProperty.js\");\n/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ \"@wordpress/element\");\n/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _wordpress_hooks__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/hooks */ \"@wordpress/hooks\");\n/* harmony import */ var _wordpress_hooks__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_hooks__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/compose */ \"@wordpress/compose\");\n/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/block-editor */ \"@wordpress/block-editor\");\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__);\n/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/components */ \"@wordpress/components\");\n/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__);\n\n\nfunction ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }\nfunction _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0___default()(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }\n\n\n\n\n\n\n/**\r\n * Add extra attribute to Cover block for the mobile image\r\n */\nObject(_wordpress_hooks__WEBPACK_IMPORTED_MODULE_2__[\"addFilter\"])('blocks.registerBlockType', 'extend-cover/attributes', function (settings, name) {\n  // Do nothing if it's another block than our defined ones.\n  if (!['core/cover'].includes(name)) {\n    return settings;\n  }\n  settings.attributes = _objectSpread(_objectSpread({}, settings.attributes), {}, {\n    hMobileMediaID: {\n      type: 'number'\n    },\n    hMobileMediaURL: {\n      type: 'string'\n    },\n    hMobileHeight: {\n      type: 'string',\n      default: '400px'\n    }\n  });\n  return settings;\n});\n\n/**\r\n * Add a new setting in Inspector to upload mobile image\r\n */\nvar addControl = Object(_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__[\"createHigherOrderComponent\"])(function (BlockEdit) {\n  return function (props) {\n    // Do nothing if it's another block than our defined ones.\n    if (!['core/cover'].includes(props.name)) {\n      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(BlockEdit, props);\n    }\n    var atts = props.attributes;\n    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"Fragment\"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(BlockEdit, props), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__[\"InspectorControls\"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__[\"PanelBody\"], {\n      title: \"Mobile Cover\",\n      initialOpen: \"true\"\n    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__[\"__experimentalUnitControl\"], {\n      id: \"block-cover-mobile-height-input-\".concat(Object(_wordpress_compose__WEBPACK_IMPORTED_MODULE_3__[\"useInstanceId\"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__[\"__experimentalUnitControl\"])),\n      label: \"Mobile Height\",\n      value: atts.hMobileHeight,\n      onChange: function onChange(newValue) {\n        props.setAttributes({\n          hMobileHeight: newValue\n        });\n      },\n      isResetValueOnUnitChange: true,\n      __unstableInputWidth: '80px'\n    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(\"p\", null, \"\\xA0\"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(\"p\", null, \"Leave empty to use the primary image in mobile.\"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(\"div\", null, atts.hMobileMediaURL && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(\"img\", {\n      src: atts.hMobileMediaURL\n    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_4__[\"MediaUpload\"], {\n      allowedTypes: \"image\",\n      value: atts.hMobileMediaID,\n      onSelect: function onSelect(media) {\n        props.setAttributes({\n          hMobileMediaID: media.id,\n          hMobileMediaURL: media.url\n        });\n      },\n      render: _renderImageButton\n    })))));\n\n    /**\r\n     * Render image upload button in sidebar\r\n     */\n    function _renderImageButton(obj) {\n      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"Fragment\"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__[\"Button\"], {\n        className: \"button\",\n        onClick: obj.open\n      }, atts.hMobileMediaID ? 'Change image' : 'Upload image'), atts.hMobileMediaID && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__[\"createElement\"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__[\"Button\"], {\n        onClick: function onClick() {\n          props.setAttributes({\n            hMobileMediaURL: null,\n            hMobileMediaID: null\n          });\n        }\n      }, \"Remove\"));\n    }\n  };\n}, 'withInspectorControl');\nObject(_wordpress_hooks__WEBPACK_IMPORTED_MODULE_2__[\"addFilter\"])('editor.BlockEdit', 'extend-cover/edit', addControl);\n\n//# sourceURL=webpack:///./module-gutenberg/src/h-cover-mobile.jsx?");

/***/ }),

/***/ "./module-gutenberg/src/h-gutenberg.js":
/*!*********************************************!*\
  !*** ./module-gutenberg/src/h-gutenberg.js ***!
  \*********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _h_gutenberg_sass__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./h-gutenberg.sass */ \"./module-gutenberg/src/h-gutenberg.sass\");\n/* harmony import */ var _h_gutenberg_sass__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_h_gutenberg_sass__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _h_cover_mobile_jsx__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./h-cover-mobile.jsx */ \"./module-gutenberg/src/h-cover-mobile.jsx\");\n\r\n\r\n\r\nconst { wp } = window;\r\n\r\nwp.domReady(() => {\r\n  wp.blocks.unregisterBlockStyle('core/quote', 'plain');\r\n\r\n  window.localizeH.disallowedBlocks.forEach((name) => {\r\n    wp.blocks.unregisterBlockType(name);\r\n  });\r\n\r\n  // Disable useless Group variation\r\n  wp.blocks.unregisterBlockVariation('core/group', 'group-stack');\r\n});\r\n\r\n// Modify settings for Core blocks\r\nwp.hooks.addFilter('blocks.registerBlockType', 'h/set_default_alignment', (settings, name) => {\r\n  switch (name) {\r\n    // Paragraph and List is allowed to use wide alignment\r\n    case 'core/paragraph':\r\n    case 'core/list':\r\n    case 'core/gallery':\r\n    case 'core/code':\r\n    case 'core/verse':\r\n    case 'core/preformatted':\r\n    case 'core/table':\r\n    case 'core/pullquote':\r\n    case 'core/heading':\r\n      settings.supports = {\r\n        ...settings.supports,\r\n        align: ['wide'],\r\n      };\r\n      break;\r\n\r\n    case 'core/separator':\r\n      settings.supports = {\r\n        ...settings.supports,\r\n        align: ['wide'],\r\n      };\r\n      break;\r\n\r\n    // Remove align left and right\r\n    case 'core/file':\r\n    case 'core/audio':\r\n      settings.supports = {\r\n        ...settings.supports,\r\n        align: [],\r\n      };\r\n      break;\r\n\r\n    // only allow center\r\n    case 'core/social-links':\r\n      settings.supports = {\r\n        ...settings.supports,\r\n        align: ['center'],\r\n      };\r\n      break;\r\n\r\n    // Columns default is now wide\r\n    case 'core/columns':\r\n      settings.supports = {\r\n        ...settings.supports,\r\n        align: ['wide'],\r\n      };\r\n\r\n      settings.attributes = {\r\n        ...settings.attributes,\r\n        align: {\r\n          type: 'string',\r\n          default: 'wide',\r\n        },\r\n      };\r\n      break;\r\n\r\n    // Remove layout setting in Child Column\r\n    case 'core/column':\r\n      settings.supports = {\r\n        ...settings.supports,\r\n        __experimentalLayout: false,\r\n      };\r\n      break;\r\n\r\n    case 'core/button':\r\n      settings.supports = {\r\n        ...settings.supports,\r\n        __experimentalBorder: false,\r\n      };\r\n      break;\r\n\r\n    // Group defaults to full and remove the Justification\r\n    case 'core/group':\r\n      settings.supports = {\r\n        ...settings.supports,\r\n        // __experimentalLayout: false,\r\n      };\r\n\r\n      settings.attributes = {\r\n        ...settings.attributes,\r\n        align: {\r\n          type: 'string',\r\n          default: 'full',\r\n        },\r\n        layout: {\r\n          type: [Object],\r\n          default: { inherit: true },\r\n        },\r\n      };\r\n      break;\r\n\r\n    // Cover defaults to Full\r\n    case 'core/cover':\r\n      settings.attributes = {\r\n        ...settings.attributes,\r\n        align: {\r\n          type: 'string',\r\n          default: 'full',\r\n        },\r\n      };\r\n      break;\r\n\r\n    default:\r\n      break;\r\n  }\r\n\r\n  // SPACING SETTINGS\r\n  if (!settings.supports) {\r\n    settings.supports = {};\r\n  }\r\n\r\n  switch (name) {\r\n    // Has both padding and margin\r\n    case 'core/group':\r\n    case 'core/columns':\r\n    case 'core/cover':\r\n      settings.supports.spacing = {\r\n        ...settings.supports.spacing,\r\n        margin: ['top', 'bottom'],\r\n        __experimentalDefaultControls: {\r\n          padding: true,\r\n          margin: true,\r\n        },\r\n      };\r\n      break;\r\n\r\n    // Has hidden margin and padding\r\n    case 'core/paragraph':\r\n    case 'core/list':\r\n    case 'core/gallery':\r\n    case 'core/code':\r\n    case 'core/verse':\r\n    case 'core/preformatted':\r\n    case 'core/table':\r\n      settings.supports.spacing = {\r\n        ...settings.supports.spacing,\r\n        padding: true,\r\n        margin: ['top', 'bottom'],\r\n        // __experimentalDefaultControls: {\r\n        //   margin: true,\r\n        // },\r\n      };\r\n      break;\r\n\r\n    // Only margin\r\n    case 'core/heading':\r\n    case 'core/quote':\r\n    case 'core/buttons':\r\n    case 'core/separator':\r\n    case 'core/image':\r\n    case 'core/latest-posts':\r\n      settings.supports.spacing = {\r\n        ...settings.supports.spacing,\r\n        padding: false,\r\n        margin: ['top', 'bottom'],\r\n        // __experimentalDefaultControls: {\r\n        //   margin: true,\r\n        // },\r\n      };\r\n      break;\r\n\r\n    // Only padding\r\n    case 'core/column':\r\n      settings.supports.spacing = {\r\n        ...settings.supports.spacing,\r\n        padding: true,\r\n        margin: false,\r\n        // __experimentalDefaultControls: {\r\n        //   padding: true,\r\n        // },\r\n      };\r\n      break;\r\n\r\n    default:\r\n      // do nothing\r\n      break;\r\n  }\r\n\r\n  // FONT SIZE Settings\r\n  switch (name) {\r\n    case 'core/paragraph':\r\n    case 'core/list':\r\n      settings.supports.typography = {\r\n        ...settings.supports.typography,\r\n        fontSize: true,\r\n      };\r\n      break;\r\n\r\n    default:\r\n      settings.supports.typography = false;\r\n      break;\r\n  }\r\n\r\n  return settings;\r\n});\r\n\n\n//# sourceURL=webpack:///./module-gutenberg/src/h-gutenberg.js?");

/***/ }),

/***/ "./module-gutenberg/src/h-gutenberg.sass":
/*!***********************************************!*\
  !*** ./module-gutenberg/src/h-gutenberg.sass ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// extracted by mini-css-extract-plugin\n\n//# sourceURL=webpack:///./module-gutenberg/src/h-gutenberg.sass?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/defineProperty.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/defineProperty.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("var toPropertyKey = __webpack_require__(/*! ./toPropertyKey.js */ \"./node_modules/@babel/runtime/helpers/toPropertyKey.js\");\nfunction _defineProperty(obj, key, value) {\n  key = toPropertyKey(key);\n  if (key in obj) {\n    Object.defineProperty(obj, key, {\n      value: value,\n      enumerable: true,\n      configurable: true,\n      writable: true\n    });\n  } else {\n    obj[key] = value;\n  }\n  return obj;\n}\nmodule.exports = _defineProperty, module.exports.__esModule = true, module.exports[\"default\"] = module.exports;\n\n//# sourceURL=webpack:///./node_modules/@babel/runtime/helpers/defineProperty.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/toPrimitive.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/toPrimitive.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("var _typeof = __webpack_require__(/*! ./typeof.js */ \"./node_modules/@babel/runtime/helpers/typeof.js\")[\"default\"];\nfunction _toPrimitive(input, hint) {\n  if (_typeof(input) !== \"object\" || input === null) return input;\n  var prim = input[Symbol.toPrimitive];\n  if (prim !== undefined) {\n    var res = prim.call(input, hint || \"default\");\n    if (_typeof(res) !== \"object\") return res;\n    throw new TypeError(\"@@toPrimitive must return a primitive value.\");\n  }\n  return (hint === \"string\" ? String : Number)(input);\n}\nmodule.exports = _toPrimitive, module.exports.__esModule = true, module.exports[\"default\"] = module.exports;\n\n//# sourceURL=webpack:///./node_modules/@babel/runtime/helpers/toPrimitive.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/toPropertyKey.js":
/*!**************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/toPropertyKey.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("var _typeof = __webpack_require__(/*! ./typeof.js */ \"./node_modules/@babel/runtime/helpers/typeof.js\")[\"default\"];\nvar toPrimitive = __webpack_require__(/*! ./toPrimitive.js */ \"./node_modules/@babel/runtime/helpers/toPrimitive.js\");\nfunction _toPropertyKey(arg) {\n  var key = toPrimitive(arg, \"string\");\n  return _typeof(key) === \"symbol\" ? key : String(key);\n}\nmodule.exports = _toPropertyKey, module.exports.__esModule = true, module.exports[\"default\"] = module.exports;\n\n//# sourceURL=webpack:///./node_modules/@babel/runtime/helpers/toPropertyKey.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/typeof.js":
/*!*******************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/typeof.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("function _typeof(obj) {\n  \"@babel/helpers - typeof\";\n\n  return (module.exports = _typeof = \"function\" == typeof Symbol && \"symbol\" == typeof Symbol.iterator ? function (obj) {\n    return typeof obj;\n  } : function (obj) {\n    return obj && \"function\" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? \"symbol\" : typeof obj;\n  }, module.exports.__esModule = true, module.exports[\"default\"] = module.exports), _typeof(obj);\n}\nmodule.exports = _typeof, module.exports.__esModule = true, module.exports[\"default\"] = module.exports;\n\n//# sourceURL=webpack:///./node_modules/@babel/runtime/helpers/typeof.js?");

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("(function() { module.exports = window[\"wp\"][\"blockEditor\"]; }());\n\n//# sourceURL=webpack:///external_%5B%22wp%22,%22blockEditor%22%5D?");

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("(function() { module.exports = window[\"wp\"][\"components\"]; }());\n\n//# sourceURL=webpack:///external_%5B%22wp%22,%22components%22%5D?");

/***/ }),

/***/ "@wordpress/compose":
/*!*********************************!*\
  !*** external ["wp","compose"] ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("(function() { module.exports = window[\"wp\"][\"compose\"]; }());\n\n//# sourceURL=webpack:///external_%5B%22wp%22,%22compose%22%5D?");

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("(function() { module.exports = window[\"wp\"][\"element\"]; }());\n\n//# sourceURL=webpack:///external_%5B%22wp%22,%22element%22%5D?");

/***/ }),

/***/ "@wordpress/hooks":
/*!*******************************!*\
  !*** external ["wp","hooks"] ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("(function() { module.exports = window[\"wp\"][\"hooks\"]; }());\n\n//# sourceURL=webpack:///external_%5B%22wp%22,%22hooks%22%5D?");

/***/ })

/******/ });