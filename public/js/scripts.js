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
/* harmony import */ var _scripts_initConfirmClick_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scripts/initConfirmClick.js */ "./resources/js/scripts/initConfirmClick.js");
/* harmony import */ var _scripts_getViewport_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./scripts/getViewport.js */ "./resources/js/scripts/getViewport.js");
/* harmony import */ var _scripts_handleMenuFit_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./scripts/handleMenuFit.js */ "./resources/js/scripts/handleMenuFit.js");
/* harmony import */ var _scripts_initCalendar_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./scripts/initCalendar.js */ "./resources/js/scripts/initCalendar.js");
/* harmony import */ var _scripts_getBonus_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./scripts/getBonus.js */ "./resources/js/scripts/getBonus.js");
/* harmony import */ var _scripts_initDatepickerComponents_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./scripts/initDatepickerComponents.js */ "./resources/js/scripts/initDatepickerComponents.js");
/* harmony import */ var _scripts_initFastSelectComponents_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./scripts/initFastSelectComponents.js */ "./resources/js/scripts/initFastSelectComponents.js");
/* harmony import */ var _scripts_initGetPmPropertySelectionEvent_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./scripts/initGetPmPropertySelectionEvent.js */ "./resources/js/scripts/initGetPmPropertySelectionEvent.js");
/* harmony import */ var _scripts_initTransactionCheckboxHandler_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./scripts/initTransactionCheckboxHandler.js */ "./resources/js/scripts/initTransactionCheckboxHandler.js");
/* harmony import */ var _scripts_initMapInputComponents_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./scripts/initMapInputComponents.js */ "./resources/js/scripts/initMapInputComponents.js");
/* harmony import */ var _scripts_initTimepickerComponents_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./scripts/initTimepickerComponents.js */ "./resources/js/scripts/initTimepickerComponents.js");
/* harmony import */ var _scripts_initTransactionModalHandler_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./scripts/initTransactionModalHandler.js */ "./resources/js/scripts/initTransactionModalHandler.js");
/* harmony import */ var _scripts_initContactModalHandler_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./scripts/initContactModalHandler.js */ "./resources/js/scripts/initContactModalHandler.js");
/* harmony import */ var _scripts_initCleaningServicesModalHandler_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./scripts/initCleaningServicesModalHandler.js */ "./resources/js/scripts/initCleaningServicesModalHandler.js");
/* harmony import */ var _scripts_initTooltip_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./scripts/initTooltip.js */ "./resources/js/scripts/initTooltip.js");















