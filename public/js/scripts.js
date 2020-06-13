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

/***/ "./resources/gull/assets/styles/sass/themes/palmera-vacations.scss":
/*!*************************************************************************!*\
  !*** ./resources/gull/assets/styles/sass/themes/palmera-vacations.scss ***!
  \*************************************************************************/
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
/* harmony import */ var _scripts_initCalendar_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./scripts/initCalendar.js */ "./resources/js/scripts/initCalendar.js");
/* harmony import */ var _scripts_initDatepickerComponents_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./scripts/initDatepickerComponents.js */ "./resources/js/scripts/initDatepickerComponents.js");
/* harmony import */ var _scripts_initFastSelectComponents_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./scripts/initFastSelectComponents.js */ "./resources/js/scripts/initFastSelectComponents.js");
/* harmony import */ var _scripts_initMapInputComponents_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./scripts/initMapInputComponents.js */ "./resources/js/scripts/initMapInputComponents.js");
/* harmony import */ var _scripts_initTimepickerComponents_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./scripts/initTimepickerComponents.js */ "./resources/js/scripts/initTimepickerComponents.js");







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
    Object(_scripts_initCalendar_js__WEBPACK_IMPORTED_MODULE_2__["initCalendar"])();
    Object(_scripts_initDatepickerComponents_js__WEBPACK_IMPORTED_MODULE_3__["initDatepickerComponents"])();
    Object(_scripts_initFastSelectComponents_js__WEBPACK_IMPORTED_MODULE_4__["initFastSelectComponents"])();
    Object(_scripts_initMapInputComponents_js__WEBPACK_IMPORTED_MODULE_5__["initMapInputComponents"])();
    Object(_scripts_initTimepickerComponents_js__WEBPACK_IMPORTED_MODULE_6__["initTimepickerComponents"])();
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

/***/ "./resources/js/scripts/initCalendar.js":
/*!**********************************************!*\
  !*** ./resources/js/scripts/initCalendar.js ***!
  \**********************************************/
/*! exports provided: initCalendar */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initCalendar", function() { return initCalendar; });
function initCalendar() {
  var newDate = new Date(),
      date = newDate.getDate(),
      month = newDate.getMonth(),
      year = newDate.getFullYear();
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    themeSystem: "bootstrap4",
    disableDragging: true,
    eventRender: function eventRender(event, element) {
      var status = event.status ? "<i class='nav-icon i-Yes font-weight-bold text-success'></i>" : "<i class='nav-icon i-Close font-weight-bold text-danger'></i>";
      element.find('.fc-title').html("<div class='status-event'>" + status + "</div>" + " " + event.title);
    },
    events: [{
      title: "Project name here",
      start: new Date(year, month, 1),
      color: "#ffc107",
      status: true
    }, {
      title: "Office Hour",
      start: new Date(year, month, 3)
    }, {
      title: "Work on a Project",
      start: new Date(year, month, 9),
      end: new Date(year, month, 12),
      allDay: !0,
      color: "#d22346",
      status: false
    }, {
      title: "Work on a Project",
      start: new Date(year, month, 17),
      end: new Date(year, month, 19),
      allDay: !0,
      color: "#d22346",
      status: true
    }, {
      id: 999,
      title: "Go to Long Drive",
      start: new Date(year, month, date - 1, 15, 0),
      status: true
    }, {
      id: 999,
      title: "Go to Long Drive",
      start: new Date(year, month, date + 3, 15, 0),
      status: true
    }, {
      title: "Work on a New Project",
      start: new Date(year, month, date - 3),
      end: new Date(year, month, date - 3),
      allDay: !0,
      color: "#ffc107",
      status: false
    }, {
      title: "Food ",
      start: new Date(year, month, date + 7, 15, 0),
      color: "#4caf50",
      status: false
    }, {
      title: "Go to Library",
      start: new Date(year, month, date, 8, 0),
      end: new Date(year, month, date, 14, 0),
      color: "#ffc107",
      status: false
    }, {
      title: "Go for Walk",
      start: new Date(year, month, 25),
      end: new Date(year, month, 27),
      allDay: !0,
      color: "#ffc107",
      status: false
    }, {
      title: "Work on a Project",
      start: new Date(year, month, date + 8, 20, 0),
      end: new Date(year, month, date + 8, 22, 0),
      status: true
    }]
  });
}

/***/ }),

/***/ "./resources/js/scripts/initDatepickerComponents.js":
/*!**********************************************************!*\
  !*** ./resources/js/scripts/initDatepickerComponents.js ***!
  \**********************************************************/
/*! exports provided: initDatepickerComponents */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initDatepickerComponents", function() { return initDatepickerComponents; });
function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }

  return obj;
}

