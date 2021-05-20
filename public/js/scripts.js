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
/* harmony import */ var _scripts_initCheckAvailabilityProperty_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./scripts/initCheckAvailabilityProperty.js */ "./resources/js/scripts/initCheckAvailabilityProperty.js");
/* harmony import */ var _scripts_initTransactionCheckboxHandler_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./scripts/initTransactionCheckboxHandler.js */ "./resources/js/scripts/initTransactionCheckboxHandler.js");
/* harmony import */ var _scripts_initMapInputComponents_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./scripts/initMapInputComponents.js */ "./resources/js/scripts/initMapInputComponents.js");
/* harmony import */ var _scripts_initTimepickerComponents_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./scripts/initTimepickerComponents.js */ "./resources/js/scripts/initTimepickerComponents.js");
/* harmony import */ var _scripts_initTransactionModalHandler_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./scripts/initTransactionModalHandler.js */ "./resources/js/scripts/initTransactionModalHandler.js");
/* harmony import */ var _scripts_initContactModalHandler_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./scripts/initContactModalHandler.js */ "./resources/js/scripts/initContactModalHandler.js");
/* harmony import */ var _scripts_initCleaningServicesModalHandler_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./scripts/initCleaningServicesModalHandler.js */ "./resources/js/scripts/initCleaningServicesModalHandler.js");
/* harmony import */ var _scripts_initNotificationsModalHandler_js__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./scripts/initNotificationsModalHandler.js */ "./resources/js/scripts/initNotificationsModalHandler.js");
/* harmony import */ var _scripts_initDeleteImageModalHandler_js__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./scripts/initDeleteImageModalHandler.js */ "./resources/js/scripts/initDeleteImageModalHandler.js");
/* harmony import */ var _scripts_initCalendarModalHandler_js__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ./scripts/initCalendarModalHandler.js */ "./resources/js/scripts/initCalendarModalHandler.js");
/* harmony import */ var _scripts_initTooltip_js__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! ./scripts/initTooltip.js */ "./resources/js/scripts/initTooltip.js");
/* harmony import */ var _scripts_deleteSelectableCheckbox_js__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! ./scripts/deleteSelectableCheckbox.js */ "./resources/js/scripts/deleteSelectableCheckbox.js");




















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
    Object(_scripts_initCheckAvailabilityProperty_js__WEBPACK_IMPORTED_MODULE_8__["initCheckAvailabilityProperty"])();
    Object(_scripts_initTransactionCheckboxHandler_js__WEBPACK_IMPORTED_MODULE_9__["initTransactionCheckboxHandler"])();
    Object(_scripts_initMapInputComponents_js__WEBPACK_IMPORTED_MODULE_10__["initMapInputComponents"])();
    Object(_scripts_initTimepickerComponents_js__WEBPACK_IMPORTED_MODULE_11__["initTimepickerComponents"])();
    Object(_scripts_initTransactionModalHandler_js__WEBPACK_IMPORTED_MODULE_12__["initTransactionModalHandler"])();
    Object(_scripts_initContactModalHandler_js__WEBPACK_IMPORTED_MODULE_13__["initContactModalHandler"])();
    Object(_scripts_initCleaningServicesModalHandler_js__WEBPACK_IMPORTED_MODULE_14__["initCleaningServicesModalHandler"])();
    Object(_scripts_initNotificationsModalHandler_js__WEBPACK_IMPORTED_MODULE_15__["initNotificationsModalHandler"])();
    Object(_scripts_initDeleteImageModalHandler_js__WEBPACK_IMPORTED_MODULE_16__["initDeleteImageModalHandler"])();
    Object(_scripts_initCalendarModalHandler_js__WEBPACK_IMPORTED_MODULE_17__["initCalendarModalHandler"])();
    Object(_scripts_initTooltip_js__WEBPACK_IMPORTED_MODULE_18__["initTooltip"])();
    initCleaningMonthlyBatchEvents();
    initBalancesFinishedHandler();
    initBulkTransactionsHandler();
    Object(_scripts_deleteSelectableCheckbox_js__WEBPACK_IMPORTED_MODULE_19__["initDeleteSelectableCheckbox"])();
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
  $("#cleaning-option-batch-staff-select").change(function () {
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
  }); // SHOW/HIDE Inputs from template

  $("select[name='template']").change(function () {
    var currentTemplate = $(this).val();
    $('.dynamic-fields').hide();
    selectTemplate(currentTemplate);
  });
  selectTemplate($("select[name='template']").val());

  function selectTemplate(currentTemplate) {
    switch (currentTemplate) {
      case 'Payment Methods':
        $('#fields-payment-methods').show();
        break;

      case 'Accidental Rental Damage Insurance (ARDI)':
        $('#fields-accidental').show();
        break;

      case 'Nuevo Vallarta':
        $('#fields-nuevo-vallarta').show();
        break;

      case 'Testimonials':
        $('#fields-testimonials').show();
        break;

      case 'Real Estate Business Directory':
        $('#fields-real-estate').show();
        break;

      default:
        break;
    }
  } /////////////////////////////
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
  } // get dates availability


  var getDateAvailability = JSON.parse(localStorage.getItem('dates-availability')) || [];
  var arrivalDateAvailability = getDateAvailability.length !== 0 ? getDateAvailability[0] : '';
  var departureDateAvailability = getDateAvailability.length !== 0 ? getDateAvailability[1] : '';
  $('input[name="arrival_date"]').val(arrivalDateAvailability);
  $('input[name="arrival_date_submit"]').val(arrivalDateAvailability);
  $('input[name="departure_date"]').val(departureDateAvailability);
  $('input[name="departure_date_submit"]').val(departureDateAvailability); // submit form balance property management transactions when year change

  $('.select-year').on('change', function () {
    $('#search-balance').submit();
  }); // fill textarea canvas

  var oldText = $("#text-canvas").val();
  var svgx = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
  var firstText = nl2br($('#field_notification_owners_email_content_').val());
  $("#text-canvas").append(firstText); // $("#text-canvas").css({
  //     'height': calcHeight($("#text-canvas").val()) + "px"
  // });

  $('#field_notification_owners_email_content_').on('change', function () {
    $("#text-canvas").empty();
    $("#text-canvas").append(oldText);
    $("#text-canvas").append(nl2br($(this).val())); // $("#text-canvas").css({
    //     'height': calcHeight($("#text-canvas").val()) + "px"
    // });
  }); // email generate image

  $('#send_email').on('submit', function (e) {
    var htmlCanvas = document.getElementById("text-canvas");
    var urlCanvas = $(this).attr('data-img');
    var paymentId = $(this).attr('data-payment');
    nodeToDataURL({
      targetNode: htmlCanvas,
      customStyle: '#text-canvas {box-sizing: border-box; font-family: "Open Sans", sans-serif; font-weight: 400; letter-spacing: 0.3px; background-color:#ffffff; padding: 20px 30px; height: 100% !important; width:100% !important;}'
    }).then(function (url) {
      var dataCanvas = {
        'id': paymentId,
        'image': url
      };
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        type: "POST",
        url: urlCanvas,
        dataType: "json",
        data: {
          "source": dataCanvas
        }
      });
    });
  });

  function calcHeight(value) {
    var numberOfLineBreaks = (value.match(/\n/g) || []).length; // min-height + lines x line-height + padding + border

    var newHeight = 20 + numberOfLineBreaks * 25 + 12 + 2;
    return newHeight;
  }

  function nl2br(str, is_xhtml) {
    var breakTag = is_xhtml || typeof is_xhtml === 'undefined' ? '<br/>' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
  }
});