$(function () {
  /////////////////////////////
  /////////////////////////////
  var viewport = {
    x: 0,
    y: 0
  }; /////////////////////////////
  /////////////////////////////

  $(window).resize(resize);

  function init() {
    Object(_scripts_handleMenuFit_js__WEBPACK_IMPORTED_MODULE_2__["handleMenuFit"])();
    Object(_scripts_initConfirmClick_js__WEBPACK_IMPORTED_MODULE_0__["initConfirmClick"])();
    Object(_scripts_initCalendar_js__WEBPACK_IMPORTED_MODULE_3__["initCalendar"])();
    Object(_scripts_initDatepickerComponents_js__WEBPACK_IMPORTED_MODULE_5__["initDatepickerComponents"])();
    Object(_scripts_initFastSelectComponents_js__WEBPACK_IMPORTED_MODULE_6__["initFastSelectComponents"])();
    Object(_scripts_initGetPmPropertySelectionEvent_js__WEBPACK_IMPORTED_MODULE_7__["initGetPmPropertySelectionEvent"])();
    Object(_scripts_initTransactionCheckboxHandler_js__WEBPACK_IMPORTED_MODULE_8__["initTransactionCheckboxHandler"])();
    Object(_scripts_initMapInputComponents_js__WEBPACK_IMPORTED_MODULE_9__["initMapInputComponents"])();
    Object(_scripts_initTimepickerComponents_js__WEBPACK_IMPORTED_MODULE_10__["initTimepickerComponents"])();
    Object(_scripts_initTransactionModalHandler_js__WEBPACK_IMPORTED_MODULE_11__["initTransactionModalHandler"])();
    Object(_scripts_initContactModalHandler_js__WEBPACK_IMPORTED_MODULE_12__["initContactModalHandler"])();
    Object(_scripts_initCleaningServicesModalHandler_js__WEBPACK_IMPORTED_MODULE_13__["initCleaningServicesModalHandler"])();
    Object(_scripts_initTooltip_js__WEBPACK_IMPORTED_MODULE_14__["initTooltip"])();
    initCleaningMonthlyBatchEvents();
    initBalancesFinishedHandler();
    initBulkTransactionsHandler();
  }

  function printTable(table, title) {
    var tableContent = document.getElementById(table).innerHTML;
    var a = window.open("", "", "height=500, width=500");
    a.document.write("<html>");
    a.document.write("<body>");
    a.document.write("<h2>".concat(title, "</h2>"));
    a.document.write("<style>");
    a.document.write("\n            .not-print{\n                display: none !important;\n            }\n\n            table{\n                width: 100%;\n                display: table;\n                border-collapse: collapse;\n                box-sizing: border-box;\n                border-spacing: 2px;\n                border-color: grey;\n                border-collapse: collapse;\n                border-spacing: 2px;\n            }\n\n            tr {\n                display: table-row;\n                vertical-align: inherit;\n                border-color: inherit;\n            }\n\n            table thead th {\n                vertical-align: bottom;\n            }\n\n            table th, table td {\n                text-align: left;\n                font-size: 12px;\n                padding: 10px;\n                vertical-align: top;\n                border: 1px solid #000;\n            }\n\n            table th span.app-price-red,\n            table td span.app-price-red {\n                color: #f00;\n            }\n        ");
    a.document.write("</style>");
    a.document.write(tableContent);
    a.document.write("</body></html>");
    a.document.close();
    a.print();
  }

  $(".btn-print").on("click", function (e) {
    var tableID = $(this).data("table");
    var tableTitle = $(this).data("title");
    printTable(tableID, tableTitle);
  });

  function resize() {
    viewport = Object(_scripts_getViewport_js__WEBPACK_IMPORTED_MODULE_1__["getViewport"])();
    Object(_scripts_handleMenuFit_js__WEBPACK_IMPORTED_MODULE_2__["handleMenuFit"])();
  } /////////////////////////////
  /////////////////////////////


  init(); /////////////////////////////
  /////////////////////////////

  $("select[name='city_id']").change(function () {
    $("select[name='zone_id']").empty();
    $.getJSON("/system/settings/zones/list/" + $(this).val(), function (data) {
      $.each(data.data, function (key, value) {
        $("select[name='zone_id']").append("<option value=" + value.zone_id + ">" + value.name + "</option>");
      });
    });
  });
  $("#cleaning-option-batch-year-select").change(function () {
    $(this).closest("form").submit();
  });
  var maidFee = $("#field_cleaning-service_maid_fee_").val();
  $("#field_property_status_ids_").change(function () {
    if ($.inArray("8", $(this).val()) != -1) {
      $("#field_cleaning-service_maid_fee_").val(0);
    } else {
      $("#field_cleaning-service_maid_fee_").val(maidFee);
    }

    setTimeout(function () {
      $(".fstChoiceRemove").each(function () {
        $(this).on("click", function () {
          var text = $(this).parent(".fstChoiceItem").data("value");

          if (text === 8) {
            $("#field_cleaning-service_maid_fee_").val(maidFee);
          }
        });
      });
    }, 500);
  });
  $(".fstChoiceRemove").each(function () {
    $(this).on("click", function () {
      var text = $(this).parent(".fstChoiceItem").data("value");

      if (text === 8) {
        $("#field_cleaning-service_maid_fee_").val(maidFee);
      }
    });
  }); /////////////////////////////
  /////////////////////////////

  function initCleaningMonthlyBatchEvents() {
    $(".hover-action").each(function () {
      var item = $(this);
      item.click(function () {
        $(".clicked").each(function (i, v) {
          $(v).removeClass("clicked");
        });
        var tr = $(this).closest("tr");

        if (tr.length) {
          if (tr.hasClass("clicked")) {
            tr.removeClass("clicked");
          } else {
            tr.addClass("clicked");
          }
        }
      });
    });
  } /////////////////////////////
  //Form for create new user//
  /////////////////////////////


  function modalForm(form) {
    var modal_form = false;
    $(document).on("submit", form, function (e) {
      e.preventDefault();
      var form = $(this);

      if (!modal_form) {
        // modal_form = true;
        var action = $(this).attr("action");
        var req = $(this).serializeArray();
        $.ajax({
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          },
          type: "POST",
          url: action,
          dataType: "json",
          data: req
        }).done(function (data) {
          $(".modal-backdrop").fadeOut();
          $(".modal").fadeOut();
          $("body").removeClass("modal-open");
          $("#errors-modal").fadeOut();
          $.each(data.users.data, function (key, value) {
            $("select[name='user_id']").append("<option value=\"".concat(value.id, "\">").concat(value.profile.firstname, " ").concat(value.profile.lastname, "</option>"));
          });
          $("select[name='user_id']").append("<option value=\"".concat(data.user.user_id, "\" selected>").concat(data.user.firstname, " ").concat(data.user.lastname, "</option>"));
          modal_form = false;
        }).fail(function (error) {
          console.log(error);
          var errors = JSON.parse(error.responseText).errors;
          $("#errors-modal").empty();
          $.each(errors, function (key, value) {
            $("#errors-modal").fadeIn(function () {
              $("#errors-modal").append("<li>".concat(value, "</li>"));
            });
          });
        });
      }
    });
  }

  modalForm("#store-ajax"); ///////////////////////////////
  //Verify Day for Sundar Bonus//
  ///////////////////////////////

  function changeProperty() {
    $("#field_cleaning-service_property_id_").change(function () {
      var date = new Date($("input[name='date_submit']").val()).getDay();
      Object(_scripts_getBonus_js__WEBPACK_IMPORTED_MODULE_4__["getBonus"])($(this).val(), date);
    });
  }

  changeProperty();

  function initBalancesFinishedHandler() {
    var trigger = $("#show_finished_balances");

    var toggle = function toggle() {
      var status = trigger.data('status');
      var isOpened = status === 'open';

      if (isOpened) {
        $(".tr-finished-balance").hide();
        trigger.data('status', 'closed');
        var showText = trigger.data('show-text');
        trigger.text(showText);
      } else {
        $(".tr-finished-balance").show();
        trigger.data('status', 'open');
        var hideText = trigger.data('hide-text');
        trigger.text(hideText);
      }
    };

    toggle();
    trigger.on('click', function (e) {
      e.preventDefault();
      toggle();
    });
  }

  function initBulkTransactionsHandler() {
    $("#bulk-transaction-name").on('change', function () {
      var value = $(this).val();
      $(".bulk-transaction-name").val(value);
    });
    $("#bulk-transaction-type").on('change', function () {
      var value = $(this).val();
      $(".bulk-transaction-type").val(value);
    });
    $("#bulk-transaction-from-date").on('change', function () {
      var value = $(this).val();
      $(".bulk-transaction-from-date").val(value);
    });
    $("#bulk-transaction-to-date").on('change', function () {
      var value = $(this).val();
      $(".bulk-transaction-to-date").val(value);
    });
    $("#bulk-transaction-post-date").on('change', function () {
      var value = $(this).val();
      $(".bulk-transaction-post-date").val(value);
    });
  }
});

