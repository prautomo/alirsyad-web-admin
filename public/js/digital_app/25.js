(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[25],{

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

/***/ }),

/***/ "./resources/js/components/Toko/UpdateJasa.js":
/*!****************************************************!*\
  !*** ./resources/js/components/Toko/UpdateJasa.js ***!
  \****************************************************/
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
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var yup__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! yup */ "./node_modules/yup/es/index.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_8__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }










function UpdateJasa(_ref) {
  var mitra_detail = _ref.mitra_detail;

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState2 = _slicedToArray(_useState, 2),
      mitraDetail = _useState2[0],
      setMitraDetail = _useState2[1];

  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    console.log(mitra_detail);
    var subService = mitra_detail.sub_service ? mitra_detail.sub_service : {};
    setMitraDetail(_objectSpread(_objectSpread({}, mitra_detail), {
      service_id: subService.service_id,
      sub_service_id: subService.id
    }));
  }, []);

  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_3__["default"])(mitraDetail.service_id && "/app/data/service/" + mitraDetail.service_id),
      data = _useFetch.data,
      isLoading = _useFetch.isLoading,
      isError = _useFetch.isError;

  var dataService = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_3__["default"])("/app/data/service").data;

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState4 = _slicedToArray(_useState3, 2),
      dataSent = _useState4[0],
      setDataSent = _useState4[1];

  function updateDataMitra() {
    return _updateDataMitra.apply(this, arguments);
  }

  function _updateDataMitra() {
    _updateDataMitra = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
      var checkoutSchema, valid, tmpMitraDetail;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              // "jasa_id",
              // "latitude",
              // "longitude",
              // "bank_name",
              // "bank_account_number",
              // "bank_account_holder",
              // "rating",
              // "alamat",
              // "biaya",
              // "sub_service_id",
              checkoutSchema = Object(yup__WEBPACK_IMPORTED_MODULE_7__["object"])().shape({
                biaya: Object(yup__WEBPACK_IMPORTED_MODULE_7__["string"])().required(),
                bank_name: Object(yup__WEBPACK_IMPORTED_MODULE_7__["string"])().required(),
                bank_account_number: Object(yup__WEBPACK_IMPORTED_MODULE_7__["string"])().required(),
                bank_account_holder: Object(yup__WEBPACK_IMPORTED_MODULE_7__["string"])().required(),
                location: Object(yup__WEBPACK_IMPORTED_MODULE_7__["object"])().required(),
                alamat: Object(yup__WEBPACK_IMPORTED_MODULE_7__["string"])().required(),
                sub_service_id: Object(yup__WEBPACK_IMPORTED_MODULE_7__["string"])().required()
              });
              _context.next = 3;
              return checkoutSchema.isValid(mitraDetail);

            case 3:
              valid = _context.sent;

              if (valid) {
                setDataSent(true);
                tmpMitraDetail = _objectSpread({}, mitraDetail);
                tmpMitraDetail["sub_service_id"] = tmpMitraDetail.sub_service_id;
                tmpMitraDetail["longitude"] = tmpMitraDetail.location.lng;
                tmpMitraDetail["latitude"] = tmpMitraDetail.location.lat;
                window.axios.post("/jasa/update", tmpMitraDetail).then(function (res) {
                  sweetalert2__WEBPACK_IMPORTED_MODULE_8___default.a.fire("Informasi", res.data.message, "success");
                })["catch"](function (err) {
                  sweetalert2__WEBPACK_IMPORTED_MODULE_8___default.a.fire("Terjadi kesalahan", err.response.data.message, "error");
                })["finally"](function () {
                  setDataSent(false);
                });
              } else {
                sweetalert2__WEBPACK_IMPORTED_MODULE_8___default.a.fire("Validasi", "Silahkan Isi Semua Informasi ", "warning");
              }

            case 5:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));
    return _updateDataMitra.apply(this, arguments);
  }

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_5__["default"], {
    title: "Biaya Pengerjaan",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputWithLabel"], {
      label: "Biaya Per Hari",
      type: "number",
      placeholder: "EX:  Bank Central Asia",
      value: mitraDetail["biaya"],
      onChange: function onChange(val) {
        setMitraDetail(_objectSpread(_objectSpread({}, mitraDetail), {
          biaya: val
        }));
      }
    })))
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_5__["default"], {
    title: "Bank Pembayaran",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputWithLabel"], {
      label: "Nama Bank",
      placeholder: "EX:  Bank Central Asia",
      value: mitraDetail["bank_name"],
      onChange: function onChange(val) {
        setMitraDetail(_objectSpread(_objectSpread({}, mitraDetail), {
          bank_name: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputWithLabel"], {
      label: "Nomor Rekening",
      placeholder: "EX:  13213123",
      value: mitraDetail["bank_account_number"],
      onChange: function onChange(val) {
        setMitraDetail(_objectSpread(_objectSpread({}, mitraDetail), {
          bank_account_number: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputWithLabel"], {
      label: "Nama Pemilik Rekening",
      placeholder: "EX:  ",
      value: mitraDetail["bank_account_holder"],
      onChange: function onChange(val) {
        setMitraDetail(_objectSpread(_objectSpread({}, mitraDetail), {
          bank_account_holder: val
        }));
      }
    })))
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_5__["default"], {
    title: "Lokasi Mitra",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputTextAreaWithLabel"], {
      label: "Alamat",
      placeholder: "EX: Jl Kolonel Masturi No1",
      value: mitraDetail["alamat"],
      onChange: function onChange(val) {
        setMitraDetail(_objectSpread(_objectSpread({}, mitraDetail), {
          alamat: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputMapPickerWithLabel"], {
      label: "Koordinat Lokasi",
      value: JSON.stringify(mitraDetail["location"]),
      onChange: function onChange(val) {
        setMitraDetail(_objectSpread(_objectSpread({}, mitraDetail), {
          location: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputSelectWithLabel"], {
      label: "Kategori",
      items: dataService ? dataService : [],
      value: mitraDetail['service_id'],
      onChange: function onChange(e) {
        setMitraDetail(_objectSpread(_objectSpread({}, mitraDetail), {
          service_id: e
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputSelectWithLabel"], {
      label: "Sub Kategori",
      items: !isLoading ? data : [],
      value: mitraDetail['sub_service_id'],
      onChange: function onChange(e) {
        setMitraDetail(_objectSpread(_objectSpread({}, mitraDetail), {
          sub_service_id: e
        }));
      }
    })))
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
    disabled: dataSent,
    onClick: function onClick() {
      updateDataMitra();
    },
    className: "btn btn-danger"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
    "class": "fa fa-floppy-o",
    "aria-hidden": "true"
  }), "  Simpan"));
}

/* harmony default export */ __webpack_exports__["default"] = (UpdateJasa);

if (document.getElementById('jasa-update-form')) {
  var container = document.getElementById("jasa-update-form");
  var mitraDetail = container.getAttribute("mitra_detail") ? container.getAttribute("mitra_detail") : "{}";
  react_dom__WEBPACK_IMPORTED_MODULE_2___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(UpdateJasa, {
    mitra_detail: JSON.parse(mitraDetail)
  }), container);
}

/***/ })

}]);