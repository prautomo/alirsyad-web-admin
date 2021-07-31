(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[24],{

/***/ "./resources/js/components/Jasa/index.js":
/*!***********************************************!*\
  !*** ./resources/js/components/Jasa/index.js ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _store_useFetch__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../store/useFetch */ "./resources/js/store/useFetch.js");
/* harmony import */ var _Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../Form/InputRenderer */ "./resources/js/components/Form/InputRenderer.js");
/* harmony import */ var _SimpleContainer__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../SimpleContainer */ "./resources/js/components/SimpleContainer.js");
/* harmony import */ var yup__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! yup */ "./node_modules/yup/es/index.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_7__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }









function JasaContainer(params) {
  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_3__["default"])("/app/data/service"),
      data = _useFetch.data,
      isLoading = _useFetch.isLoading,
      isError = _useFetch.isError;

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(null),
      _useState2 = _slicedToArray(_useState, 2),
      selecteService = _useState2[0],
      setSelecteService = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(null),
      _useState4 = _slicedToArray(_useState3, 2),
      selectedSubService = _useState4[0],
      setSelectedSubService = _useState4[1];

  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(null),
      _useState6 = _slicedToArray(_useState5, 2),
      tanggalMulai = _useState6[0],
      setTanggalMulai = _useState6[1];

  var _useState7 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(null),
      _useState8 = _slicedToArray(_useState7, 2),
      catatan = _useState8[0],
      setCatatan = _useState8[1];

  var _useState9 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState10 = _slicedToArray(_useState9, 2),
      dataSent = _useState10[0],
      setDataSent = _useState10[1];

  function sendInq() {
    return _sendInq.apply(this, arguments);
  }

  function _sendInq() {
    _sendInq = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
      var inq, checkoutSchema, valid;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              inq = {
                service_id: selecteService,
                sub_service_id: selectedSubService,
                catatan: catatan,
                tanggalMulai: tanggalMulai
              };
              checkoutSchema = Object(yup__WEBPACK_IMPORTED_MODULE_6__["object"])().shape({
                service_id: Object(yup__WEBPACK_IMPORTED_MODULE_6__["string"])().required(),
                sub_service_id: Object(yup__WEBPACK_IMPORTED_MODULE_6__["string"])().required(),
                catatan: Object(yup__WEBPACK_IMPORTED_MODULE_6__["string"])().required(),
                tanggalMulai: Object(yup__WEBPACK_IMPORTED_MODULE_6__["string"])().required()
              });
              _context.next = 4;
              return checkoutSchema.isValid(inq);

            case 4:
              valid = _context.sent;

              if (valid) {
                setDataSent(true);
                window.axios.post("/app/checkoutjasa", inq).then(function (res) {
                  sweetalert2__WEBPACK_IMPORTED_MODULE_7___default.a.fire("Informasi", res.data.message, "success");
                })["catch"](function (err) {
                  sweetalert2__WEBPACK_IMPORTED_MODULE_7___default.a.fire("Terjadi kesalahan", err.response.data.message, "error");
                })["finally"](function () {
                  setDataSent(false);
                });
              } else {
                sweetalert2__WEBPACK_IMPORTED_MODULE_7___default.a.fire("Validasi", "Silahkan Isi Semua Informasi ", "warning");
              }

              window.axios.post;

            case 7:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));
    return _sendInq.apply(this, arguments);
  }

  var subItemData = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_3__["default"])(selecteService && "/app/data/service/" + selecteService).data;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_5__["default"], {
    title: "Permintaan Jasa",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "row"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "col-lg-5"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputSelectWithLabel"], {
      value: selecteService,
      plabel: "Pilih Jasa",
      items: !isLoading ? data : [],
      onChange: function onChange(e) {
        setSelecteService(e);
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputSelectWithLabel"], {
      value: selectedSubService,
      label: "Pilih Sub Jasa",
      items: subItemData,
      onChange: function onChange(e) {
        setSelectedSubService(e);
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputTextAreaWithLabel"], {
      label: "Catatan",
      value: catatan,
      onChange: function onChange(e) {
        setCatatan(e);
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputDatePickerWithLabel"], {
      label: "Tanggal Mulai",
      value: tanggalMulai,
      onChange: function onChange(e) {
        setTanggalMulai(e);
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
      className: "btn btn-danger w-100",
      style: {
        height: '50px'
      },
      onClick: sendInq
    }, "Kirim"))))
  }));
}

/* harmony default export */ __webpack_exports__["default"] = (JasaContainer);

if (document.getElementById('jasa-container')) {
  var container = document.getElementById("jasa-container");
  react_dom__WEBPACK_IMPORTED_MODULE_2___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(JasaContainer, null), container);
}

/***/ }),

/***/ "./resources/js/components/SimpleContainer.js":
/*!****************************************************!*\
  !*** ./resources/js/components/SimpleContainer.js ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return SimpleContainer; });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

function SimpleContainer(_ref) {
  var title = _ref.title,
      content = _ref.content;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "card border-none  ",
    style: {
      backgroundColor: 'transparent'
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h3", null, title), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex flex-column"
  }, content)));
}

/***/ })

}]);