/***/ }),

/***/ "./resources/js/scripts/getBonus.js":
/*!******************************************!*\
  !*** ./resources/js/scripts/getBonus.js ***!
  \******************************************/
/*! exports provided: getBonus */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getBonus", function() { return getBonus; });
function getBonus(value, date) {
  var url = $("#field_property_sunday_bonus_").data("route");

  if (value) {
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      type: "GET",
      url: url,
      dataType: "json",
      data: {
        id: value
      }
    }).done(function (data) {
      if (date == 6) {
        $("#field_property_sunday_bonus_").val(data);
      } else {
        $("#field_property_sunday_bonus_").val("0.00");
      }
    });
  } else {
    $("#field_property_sunday_bonus_").val("0.00");
  }
}

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
  $("#calendar").fullCalendar({
    header: {
      left: "prev,next today",
      center: "title",
      right: "month,agendaWeek,agendaDay"
    },
    themeSystem: "bootstrap4",
    disableDragging: true,
    eventRender: function eventRender(event, element) {
      var status = event.status ? "<i class='nav-icon i-Yes font-weight-bold text-success'></i>" : "<i class='nav-icon i-Close font-weight-bold text-danger'></i>";
      element.find(".fc-title").html("<div class='status-event'>" + status + "</div>" + " " + event.title);
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

/***/ "./resources/js/scripts/initCleaningServicesModalHandler.js":
/*!******************************************************************!*\
  !*** ./resources/js/scripts/initCleaningServicesModalHandler.js ***!
  \******************************************************************/
/*! exports provided: initCleaningServicesModalHandler */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initCleaningServicesModalHandler", function() { return initCleaningServicesModalHandler; });
/* harmony import */ var _initDatepickerComponents_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./initDatepickerComponents.js */ "./resources/js/scripts/initDatepickerComponents.js");
/* harmony import */ var _initFastSelectComponents_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./initFastSelectComponents.js */ "./resources/js/scripts/initFastSelectComponents.js");
/* harmony import */ var _getBonus_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./getBonus.js */ "./resources/js/scripts/getBonus.js");