/***/ }),

/***/ "./resources/js/scripts/deleteSelectableCheckbox.js":
/*!**********************************************************!*\
  !*** ./resources/js/scripts/deleteSelectableCheckbox.js ***!
  \**********************************************************/
/*! exports provided: initDeleteSelectableCheckbox */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initDeleteSelectableCheckbox", function() { return initDeleteSelectableCheckbox; });
function initDeleteSelectableCheckbox() {
  $('.delete-selectable-checkbox').each(function () {
    var checkbox = $(this);
    var checkboxItems = $(this).closest('table').find('.delete-selectable-option');
    var deleteAction = $(this).closest('table').find('.delete-selectable-action'); // change event on checkbox table

    checkbox.on('change', function (e) {
      if ($(this).is(':checked')) {
        checkboxItems.each(function () {
          $(this).prop('checked', true);
        });
      } else {
        checkboxItems.each(function () {
          $(this).prop('checked', false);
        });
      }
    }); // delete trigger action

    deleteAction.on('click', function (e) {
      e.preventDefault();
      var url = deleteAction.data('tpl-route') + '/';
      checkboxItems.each(function () {
        if ($(this).is(':checked')) {
          url = url + '_' + $(this).val();
        }
      });
      document.location = url;
    });
  });
}

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

/***/ "./resources/js/scripts/initCalendarModalHandler.js":
/*!**********************************************************!*\
  !*** ./resources/js/scripts/initCalendarModalHandler.js ***!
  \**********************************************************/
