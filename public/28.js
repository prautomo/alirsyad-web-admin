(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[28],{

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

/***/ "./resources/js/components/Toko/promo/form.js":
/*!****************************************************!*\
  !*** ./resources/js/components/Toko/promo/form.js ***!
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
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var yup__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! yup */ "./node_modules/yup/es/index.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _store_useFetch__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../../store/useFetch */ "./resources/js/store/useFetch.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _SimpleContainer__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../SimpleContainer */ "./resources/js/components/SimpleContainer.js");
/* harmony import */ var _Form_InputRenderer__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../../Form/InputRenderer */ "./resources/js/components/Form/InputRenderer.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_10__);


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












function UpdatePromo(_ref) {
  var form_data = _ref.form_data;

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])([]),
      _useState2 = _slicedToArray(_useState, 2),
      cover = _useState2[0],
      setCover = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])([]),
      _useState4 = _slicedToArray(_useState3, 2),
      gelery = _useState4[0],
      setGelery = _useState4[1];

  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState6 = _slicedToArray(_useState5, 2),
      model = _useState6[0],
      setModel = _useState6[1];

  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    var tmp = _objectSpread({}, form_data);

    tmp.cover_image = [{
      image_url: tmp.cover_image
    }];
    tmp.end_date = moment__WEBPACK_IMPORTED_MODULE_7___default()(tmp.end_date);
    tmp.start_date = moment__WEBPACK_IMPORTED_MODULE_7___default()(tmp.start_date);

    if (tmp.potongan_nominal > 0) {
      tmp.jenis_diskon = "NOMINAL";
    } else {
      tmp.jenis_diskon = "PERSEN";
    }

    setModel(tmp);
  }, []);

  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_6__["default"])("/app/data/district"),
      data = _useFetch.data,
      isLoading = _useFetch.isLoading,
      isError = _useFetch.isError;

  var brand = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_6__["default"])("/app/data/getbrand");
  var category = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_6__["default"])("/app/data/getcategory");
  var unit = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_6__["default"])("/app/data/getunit");
  var subCategory = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_6__["default"])(model.category_id && "/app/data/getcategory/" + model.category_id);

  var _useState7 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState8 = _slicedToArray(_useState7, 2),
      dataSent = _useState8[0],
      setDataSent = _useState8[1];

  function updateDataMitra() {
    return _updateDataMitra.apply(this, arguments);
  }

  function _updateDataMitra() {
    _updateDataMitra = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
      var checkoutSchema, valid, tmpModel;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              checkoutSchema = Object(yup__WEBPACK_IMPORTED_MODULE_4__["object"])().shape({
                name: Object(yup__WEBPACK_IMPORTED_MODULE_4__["string"])().required(),
                description: Object(yup__WEBPACK_IMPORTED_MODULE_4__["string"])().required(),
                code: Object(yup__WEBPACK_IMPORTED_MODULE_4__["string"])().required(),
                start_date: Object(yup__WEBPACK_IMPORTED_MODULE_4__["string"])().required(),
                end_date: Object(yup__WEBPACK_IMPORTED_MODULE_4__["string"])().required(),
                jenis_diskon: Object(yup__WEBPACK_IMPORTED_MODULE_4__["string"])().required()
              });
              _context.next = 3;
              return checkoutSchema.isValid(model);

            case 3:
              valid = _context.sent;

              if (model.jenis_diskon == "NOMINAL" && (!model.potongan_nominal || model.potongan_nominal == "")) {
                valid = false;
              }

              if (model.jenis_diskon == "PERSEN" && (!model.potongan_persen || model.potongan_persen == "")) {
                valid = false;
              }

              if (valid) {
                setDataSent(true);
                tmpModel = _objectSpread({}, model);

                if (model.jenis_diskon == "NOMINAL") {
                  delete tmpModel.potongan_persen;
                } else {
                  delete tmpModel.potongan_nominal;
                }

                if (model.id) {
                  window.axios.put("/toko/promo/" + model.id, tmpModel).then(function (res) {
                    sweetalert2__WEBPACK_IMPORTED_MODULE_5___default.a.fire("Informasi", res.data.message, "success");
                    window.location.href = "/toko/promo";
                  })["catch"](function (err) {
                    sweetalert2__WEBPACK_IMPORTED_MODULE_5___default.a.fire("Terjadi kesalahan", err.response.data.message, "error");
                  })["finally"](function () {
                    setDataSent(false);
                  });
                } else {
                  window.axios.post("/toko/promo", tmpModel).then(function (res) {
                    sweetalert2__WEBPACK_IMPORTED_MODULE_5___default.a.fire("Informasi", res.data.message, "success");
                    window.location.href = "/toko/promo";
                  })["catch"](function (err) {
                    sweetalert2__WEBPACK_IMPORTED_MODULE_5___default.a.fire("Terjadi kesalahan", err.response.data.message, "error");
                  })["finally"](function () {
                    setDataSent(false);
                  });
                }
              } else {
                sweetalert2__WEBPACK_IMPORTED_MODULE_5___default.a.fire("Validasi", "Silahkan Isi Semua Informasi ", "warning");
              }

            case 7:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));
    return _updateDataMitra.apply(this, arguments);
  }

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_8__["default"], {
    title: "Update Product",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_9__["InputWithLabel"], {
      label: "(*)Nama Promo",
      placeholder: "EX:  Cat",
      value: model["name"],
      onChange: function onChange(val) {
        var tmp = _objectSpread({}, model);

        console.log(tmp);
        setModel(_objectSpread(_objectSpread({}, model), {
          name: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_9__["InputWithLabel"], {
      label: "(*)Kode  Promo",
      placeholder: "EX:  Cat",
      value: model["code"],
      onChange: function onChange(val) {
        var tmp = _objectSpread({}, model);

        console.log(tmp);
        setModel(_objectSpread(_objectSpread({}, model), {
          code: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_9__["InputTextAreaWithLabel"], {
      label: "(*)Deskripsi",
      placeholder: "EX:  Cat",
      value: model["description"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          description: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_9__["InputDatePickerWithLabel"], {
      label: "(*)Tanggal Mulai",
      placeholder: "EX:  Cat",
      value: model["start_date"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          start_date: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_9__["InputDatePickerWithLabel"], {
      label: "(*)Tanggal Selesai",
      placeholder: "EX:  Cat",
      value: model["end_date"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          end_date: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_9__["InputSelectWithLabel"], {
      label: "(*)Jenis Diskon",
      placeholder: "EX:  Cat",
      value: model["jsnis_diskon"],
      items: [{
        id: "PERSEN",
        name: "Persen"
      }, {
        id: "NOMINAL",
        name: "Nominal"
      }],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          jenis_diskon: val
        }));
      }
    }), model.jenis_diskon == "NOMINAL" ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_9__["InputWithLabel"], {
      label: "(*)Promo Rp",
      placeholder: "EX:  Cat",
      appendix: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
        "class": "fa fa-money",
        "aria-hidden": "true"
      }),
      value: model["potongan_nominal"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          potongan_nominal: val
        }));
      }
    }) : "", model.jenis_diskon == "PERSEN" ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_9__["InputWithLabel"], {
      label: "(*)Promo %",
      placeholder: "EX:  Cat",
      appendix: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
        "class": "fa fa-money",
        "aria-hidden": "true"
      }),
      value: model["potongan_persen"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          potongan_persen: val
        }));
      }
    }) : ""))
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_8__["default"], {
    title: "Cover Image",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_9__["ImagePickerWithLabel"], {
      label: "(*)Cover Image",
      placeholder: "EX:  Cat",
      items: model['cover_image'],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          cover_image: [val]
        }));
      },
      removeItem: function removeItem(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          cover_image: val
        }));
      }
    })))
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
    disabled: dataSent,
    onClick: function onClick() {
      updateDataMitra();
    },
    className: "btn btn-danger"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
    "class": "fa fa-floppy-o",
    "aria-hidden": "true"
  }), "  Simpan")));
}

/* harmony default export */ __webpack_exports__["default"] = (UpdatePromo);

if (document.getElementById('form-promo')) {
  var container = document.getElementById("form-promo");
  var formData = container.getAttribute("form-data") ? container.getAttribute("form-data") : "{}";
  react_dom__WEBPACK_IMPORTED_MODULE_2___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(UpdatePromo, {
    form_data: JSON.parse(formData)
  }), container);
}

/***/ })

}]);