function initCleaningServicesModalHandler() {
  var modals = $(".app-cleaning-service-modal");
  modals.each(function () {
    var id = $(this).attr("id");
    var modal = $("#" + id);
    var container = $(this).find(".app-cleaning-service-modal-container");
    var url = container.data("url");
    modal.on("show.bs.modal", function (e) {
      var propertyID = $(e.relatedTarget).data("property");
      var maidFee = $(e.relatedTarget).data("maid-fee");
      var loadFee = $(e.relatedTarget).data("load-fee");
      var propertyDate = $(e.relatedTarget).data("date");
      var date = new Date(propertyDate).getDay();
      $.get(url, function (html) {
        container.html(html).promise().done(function () {
          modal.modal("handleUpdate");
          Object(_initDatepickerComponents_js__WEBPACK_IMPORTED_MODULE_0__["initDatepickerComponents"])();
          Object(_initFastSelectComponents_js__WEBPACK_IMPORTED_MODULE_1__["initFastSelectComponents"])();
          setTimeout(function () {
            Object(_getBonus_js__WEBPACK_IMPORTED_MODULE_2__["getBonus"])(propertyID, date);
            $("#field_property_status_ids_").change(function () {
              if ($.inArray("8", $(this).val()) != -1) {
                $("#field_cleaning-service_maid_fee_").val(0);
                $("#field_property_sunday_bonus_").val(0);
              } else {
                $("#field_cleaning-service_maid_fee_").val(maidFee);
                Object(_getBonus_js__WEBPACK_IMPORTED_MODULE_2__["getBonus"])(propertyID, date);
              }

              setTimeout(function () {
                $(".fstChoiceRemove").each(function () {
                  $(this).on("click", function () {
                    var text = $(this).parent(".fstChoiceItem").data("value");

                    if (text === 8) {
                      $("#field_cleaning-service_maid_fee_").val(maidFee);
                      Object(_getBonus_js__WEBPACK_IMPORTED_MODULE_2__["getBonus"])(propertyID, date);
                    }
                  });
                });
              }, 500);
            });
            $(".fstChoiceRemove").each(function () {
              $(this).on("click", function () {
                var text = $(this).parent(".fstChoiceItem").data("value");

                if (text === 8) {
                  $("#field_cleaning-service_maid_fee_").val(maidFee);
                }
              });
            });
            $("#field_cleaning-service_property_id_").val(propertyID);

            if (loadFee) {
              $("#field_cleaning-service_maid_fee_").val(maidFee);
            }

            if (maidFee == "0.00" || maidFee == "") {
              $(".maid_fee").hide();
            } else {
              $(".maid_fee").show();
            }

            $("#maid_fee_base span").html(maidFee);
            $("#field_cleaning-service_date_").val(propertyDate);
          }, 500);
        });
      });
    });
  });
}

/***/ }),

/***/ "./resources/js/scripts/initConfirmClick.js":
/*!**************************************************!*\
  !*** ./resources/js/scripts/initConfirmClick.js ***!
  \**************************************************/