/*! exports provided: initCalendarModalHandler */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initCalendarModalHandler", function() { return initCalendarModalHandler; });
function initCalendarModalHandler() {
  var modals = $(".app-modal-calendar");
  modals.each(function () {
    var id = $(this).attr("id");
    var modal = $("#" + id);
    var container = $(this).find(".app-modal-calendar-container");
    var url = container.data("url");
    modal.on("show.bs.modal", function (e) {
      var data = {
        'id': $(e.relatedTarget).data("source"),
        'year': $(e.relatedTarget).data("year")
      };
      $.ajax({
        url: url,
        type: "GET",
        data: {
          "source": data
        }
      }).done(function (data) {
        container.html(data.calendar);
        $('.modal-prev').attr("data-year", data.prev);
        $('.modal-current').html(data.current);
        $('.modal-next').attr("data-year", data.next);
        setTimeout(function () {
          $('.modal-prev, .modal-next').on('click', function (e) {
            var dataNew = {
              'id': e.currentTarget.attributes[1].value,
              'year': e.currentTarget.attributes[2].value
            };
            $.ajax({
              url: url,
              type: "GET",
              data: {
                "source": dataNew
              }
            }).done(function (data) {
              $('.modal-prev').attr("data-year", data.prev);
              $('.modal-current').html(data.current);
              $('.modal-next').attr("data-year", data.next);
              container.html(data.calendar);
            });
          });
        }, 500);
      });
    });
  });
}

/***/ }),

/***/ "./resources/js/scripts/initCheckAvailabilityProperty.js":
/*!***************************************************************!*\
  !*** ./resources/js/scripts/initCheckAvailabilityProperty.js ***!
  \***************************************************************/
/*! exports provided: initCheckAvailabilityProperty */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initCheckAvailabilityProperty", function() { return initCheckAvailabilityProperty; });
/* harmony import */ var _initDatepickerComponents_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./initDatepickerComponents.js */ "./resources/js/scripts/initDatepickerComponents.js");

