(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[27],{

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

/***/ "./resources/js/components/Toko/product/form.js":
/*!******************************************************!*\
  !*** ./resources/js/components/Toko/product/form.js ***!
  \******************************************************/
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
/* harmony import */ var _SimpleContainer__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../SimpleContainer */ "./resources/js/components/SimpleContainer.js");
/* harmony import */ var _Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../Form/InputRenderer */ "./resources/js/components/Form/InputRenderer.js");


function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

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










function UpdateProduct(_ref) {
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

    tmp.category_id = form_data.sub_category ? form_data.sub_category.category_id : null;
    setGelery(form_data.galery ? form_data.galery : []);
    setCover(form_data.cover ? [form_data.cover] : null);
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
                selling_price: Object(yup__WEBPACK_IMPORTED_MODULE_4__["string"])().required(),
                brand_id: Object(yup__WEBPACK_IMPORTED_MODULE_4__["string"])().required(),
                category_id: Object(yup__WEBPACK_IMPORTED_MODULE_4__["string"])().required(),
                sub_category_id: Object(yup__WEBPACK_IMPORTED_MODULE_4__["string"])().required(),
                unit_id: Object(yup__WEBPACK_IMPORTED_MODULE_4__["string"])().required()
              });
              _context.next = 3;
              return checkoutSchema.isValid(model);

            case 3:
              valid = _context.sent;

              if (valid) {
                setDataSent(true);
                tmpModel = _objectSpread({}, model);
                tmpModel.cover = cover;
                tmpModel.galery = gelery;

                if (model.id) {
                  window.axios.put("/toko/product/" + model.sku_id, tmpModel).then(function (res) {
                    sweetalert2__WEBPACK_IMPORTED_MODULE_5___default.a.fire("Informasi", res.data.message, "success");
                    window.location.href = "/toko/product";
                  })["catch"](function (err) {
                    sweetalert2__WEBPACK_IMPORTED_MODULE_5___default.a.fire("Terjadi kesalahan", err.response.data.message, "error");
                  })["finally"](function () {
                    setDataSent(false);
                  });
                } else {
                  window.axios.post("/toko/product", tmpModel).then(function (res) {
                    sweetalert2__WEBPACK_IMPORTED_MODULE_5___default.a.fire("Informasi", res.data.message, "success");
                    window.location.href = "/toko/product";
                  })["catch"](function (err) {
                    sweetalert2__WEBPACK_IMPORTED_MODULE_5___default.a.fire("Terjadi kesalahan", err.response.data.message, "error");
                  })["finally"](function () {
                    setDataSent(false);
                  });
                }
              } else {
                sweetalert2__WEBPACK_IMPORTED_MODULE_5___default.a.fire("Validasi", "Silahkan Isi Semua Informasi ", "warning");
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

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_7__["default"], {
    title: "Update Product",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["InputWithLabel"], {
      label: "(*)Nama Produk",
      placeholder: "EX:  Cat",
      value: model["name"],
      onChange: function onChange(val) {
        var tmp = _objectSpread({}, model);

        console.log(tmp);
        setModel(_objectSpread(_objectSpread({}, model), {
          name: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["InputTextAreaWithLabel"], {
      label: "(*)Deskripsi",
      placeholder: "EX:  Cat",
      value: model["description"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          description: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["InputWithLabel"], {
      label: "(*)Harga Satuan",
      placeholder: "EX:  Cat",
      appendix: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
        "class": "fa fa-money",
        "aria-hidden": "true"
      }),
      value: model["selling_price"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          selling_price: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["InputSelectWithLabel"], {
      label: "(*)Brand",
      placeholder: "EX:  Cat",
      sub_category_id: true,
      items: !brand.isLoading ? brand.data : [],
      value: model["brand_id"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          brand_id: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["InputSelectWithLabel"], {
      label: "(*)Category",
      placeholder: "EX:  Cat",
      items: !category.isLoading ? category.data : [],
      value: model["category_id"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          category_id: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["InputSelectWithLabel"], {
      label: "(*)Sub Category",
      placeholder: "EX:  Cat",
      items: subCategory.data ? subCategory.data : [],
      value: model["sub_category_id"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          sub_category_id: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["InputSelectWithLabel"], {
      label: "(*)Unit",
      placeholder: "EX:  Cat",
      items: unit.data ? unit.data : [],
      value: model["unit_id"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          unit_id: val
        }));
      }
    }, "\""), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["InputWithLabel"], {
      label: "Diskon",
      placeholder: "EX:  Cat",
      items: unit.data ? unit.data : [],
      value: model["discount"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          discount: val
        }));
      }
    }, "\""), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["InputTextAreaWithLabel"], {
      label: "Keunggulan",
      placeholder: "EX:  Cat",
      value: model["keunggulan"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          keunggulan: val
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["InputTextAreaWithLabel"], {
      label: "Spesifikasi",
      placeholder: "EX:  Cat",
      value: model["spesification"],
      onChange: function onChange(val) {
        setModel(_objectSpread(_objectSpread({}, model), {
          spesification: val
        }));
      }
    })))
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_7__["default"], {
    title: "Gambar",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["ImagePickerWithLabel"], {
      label: "(*)Cover",
      placeholder: "EX:  Cat",
      items: cover,
      onChange: function onChange(val) {
        setCover([val]);
      },
      removeItem: function removeItem(val) {
        setCover(val);
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["ImagePickerWithLabel"], {
      label: "Galery",
      placeholder: "EX:  Cat",
      single: false,
      items: gelery,
      onChange: function onChange(val) {
        var tmp = _toConsumableArray(gelery);

        console.log(gelery);
        tmp.push(val);
        setGelery(tmp);
      },
      removeItem: function removeItem(val) {
        setGelery(val);
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

/* harmony default export */ __webpack_exports__["default"] = (UpdateProduct);

if (document.getElementById('form-product')) {
  var container = document.getElementById("form-product");
  var formData = container.getAttribute("form-data") ? container.getAttribute("form-data") : "{}";
  react_dom__WEBPACK_IMPORTED_MODULE_2___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(UpdateProduct, {
    form_data: JSON.parse(formData)
  }), container);
}

/***/ })

}]);