/*! exports provided: initConfirmClick */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initConfirmClick", function() { return initConfirmClick; });
function initConfirmClick() {
  $('.app-confirm').each(function () {
    var link = $(this);
    var confirmLabel = link.data('label');
    link.click(function (e) {
      if (confirm(confirmLabel)) {
        return true;
      }

      e.preventDefault();
      return false;
    });
  });
}

/***/ }),

/***/ "./resources/js/scripts/initContactModalHandler.js":
/*!*********************************************************!*\
  !*** ./resources/js/scripts/initContactModalHandler.js ***!
  \*********************************************************/
/*! exports provided: initContactModalHandler */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initContactModalHandler", function() { return initContactModalHandler; });
function initContactModalHandler() {
  var modals = $(".app-contact-modal");
  modals.each(function () {
    var id = $(this).attr("id");
    var modal = $("#" + id);
    var container = $(this).find(".app-contact-modal-container");
    var url = container.data("url");
    modal.on("show.bs.modal", function (e) {
      $.get(url, function (html) {
        container.html(html).promise().done(function () {
          modal.modal("handleUpdate");
        });
      });
    });
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
/* harmony import */ var _getBonus_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./getBonus.js */ "./resources/js/scripts/getBonus.js");
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
  $(".app-input-datepicker").each(function () {
    var _$$pickadate;

    var dateFormat = $(this).data("format");
    var maxDaysLimitFromNow = $(this).data("max-days-limit-from-now");
    var maxSelectionDate = new Date();
    maxSelectionDate.setDate(maxSelectionDate.getDate() + parseInt(maxDaysLimitFromNow));
    $(this).pickadate((_$$pickadate = {
      selectYears: true
    }, _defineProperty(_$$pickadate, "selectYears", 70), _defineProperty(_$$pickadate, "selectMonths", true), _defineProperty(_$$pickadate, "format", dateFormat), _defineProperty(_$$pickadate, "formatSubmit", dateFormat), _defineProperty(_$$pickadate, "max", maxSelectionDate), _defineProperty(_$$pickadate, "onSet", function onSet(context) {
      var date = new Date(context.select * 1000).getDay();
      var propertyID = $("#field_cleaning-service_property_id_").val() || false;
      Object(_getBonus_js__WEBPACK_IMPORTED_MODULE_0__["getBonus"])(propertyID, date);
    }), _$$pickadate));
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

/***/ "./resources/js/scripts/initGetPmPropertySelectionEvent.js":
/*!*****************************************************************!*\
  !*** ./resources/js/scripts/initGetPmPropertySelectionEvent.js ***!
  \*****************************************************************/
/*! exports provided: initGetPmPropertySelectionEvent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initGetPmPropertySelectionEvent", function() { return initGetPmPropertySelectionEvent; });
function initGetPmPropertySelectionEvent() {
  var selectionModal = $("#app-pm-property-selection-modal");
  var selectionContainer = $("#app-pm-property-selection-container");
  var url = selectionContainer.data('url');
  selectionModal.on('show.bs.modal', function (e) {
    $.get(url, function (html) {
      selectionContainer.html(html);
    });
  });
  $(document).on('change', "#app-pm-property-selection-container", function () {
    var select = $(".app-pm-property-select-wrapper select");
    var generationUrl = $(".app-pm-property-select-wrapper").data('generate-pm-transaction-url');
    var propertyID = select.val();

    if (propertyID) {
      document.location = generationUrl + '/' + propertyID;
    }
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
function _typeof(obj) {
  "@babel/helpers - typeof";

  if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
    _typeof = function _typeof(obj) {
      return typeof obj;
    };
  } else {
    _typeof = function _typeof(obj) {
      return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
    };
  }

  return _typeof(obj);
}

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

  function waitForGoogleAndInit() {
    var googleCheckInterval = setInterval(function () {
      if ((typeof google === "undefined" ? "undefined" : _typeof(google)) === 'object' && _typeof(google.maps) === 'object') {
        init();
        clearInterval(googleCheckInterval);
      }
    }, 500);
  }

  function init() {
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
        var isDisabled = !!mapWrapper.data('disabled') || !!mapWrapper.data('read-only');
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
        marker = new google.maps.Marker({
          position: position,
          map: map,
          draggable: true
        });

        if (!dataLat && !dataLng) {
          marker.setMap(null);
        }

        if (!isDisabled) {
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
        }
      });
    }
  }

  waitForGoogleAndInit();
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

/***/ "./resources/js/scripts/initTooltip.js":
/*!*********************************************!*\
  !*** ./resources/js/scripts/initTooltip.js ***!
  \*********************************************/
/*! exports provided: initTooltip */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initTooltip", function() { return initTooltip; });
function initTooltip() {
  $('[data-toggle="tooltip"]').tooltip({
    container: 'body'
  });
}

/***/ }),

/***/ "./resources/js/scripts/initTransactionCheckboxHandler.js":
/*!****************************************************************!*\
  !*** ./resources/js/scripts/initTransactionCheckboxHandler.js ***!
  \****************************************************************/
/*! exports provided: initTransactionCheckboxHandler */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initTransactionCheckboxHandler", function() { return initTransactionCheckboxHandler; });
function prepareBtnUrl(btn) {
  var checkboxesValues = [];
  var checkboxes = btn.closest('.app-checkbox-actions').find('.app-checkbox-actions-item');
  var baseUrl = btn.data('base-url');
  checkboxes.each(function () {
    var checkbox = $(this);

    if (checkbox.is(':checked')) {
      checkboxesValues.push(checkbox.val());
    }
  });
  return baseUrl + '/' + checkboxesValues.join('_');
}

function hasCheckedCheckboxes(btn) {
  var hasCheckedCheckbox = false;
  var checkboxes = btn.closest('.app-checkbox-actions').find('.app-checkbox-actions-item');

  if (checkboxes.length) {
    checkboxes.each(function () {
      if ($(this).prop('checked')) {
        hasCheckedCheckbox = true;
      }
    });
  }

  return hasCheckedCheckbox;
}

function initTransactionCheckboxHandler() {
  $('.app-checkbox-actions-btn').each(function () {
    var btn = $(this);
    var confirmLabel = btn.data('confirm-label');
    btn.click(function (e) {
      e.preventDefault();

      if (confirm(confirmLabel) && hasCheckedCheckboxes(btn)) {
        var url = prepareBtnUrl($(this));
        window.location.href = url;
        return true;
      }

      return false;
    });
  });
  $('.app-checkbox-actions-header').each(function () {
    var checkbox = $(this);
    checkbox.change(function () {
      var checkedStatus = $(this).prop('checked');
      var childCheckboxes = $(this).closest('.app-checkbox-actions').find('.app-checkbox-actions-item');
      childCheckboxes.each(function () {
        var childCheckbox = $(this);
        childCheckbox.prop('checked', checkedStatus);
      });
    });
  });
}

/***/ }),