function initCheckAvailabilityProperty() {
  var selectionModal = $("#app-property-bookings-selection-modal");
  var selectionContainer = $("#app-property-bookings-selection-container");
  var url = selectionContainer.data('url');
  selectionModal.on('show.bs.modal', function (e) {
    $.get(url, function (html) {
      selectionContainer.html(html).promise().done(function () {
        Object(_initDatepickerComponents_js__WEBPACK_IMPORTED_MODULE_0__["initDatepickerComponents"])();
        $("#form-check-availability").on('submit', function (e) {
          e.preventDefault();
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
            $("#modal-availability-modal .btns-container a").attr('data-source', data.id);
            $("#modal-availability-modal .modal-title").html(data.name);
            var datesAvailability = [];
            datesAvailability.push(data.arrival);
            datesAvailability.push(data.departure);
            localStorage.setItem('dates-availability', JSON.stringify(datesAvailability));
            var dataHtml = "\n                        <div class=\"table-responsive\" style=\"margin-top: 20px\">\n                            <table class=\"table table-striped\">\n                                <tr>\n                                    <th scope=\"col\">Property</th>\n                                    <th scope=\"col\">Address</th>\n                                    <th scope=\"col\">Type</th>\n                                    <th scope=\"col\">Bedrooms</th>\n                                    <th scope=\"col\">Baths</th>\n                                    <th scope=\"col\">Max Occ.</th>\n                                </tr>\n                                <tr>\n                                    <td>\n                                        ".concat(data.name, "\n                                    </td>\n\n                                    <td>\n                                        ").concat(data.address, "\n                                    </td>\n\n                                    <td>\n                                        ").concat(data.type, "\n                                    </td>\n\n                                    <td>\n                                        ").concat(data.beds, "\n                                    </td>\n\n                                    <td>\n                                        ").concat(data.baths, "\n                                    </td>\n\n                                    <td>\n                                        ").concat(data.pax, "\n                                    </td>\n                                </tr>\n                                <tr>\n                                    <th scope=\"col\">Cleaning Frecuency</th>\n                                    <th scope=\"col\">Nights</th>\n                                    <th scope=\"col\">Min Stay</th>\n                                    <th scope=\"col\">Nightly Rate</th>\n                                    <th scope=\"col\">Total</th>\n                                    <th scope=\"col\"></th>\n                                </tr>\n                                <tr>\n                                    <td>\n                                        ").concat(data.cleaning, "\n                                    </td>\n\n                                    <td>\n                                        ").concat(data.nights, "\n                                    </td>\n                                    \n                                    <td>\n                                        ").concat(data.minStay, "\n                                    </td>\n\n                                    <td>\n                                        ").concat(data.nightlyRate, "\n                                    </td>\n\n                                    <td>\n                                        ").concat(data.total, "\n                                    </td>\n\n                                    <td>\n                                    \n                                    </td>\n                                </tr>\n                            </table>\n                            <a href=\"").concat(data.route, "\" class=\"btn btn-primary m-1\">\n                                Book Property\n                            </a>\n                            <a href=\"#\" data-toggle=\"modal\" data-source=\"").concat(data.id, "\" data-year=\"").concat(data.year, "\"\n                                data-target=\"#modal-availability-modal\" class=\"btn-calendar btn btn-primary m-1\">\n                                Availability Calendar\n                            </a>\n                        </div>\n                        ");

            if (data.afirmation == 'all') {
              $('.all-dates').hide();
              $('.some-dates').hide();
              $('#details-property').show();
              $('#details-property').html(dataHtml);
            } else if (data.afirmation == 'some') {
              $('.all-dates').hide();
              $('#details-property').hide();
              $('#details-property').html('');
              $('.some-dates span').html("".concat(data.arrival, " - ").concat(data.departure, " \n                                - <a href=\"#\" data-toggle=\"modal\" data-source=\"").concat(data.id, "\" data-year=\"").concat(data.year, "\"\n                                data-target=\"#modal-availability-modal\" class=\"btn-calendar\">\n                                Availability Calendar\n                            </a>"));
              $('.some-dates').show();
            } else {
              $('.some-dates').hide();
              $('#details-property').hide();
              $('#details-property').html('');
              $('.all-dates span').html("".concat(data.arrival, " - ").concat(data.departure, "\n                                - <a href=\"#\" data-toggle=\"modal\" data-source=\"").concat(data.id, "\" data-year=\"").concat(data.year, "\"\n                                data-target=\"#modal-availability-modal\" class=\"btn-calendar\">\n                                Availability Calendar\n                            </a>"));
              $('.all-dates').show();
            }
          });
        });
      });
    });
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
          $('#form-cleaning-service').submit(function (e) {
            var errorFields = '#error-fields';
            var inputDate = $(this).find('input[name="date"]');
            var textareaDescription = $(this).find('textarea[name="description"]');
            var inputMaidFee = $(this).find('input[name="maid_fee"]');
            var inputSundayBonus = $(this).find('input[name="sunday_bonus"]');

            if (!$(inputDate).val() || !$(textareaDescription).val() || !$(inputMaidFee).val() || !$(inputSundayBonus).val()) {
              $(errorFields).show();
              setTimeout(function () {
                $(errorFields).hide();
              }, 5000);
              return false;
            } else {
              $(errorFields).hide();
            }
          });
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

/***/ "./resources/js/scripts/initDeleteImageModalHandler.js":
/*!*************************************************************!*\
  !*** ./resources/js/scripts/initDeleteImageModalHandler.js ***!
  \*************************************************************/
/*! exports provided: initDeleteImageModalHandler */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initDeleteImageModalHandler", function() { return initDeleteImageModalHandler; });
function initDeleteImageModalHandler() {
  var modals = $(".app-modal-delete-image");
  modals.each(function () {
    var id = $(this).attr("id");
    var modal = $("#" + id);
    var container = $(this).find(".app-modal-delete-image-container");
    var url = container.data("url");
    modal.on("show.bs.modal", function (e) {
      var source = $(e.relatedTarget).data("source");
      var route = $(e.relatedTarget).data("route");
      var txtButton = $(e.relatedTarget).data("text-button");
      var cancelButton = $(e.relatedTarget).data("cancel-button");
      $.ajax({
        url: url,
        type: "GET",
        data: {
          "source": source
        }
      }).done(function (html) {
        container.html(html);
        container.append("<form action=\"".concat(route, "\">\n                        <br>\n                        <button type=\"button\" class=\"btn btn-primary m-1\" data-dismiss=\"modal\">").concat(cancelButton, "</button>\n                        <button type=\"submit\" class=\"btn btn-danger m-1\">").concat(txtButton, "</button>\n                    </form>"));
      });
    });
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
      selectionContainer.html(html).promise().done(function () {
        $(".app-pm-property-select-wrapper select").on('change', function () {
          var generationUrl = $(".app-pm-property-select-wrapper").data('generate-pm-transaction-url');
          var propertyID = $(this).val();

          if (propertyID) {
            var propertyUrl = generationUrl + '/' + propertyID;
            document.location = propertyUrl;
          }
        });
      });
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

/***/ "./resources/js/scripts/initNotificationsModalHandler.js":
/*!***************************************************************!*\
  !*** ./resources/js/scripts/initNotificationsModalHandler.js ***!
  \***************************************************************/
/*! exports provided: initNotificationsModalHandler */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initNotificationsModalHandler", function() { return initNotificationsModalHandler; });
function initNotificationsModalHandler() {
  var modals = $(".app-modal-notification");
  modals.each(function () {
    var id = $(this).attr("id");
    var modal = $("#" + id);
    var container = $(this).find(".app-modal-notification-container");
    var url = container.data("url");
    modal.on("show.bs.modal", function (e) {
      var source = $(e.relatedTarget).data("source");
      var route = $(e.relatedTarget).data("route");
      var txtButton = $(e.relatedTarget).data("text-button");
      var txtCustomMsg = $(e.relatedTarget).data("text-custom-msg");
      $.ajax({
        url: url,
        type: "GET",
        data: {
          "source": source
        }
      }).done(function (html) {
        container.html(html);
        container.append("<form action=\"".concat(route, "\">\n                <br>\n                <label for=\"custom_msg\" style=\"display:block;\">").concat(txtCustomMsg, "</label>\n                <textarea name=\"custom_msg\" id=\"custom_msg\" rows=\"5\" style=\"width:100%\"></textarea>\n                <button type=\"submit\" class=\"btn btn-primary m-1\">").concat(txtButton, "</button>\n                </form>"));
      });
    });
  });
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

/***/ "./resources/sass/public.scss":
/*!************************************!*\
  !*** ./resources/sass/public.scss ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!****************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/scripts.js ./resources/sass/app.scss ./resources/gull/assets/styles/sass/themes/palmera-vacations.scss ./resources/sass/public.scss ***!
  \****************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\wamp64\www\laravel\pmv\resources\js\scripts.js */"./resources/js/scripts.js");
__webpack_require__(/*! C:\wamp64\www\laravel\pmv\resources\sass\app.scss */"./resources/sass/app.scss");
__webpack_require__(/*! C:\wamp64\www\laravel\pmv\resources\gull\assets\styles\sass\themes\palmera-vacations.scss */"./resources/gull/assets/styles/sass/themes/palmera-vacations.scss");
module.exports = __webpack_require__(/*! C:\wamp64\www\laravel\pmv\resources\sass\public.scss */"./resources/sass/public.scss");


/***/ })

/******/ });