function initDatepickerComponents() {
  $('.app-input-datepicker').each(function () {
    var _$$pickadate;

    var dateFormat = $(this).data('format');
    var maxDaysLimitFromNow = $(this).data('max-days-limit-from-now');
    var maxSelectionDate = new Date();
    maxSelectionDate.setDate(maxSelectionDate.getDate() + parseInt(maxDaysLimitFromNow));
    $(this).pickadate((_$$pickadate = {
      selectYears: true
    }, _defineProperty(_$$pickadate, "selectYears", 70), _defineProperty(_$$pickadate, "selectMonths", true), _defineProperty(_$$pickadate, "format", dateFormat), _defineProperty(_$$pickadate, "formatSubmit", dateFormat), _defineProperty(_$$pickadate, "max", maxSelectionDate), _$$pickadate));
  });
}

/***/ }),

/***/ "./resources/js/scripts/initFastSelectComponents.js":
/*!**********************************************************!*\
  !*** ./resources/js/scripts/initFastSelectComponents.js ***!
  \**********************************************************/
/*! exports provided: initFastSelectComponents */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initFastSelectComponents", function() { return initFastSelectComponents; });
function initFastSelectComponents(className) {
  $(".app-fast-select").each(function () {
    var elem = $(this);
    var placeholder = elem.data('placeholder');
    elem.fastselect({
      placeholder: placeholder
    });
  });
}

/***/ }),

/***/ "./resources/js/scripts/initMapInputComponents.js":
/*!********************************************************!*\
  !*** ./resources/js/scripts/initMapInputComponents.js ***!
  \********************************************************/
/*! exports provided: initMapInputComponents */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initMapInputComponents", function() { return initMapInputComponents; });
function initMapInputComponents() {
  var maps = $('.app-map-wrapper');

  function placeMarker(event, marker, map) {
    if (marker) {
      marker.setPosition(event.latLng);
    } else {
      marker = new google.maps.Marker({
        position: event.latLng,
        map: map,
        draggable: true
      });
    }

    marker.setMap(map);
    map.panTo(event.latLng);
  }

  function fillInputs(event, latitudeInput, longitudeInput) {
    latitudeInput.val(event.latLng.lat());
    longitudeInput.val(event.latLng.lng());
  }

  if (maps.length) {
    maps.each(function () {
      var container = $(this);
      var mapWrapper = container.find('.app-google-map');
      var mapResetBtn = container.find('.app-google-clear-map');
      var marker;
      var mapId = mapWrapper.data('map-id');
      var mapElem = document.getElementById(mapId);
      var latitudeInput = container.find('.latitude-wrapper input');
      var longitudeInput = container.find('.longitude-wrapper input');
      var dataLat = mapWrapper.data('lat');
      var dataLng = mapWrapper.data('lng');
      var position = {
        lat: dataLat || 20.666155,
        lng: dataLng || -105.251954
      };
      var map = new google.maps.Map(mapElem, {
        center: position,
        zoom: 12,
        disableDefaultUI: true,
        fullscreenControl: false
      });

      if (dataLat && dataLng) {
        marker = new google.maps.Marker({
          position: position,
          map: map,
          draggable: true
        });
      }

      if (mapResetBtn.length) {
        mapResetBtn.on('click', function () {
          marker.setMap(null);
          latitudeInput.val('');
          longitudeInput.val('');
        });
      }

      google.maps.event.addListener(map, 'click', function (e) {
        placeMarker(e, marker, map);
        fillInputs(e, latitudeInput, longitudeInput);
      });
      google.maps.event.addListener(marker, 'dragend', function (e) {
        placeMarker(e, marker, map);
        fillInputs(e, latitudeInput, longitudeInput);
      });
    });
  }
}

/***/ }),

/***/ "./resources/js/scripts/initTimepickerComponents.js":
/*!**********************************************************!*\
  !*** ./resources/js/scripts/initTimepickerComponents.js ***!
  \**********************************************************/
/*! exports provided: initTimepickerComponents */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initTimepickerComponents", function() { return initTimepickerComponents; });
function initTimepickerComponents() {
  $('.app-input-timepicker').each(function () {
    var input = $(this);
    var timeFormat = input.data('time-format');
    var timeInterval = input.data('time-interval');
    input.timepicker({
      timeFormat: timeFormat,
      interval: timeInterval,
      minTime: '00:00',
      maxTime: '23:59',
      startTime: '00:00',
      dynamic: false,
      dropdown: true,
      scrollbar: true
    });
  });
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
/*!***********************************************************************************************************************************!*\
  !*** multi ./resources/js/scripts.js ./resources/sass/app.scss ./resources/gull/assets/styles/sass/themes/palmera-vacations.scss ***!
  \***********************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Applications/MAMP/htdocs/me/pm-app/resources/js/scripts.js */"./resources/js/scripts.js");
__webpack_require__(/*! /Applications/MAMP/htdocs/me/pm-app/resources/sass/app.scss */"./resources/sass/app.scss");
module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/me/pm-app/resources/gull/assets/styles/sass/themes/palmera-vacations.scss */"./resources/gull/assets/styles/sass/themes/palmera-vacations.scss");


/***/ })

/******/ });