/***/ "./resources/js/scripts/initTransactionModalHandler.js":
/*!*************************************************************!*\
  !*** ./resources/js/scripts/initTransactionModalHandler.js ***!
  \*************************************************************/
/*! exports provided: initTransactionModalHandler */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initTransactionModalHandler", function() { return initTransactionModalHandler; });
/* harmony import */ var _initDatepickerComponents_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./initDatepickerComponents.js */ "./resources/js/scripts/initDatepickerComponents.js");

function initTransactionModalHandler() {
  var modals = $(".app-transaction-modal");
  modals.each(function () {
    var id = $(this).attr('id');
    var modal = $('#' + id);
    var container = $(this).find(".app-transaction-modal-container");
    var url = container.data('url');
    modal.on('show.bs.modal', function (e) {
      $.get(url, function (html) {
        container.html(html).promise().done(function () {
          modal.modal('handleUpdate');
          Object(_initDatepickerComponents_js__WEBPACK_IMPORTED_MODULE_0__["initDatepickerComponents"])();
        });
      });
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

__webpack_require__(/*! C:\wamp64\www\laravel\pmproject2\resources\js\scripts.js */"./resources/js/scripts.js");
__webpack_require__(/*! C:\wamp64\www\laravel\pmproject2\resources\sass\app.scss */"./resources/sass/app.scss");
module.exports = __webpack_require__(/*! C:\wamp64\www\laravel\pmproject2\resources\gull\assets\styles\sass\themes\palmera-vacations.scss */"./resources/gull/assets/styles/sass/themes/palmera-vacations.scss");


/***/ })

/******/ });