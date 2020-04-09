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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/gull/assets/styles/sass/themes/dark-purple.scss":
/*!*******************************************************************!*\
  !*** ./resources/gull/assets/styles/sass/themes/dark-purple.scss ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/gull/assets/styles/sass/themes/lite-blue.scss":
/*!*****************************************************************!*\
  !*** ./resources/gull/assets/styles/sass/themes/lite-blue.scss ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/gull/assets/styles/sass/themes/lite-purple.scss":
/*!*******************************************************************!*\
  !*** ./resources/gull/assets/styles/sass/themes/lite-purple.scss ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/js/scripts.js":
/*!*********************************!*\
  !*** ./resources/js/scripts.js ***!
  \*********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _scripts_getViewport_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scripts/getViewport.js */ "./resources/js/scripts/getViewport.js");
/* harmony import */ var _scripts_handleMenuFit_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./scripts/handleMenuFit.js */ "./resources/js/scripts/handleMenuFit.js");


$(function () {
  /////////////////////////////
  /////////////////////////////
  var viewport = {
    x: 0,
    y: 0
  }; /////////////////////////////
  /////////////////////////////

  function init() {
    $(window).resize(resize);
    Object(_scripts_handleMenuFit_js__WEBPACK_IMPORTED_MODULE_1__["handleMenuFit"])();
  }

  function resize() {
    viewport = Object(_scripts_getViewport_js__WEBPACK_IMPORTED_MODULE_0__["getViewport"])();
    Object(_scripts_handleMenuFit_js__WEBPACK_IMPORTED_MODULE_1__["handleMenuFit"])();
  } /////////////////////////////
  /////////////////////////////


  init(); /////////////////////////////
  /////////////////////////////
});

/***/ }),

/***/ "./resources/js/scripts/getViewport.js":
/*!*********************************************!*\
  !*** ./resources/js/scripts/getViewport.js ***!
  \*********************************************/
/*! exports provided: getViewport */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getViewport", function() { return getViewport; });
function getViewport() {
  var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
  var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
  return {
    w: w,
    h: h
  };
}

/***/ }),

/***/ "./resources/js/scripts/handleMenuFit.js":
/*!***********************************************!*\
  !*** ./resources/js/scripts/handleMenuFit.js ***!
  \***********************************************/
/*! exports provided: handleMenuFit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "handleMenuFit", function() { return handleMenuFit; });
/* harmony import */ var _isViewport_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./isViewport.js */ "./resources/js/scripts/isViewport.js");

function handleMenuFit() {
  var menu = $("#app-menu");
  var dinamicLiWrapper = menu.find("#app-menu-fit-li");
  var shouldResize = false;

  var getLimitWidth = function getLimitWidth() {
    var menuPaddingRight = parseInt(menu.css("padding-right"), 10);
    var negativeOffset = 120;
    return menu.outerWidth() - menuPaddingRight - negativeOffset;
  };

  var getChildsWidth = function getChildsWidth(liOptions) {
    var optionsWidth = 0;
    liOptions = liOptions || getMenuOptions();
    liOptions.each(function () {
      var li = $(this);
      optionsWidth += li.outerWidth();
    });
    return optionsWidth;
  };

  var getMenuOptions = function getMenuOptions(popLength) {
    var options = menu.find("> li").not(dinamicLiWrapper);

    if (popLength) {
      for (var i = 0; i < popLength; i++) {
        options.splice(options.length - 1, 1);
      }
    }

    return options;
  };

  var shouldResize = function shouldResize() {
    resetMenu();
    var widthResult = getLimitWidth() - getChildsWidth();
    return widthResult < 0;
  };

  var resetMenu = function resetMenu() {
    dinamicLiWrapper.find("ul").html("");
    dinamicLiWrapper.hide();
    menu.find("> li").not(dinamicLiWrapper).show();
  };

  var fitMenu = function fitMenu(popMenuLength) {
    popMenuLength = popMenuLength || 1;
    var options = getMenuOptions(popMenuLength);
    var optionsWidth = 0;
    options.each(function () {
      var li = $(this);
      optionsWidth += li.outerWidth();
    });
    var widthResult = getLimitWidth() - optionsWidth;
    var shouldPopOption = widthResult < 0;

    if (shouldPopOption) {
      fitMenu(popMenuLength + 1);
    } else {
      var floatOptions = [];
      var optionsLength = menu.find("> li").not(dinamicLiWrapper).length;

      for (var i = 0; i < popMenuLength; i++) {
        var index = optionsLength - i - 1;
        var item = menu.find("> li").not(dinamicLiWrapper).eq(index);
        var clonedOption = item.clone();
        item.hide();
        floatOptions.push(clonedOption);
      }

      floatOptions = floatOptions.reverse();

      for (var i = 0; i < floatOptions.length; i++) {
        dinamicLiWrapper.find("ul").html("");
        dinamicLiWrapper.find("ul").append(floatOptions);
      }

      dinamicLiWrapper.show();
    }
  };

  if (!Object(_isViewport_js__WEBPACK_IMPORTED_MODULE_0__["isViewport"])("medium") && shouldResize()) {
    fitMenu();
  } else {
    resetMenu();
  }
}

/***/ }),

/***/ "./resources/js/scripts/isViewport.js":
/*!********************************************!*\
  !*** ./resources/js/scripts/isViewport.js ***!
  \********************************************/
/*! exports provided: isViewport */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "isViewport", function() { return isViewport; });
/* harmony import */ var _getViewport_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./getViewport.js */ "./resources/js/scripts/getViewport.js");

function isViewport(size) {
  var viewport = Object(_getViewport_js__WEBPACK_IMPORTED_MODULE_0__["getViewport"])();

  if (size == "medium") {
    return viewport.w <= 767;
  }

  return null;
}

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/scripts.js ./resources/sass/app.scss ./resources/gull/assets/styles/sass/themes/lite-purple.scss ./resources/gull/assets/styles/sass/themes/lite-blue.scss ./resources/gull/assets/styles/sass/themes/dark-purple.scss ***!
  \***************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Applications/MAMP/htdocs/me/pm-app/resources/js/scripts.js */"./resources/js/scripts.js");
__webpack_require__(/*! /Applications/MAMP/htdocs/me/pm-app/resources/sass/app.scss */"./resources/sass/app.scss");
__webpack_require__(/*! /Applications/MAMP/htdocs/me/pm-app/resources/gull/assets/styles/sass/themes/lite-purple.scss */"./resources/gull/assets/styles/sass/themes/lite-purple.scss");
__webpack_require__(/*! /Applications/MAMP/htdocs/me/pm-app/resources/gull/assets/styles/sass/themes/lite-blue.scss */"./resources/gull/assets/styles/sass/themes/lite-blue.scss");
module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/me/pm-app/resources/gull/assets/styles/sass/themes/dark-purple.scss */"./resources/gull/assets/styles/sass/themes/dark-purple.scss");


/***/ })

/******/ });