(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[15],{

/***/ "./resources/js/components/Cart/Step.js":
/*!**********************************************!*\
  !*** ./resources/js/components/Cart/Step.js ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return StepStatus; });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_1__);


function StepStatus(_ref) {
  var items = _ref.items,
      currentIndex = _ref.currentIndex;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex flex-row justify-content-between container",
    style: {
      width: "500px"
    }
  }, items.map(function (item, index) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
      className: classnames__WEBPACK_IMPORTED_MODULE_1___default()("d-flex flex-column align-items-center ", {
        'text-muted': currentIndex == index
      })
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
      className: "d-flex flex-column align-items-center justify-content-center",
      style: {
        width: '50px',
        height: "50px",
        background: currentIndex == index ? "red" : "#FEB3B4",
        borderRadius: '25px'
      }
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h3", {
      className: "m-0 text-white"
    }, item.key)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
      className: "mt-2"
    }, item.text));
  })));
}

/***/ }),

/***/ "./resources/js/components/Cart/index.js":
/*!***********************************************!*\
  !*** ./resources/js/components/Cart/index.js ***!
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
/* harmony import */ var numeral__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! numeral */ "./node_modules/numeral/numeral.js");
/* harmony import */ var numeral__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(numeral__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _SimpleContainer__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../SimpleContainer */ "./resources/js/components/SimpleContainer.js");
/* harmony import */ var _store_useCart__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../store/useCart */ "./resources/js/store/useCart.js");
/* harmony import */ var _Step__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./Step */ "./resources/js/components/Cart/Step.js");
/* harmony import */ var react_bootstrap__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! react-bootstrap */ "./node_modules/react-bootstrap/esm/index.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var yup__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! yup */ "./node_modules/yup/es/index.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var _components_utls__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ../../components/utls */ "./resources/js/components/utls.js");
/* harmony import */ var _store_LocationStore__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ../../store/LocationStore */ "./resources/js/store/LocationStore.js");


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

















function CartDetailContainer(_ref) {
  var logedin = _ref.logedin,
      verified = _ref.verified;

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState2 = _slicedToArray(_useState, 2),
      formTransaksi = _useState2[0],
      setFormTransaksi = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(0),
      _useState4 = _slicedToArray(_useState3, 2),
      currentIndex = _useState4[0],
      setCurrentIndex = _useState4[1];

  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState6 = _slicedToArray(_useState5, 2),
      createdTransaction = _useState6[0],
      setCreatedTransaction = _useState6[1];

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      marginTop: '120px'
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "row justify-content-center "
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Step__WEBPACK_IMPORTED_MODULE_9__["default"], {
    items: [{
      "key": 1,
      'text': "Belanjaan anda"
    }, {
      "key": 2,
      'text': "Pengiriman"
    }, {
      "key": 3,
      'text': "Pembayaran"
    }],
    currentIndex: currentIndex
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      marginTop: '50px'
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      display: currentIndex == 0 ? "block" : "none"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(CartDetail, {
    logedin: logedin,
    setCurrentIndex: setCurrentIndex,
    verified: verified
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      display: currentIndex == 1 ? "block" : "none"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(InformasiPengiriman, {
    logedin: logedin,
    setCurrentIndex: setCurrentIndex,
    formTransaksi: formTransaksi,
    setFormTransaksi: setFormTransaksi,
    setCreatedTransaction: setCreatedTransaction
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      display: currentIndex == 2 ? "block" : "none"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(PaymentPage, {
    logedin: logedin,
    setCurrentIndex: setCurrentIndex,
    createdTransaction: createdTransaction
  })));
}

function CartDetail(_ref2) {
  var logedin = _ref2.logedin,
      setCurrentIndex = _ref2.setCurrentIndex,
      verified = _ref2.verified;

  var _useCart = Object(_store_useCart__WEBPACK_IMPORTED_MODULE_8__["default"])(),
      cart = _useCart.cart,
      addItem = _useCart.addItem,
      getTotalTransaksi = _useCart.getTotalTransaksi,
      removeItem = _useCart.removeItem,
      mapCartByMitra = _useCart.mapCartByMitra;

  var _useState7 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState8 = _slicedToArray(_useState7, 2),
      mappedByMitra = _useState8[0],
      setMappedByMitra = _useState8[1];

  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    var item = mapCartByMitra();
    setMappedByMitra(item);
  }, [cart]);

  function setJumlah(jumlah, item) {
    var tmp = {};
    tmp[item.sku_id] = _objectSpread(_objectSpread({}, item), {
      jumlah: jumlah
    });
    addItem(_objectSpread(_objectSpread({}, cart), tmp));
  }

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "row justify-content-center"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "col-lg-10 "
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_7__["default"], {
    title: "Shopping Cart",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("small", null, "Daftar belanjaan anda"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      style: {
        marginTop: '30px'
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, Object.keys(mappedByMitra).map(function (mitraInstance) {
      var mitraItems = mappedByMitra[mitraInstance];
      var mitra = mitraItems[0].mitra;
      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_7__["default"], {
        content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h5", null, mitra.name), mitraItems.map(function (cartItem) {
          return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
            className: "d-flex flex-row justify-content-start pt-3  align-items-center pb-3 pl-0 "
          }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
            style: {
              width: '130px',
              height: '130px',
              border: "1px solid #eee"
            },
            className: "d-flex  align-items-center"
          }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("img", {
            src: cartItem.cover.image_url,
            "class": "img-fluid ",
            alt: ""
          })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
            className: "pl-2 d-flex flex-column w-100"
          }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
            className: "d-flex justify-content-between align-items-center w-100"
          }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
            className: " d-flex flex-column"
          }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("b", null, cartItem.name), cartItem.discount > 0 && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("strike", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
            style: {
              color: "#F26525"
            },
            className: "pb-2 striped_price"
          }, "Rp ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(cartItem.selling_price).format("0,0")))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
            style: {
              color: "#F26525"
            },
            className: "pb-2 prod_price"
          }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("b", null, "    Rp ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(cartItem.selling_price - (cartItem.discount ? cartItem.discount : 0)).format("0,0")))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
            className: "btn btn-danger",
            style: {
              width: '40px',
              height: '40px'
            },
            onClick: function onClick() {
              sweetalert2__WEBPACK_IMPORTED_MODULE_13___default.a.fire({
                title: 'Keranjang belanja',
                text: "Anda yakin akan mengeluarkan " + cartItem.name + "  dari keranjang",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya'
              }).then(function (result) {
                if (result.isConfirmed) {
                  removeItem(cartItem.sku_id);
                }
              });
            }
          }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
            "class": "fa fa-trash",
            "aria-hidden": "true"
          }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
            className: "d-flex justify-content-between align-items-center w-100",
            style: {
              marginTop: '10px'
            }
          }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
            className: "d-flex align-items-center  justify-content-between",
            style: {
              width: '130',
              height: '40px',
              border: "1px solid #BEBEBE"
            }
          }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
            className: "btn ",
            style: {
              width: '40px',
              height: '40px'
            },
            onClick: function onClick() {
              setJumlah(cartItem.jumlah - 1 >= 1 ? cartItem.jumlah - 1 : 1, cartItem);
            }
          }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
            "class": "fa fa-minus",
            "aria-hidden": "true"
          })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
            className: "mb-0"
          }, cartItem.jumlah), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
            className: "btn",
            style: {
              width: '40px',
              height: '40px'
            },
            onClick: function onClick() {
              setJumlah(cartItem.jumlah + 1 < 1000 ? cartItem.jumlah + 1 : 1000, cartItem);
            }
          }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
            "class": "fa fa-plus",
            "aria-hidden": "true"
          }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h5", null, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_5___default()((cartItem.selling_price - (cartItem.discount > 0 ? cartItem.discount : 0)) * cartItem.jumlah).format('0,0'))))));
        }))
      }));
    })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-row justify-content-between"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, "Total Item"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("b", null, Object.keys(cart).length, " Item"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-row justify-content-between"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, "Total Harga"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h5", null, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(getTotalTransaksi()).format("0,0"), " "))), logedin && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex justify-content-end mt-4"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column align-items-end"
    }, !verified && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
      className: "text-danger"
    }, "Silahkan Verifikasi Email Anda Untuk Melakukan Checkout."), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
      disabled: Object.keys(cart).length < 1 || !verified,
      className: "btn btn-danger",
      style: {
        width: '200px',
        height: '50px'
      },
      onClick: function onClick() {
        setCurrentIndex(1);
      }
    }, "Checkout \xA0 ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
      "class": "fa fa-chevron-right",
      "aria-hidden": "true"
    })))))
  }))));
}

function InformasiPengiriman(_ref3) {
  var formTransaksi = _ref3.formTransaksi,
      setFormTransaksi = _ref3.setFormTransaksi,
      setCurrentIndex = _ref3.setCurrentIndex,
      setCreatedTransaction = _ref3.setCreatedTransaction;

  var _useCart2 = Object(_store_useCart__WEBPACK_IMPORTED_MODULE_8__["default"])(),
      cart = _useCart2.cart,
      addItem = _useCart2.addItem,
      getTotalTransaksi = _useCart2.getTotalTransaksi,
      removeItem = _useCart2.removeItem,
      removeAllItem = _useCart2.removeAllItem,
      mapCartByMitra = _useCart2.mapCartByMitra;

  var _useState9 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState10 = _slicedToArray(_useState9, 2),
      mappedByMitra = _useState10[0],
      setMappedByMitra = _useState10[1];

  var _useState11 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(0),
      _useState12 = _slicedToArray(_useState11, 2),
      totalOngkir = _useState12[0],
      setTotalOngkir = _useState12[1];

  var _useState13 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState14 = _slicedToArray(_useState13, 2),
      coorMitra = _useState14[0],
      setCoorMitra = _useState14[1];

  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    var item = mapCartByMitra();
    setMappedByMitra(item);
  }, [cart]);
  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    var ongkirByMitra = {};
    var totalOngkir = 0;
    var coorMitras = {};

    _.map(mappedByMitra, function (item) {
      var mitra = item[0].mitra;
      coorMitras[mitra.id] = {
        lat: mitra.detail_mitra.latitude,
        "long": mitra.detail_mitra.longitude
      };
      var mitraOngkir = mitra.detail_mitra ? mitra.detail_mitra.ongkir_km : 10000;
      var total = getMapJarakMitra(mitra.id, mitra.detail_mitra.latitude, mitra.detail_mitra.longitude) * mitraOngkir;
      ongkirByMitra[mitra.id] = total;
      totalOngkir = totalOngkir + total;
    });

    setTotalOngkir(totalOngkir);
    setOngkirByMitra(ongkirByMitra);
    setCoorMitra(coorMitras);
  }, [mappedByMitra]);

  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_3__["default"])("/app/data/getmypromos"),
      data = _useFetch.data,
      isLoading = _useFetch.isLoading,
      isError = _useFetch.isError;

  var _useState15 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState16 = _slicedToArray(_useState15, 2),
      validatedDiscount = _useState16[0],
      setValidatedDiscount = _useState16[1];

  var _useState17 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState18 = _slicedToArray(_useState17, 2),
      checkoutProcess = _useState18[0],
      setCheckoutProcess = _useState18[1];

  var _useState19 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState20 = _slicedToArray(_useState19, 2),
      ongkirByMitra = _useState20[0],
      setOngkirByMitra = _useState20[1];

  function onVoucherSelected(voucher) {
    setCheckoutProcess(true);
    window.axios.post("/app/validatevoucher", {
      cart: cart,
      voucher: voucher
    }).then(function (res) {
      setValidatedDiscount(res.data);
      sweetalert2__WEBPACK_IMPORTED_MODULE_13___default.a.fire("Voucher", "Voucher " + voucher.name + " Berahasil Diterapkan", "success");
    })["catch"](function (err) {
      setValidatedDiscount({});
      sweetalert2__WEBPACK_IMPORTED_MODULE_13___default.a.fire("Opss.", "Voucher " + voucher.name + " Gagal Diterapkan", "success");
      console.log(err);
    })["finally"](function () {
      setCheckoutProcess(false);
    });
  }

  function sendCheckoutRequest() {
    return _sendCheckoutRequest.apply(this, arguments);
  }

  function _sendCheckoutRequest() {
    _sendCheckoutRequest = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
      var checkoutSchema, valid;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              checkoutSchema = Object(yup__WEBPACK_IMPORTED_MODULE_12__["object"])().shape({
                nama_penerima: Object(yup__WEBPACK_IMPORTED_MODULE_12__["string"])().required(),
                nomor_telepon: Object(yup__WEBPACK_IMPORTED_MODULE_12__["string"])().required(),
                alamat: Object(yup__WEBPACK_IMPORTED_MODULE_12__["string"])().required(),
                location: Object(yup__WEBPACK_IMPORTED_MODULE_12__["object"])().required(),
                patokan: Object(yup__WEBPACK_IMPORTED_MODULE_12__["string"])().required(),
                catatan: Object(yup__WEBPACK_IMPORTED_MODULE_12__["string"])().required(),
                waktu_pengiriman: Object(yup__WEBPACK_IMPORTED_MODULE_12__["string"])().required()
              });
              _context.next = 3;
              return checkoutSchema.isValid(formTransaksi);

            case 3:
              valid = _context.sent;

              if (valid) {
                setCheckoutProcess(true);
                window.axios.post("/app/postcheckout", {
                  cart: cart,
                  selectedVoucher: selectedVoucher,
                  formTransaksi: formTransaksi,
                  mappedByMitra: mappedByMitra,
                  ongkirByMitra: ongkirByMitra
                }).then(function (res) {
                  removeAllItem();
                  setCurrentIndex(2);
                  setCreatedTransaction(res.data.data);
                })["catch"](function (err) {
                  sweetalert2__WEBPACK_IMPORTED_MODULE_13___default.a.fire("Terjadi kesalahan", err.response.data.message, "error");
                })["finally"](function () {
                  setCheckoutProcess(false);
                });
              } else {
                sweetalert2__WEBPACK_IMPORTED_MODULE_13___default.a.fire("Validasi", "Silahkan Isi Semua Informasi Pengiriman", "warning");
              }

            case 5:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));
    return _sendCheckoutRequest.apply(this, arguments);
  }

  var _useState21 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(null),
      _useState22 = _slicedToArray(_useState21, 2),
      selectedVoucher = _useState22[0],
      setSelectedVoucher = _useState22[1];

  var _useLocationStore = Object(_store_LocationStore__WEBPACK_IMPORTED_MODULE_15__["default"])(),
      latitude = _useLocationStore.latitude,
      longitude = _useLocationStore.longitude;

  function getMapJarakMitra(mitra_id, lat, _long) {
    if (mitra_id in coorMitra) {
      var corrdMitra = coorMitra[mitra_id];
      var currentLocation = formTransaksi.location ? formTransaksi.location : {
        lat: latitude,
        lng: longitude
      };
      console.log(currentLocation.lat, currentLocation.lng, corrdMitra.lat, corrdMitra["long"]);
      return Math.ceil(Object(_components_utls__WEBPACK_IMPORTED_MODULE_14__["calcCrow"])(currentLocation.lat, currentLocation.lng, corrdMitra.lat, corrdMitra["long"]).toFixed(1));
    } else if (lat && _long) {
      var currentLocation = formTransaksi.location ? formTransaksi.location : {
        lat: latitude,
        lng: longitude
      };
      return Math.ceil(Object(_components_utls__WEBPACK_IMPORTED_MODULE_14__["calcCrow"])(currentLocation.lat, currentLocation.lng, lat, _long).toFixed(1));
    } else {
      return 0;
    }
  }

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "row justify-content-center"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "col-lg-10 "
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    "class": "row"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    "class": "col-lg-8"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_7__["default"], {
    title: "Informasi Pengiriman",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("small", null, "Informasi Pengiriman"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      style: {
        marginTop: '30px'
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputWithLabel"], {
      label: "Nama Penerima :",
      placeholder: "",
      value: formTransaksi["nama_penerima"],
      onChange: function onChange(value) {
        setFormTransaksi(_objectSpread(_objectSpread({}, formTransaksi), {
          nama_penerima: value
        }));
      },
      appendix: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
        "class": "fa fa-user",
        "aria-hidden": "true"
      })
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputWithLabel"], {
      label: "Nomor Telepon :",
      value: formTransaksi["nomor_telepon"],
      onChange: function onChange(value) {
        setFormTransaksi(_objectSpread(_objectSpread({}, formTransaksi), {
          nomor_telepon: value
        }));
      },
      appendix: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
        "class": "fa fa-phone",
        "aria-hidden": "true"
      })
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputMapPickerWithLabel"], {
      label: "Lokasi : ",
      desc: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("small", null, "*Maks Pengiriman Maks 5KM , Lebih Dari Itu Dikenakan Biaya Per KM nya"),
      appendix: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
        "class": "fa fa-map-pin",
        "aria-hidden": "true"
      }),
      value: JSON.stringify(formTransaksi["location"]),
      onChange: function onChange(value) {
        setFormTransaksi(_objectSpread(_objectSpread({}, formTransaksi), {
          location: value
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputWithLabel"], {
      label: "Alamat : ",
      value: formTransaksi["alamat"],
      onChange: function onChange(value) {
        setFormTransaksi(_objectSpread(_objectSpread({}, formTransaksi), {
          alamat: value
        }));
      },
      appendix: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
        "class": "fa fa-bookmark",
        "aria-hidden": "true"
      })
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputWithLabel"], {
      label: "Patokan : ",
      value: formTransaksi["patokan"],
      onChange: function onChange(value) {
        setFormTransaksi(_objectSpread(_objectSpread({}, formTransaksi), {
          patokan: value
        }));
      },
      appendix: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
        "class": "fa fa-bookmark",
        "aria-hidden": "true"
      })
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputTextAreaWithLabel"], {
      label: "Catatan :",
      value: formTransaksi["catatan"],
      onChange: function onChange(value) {
        setFormTransaksi(_objectSpread(_objectSpread({}, formTransaksi), {
          catatan: value
        }));
      }
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputDatePickerWithLabel"], {
      label: "Waktu Pengiriman :",
      value: formTransaksi["waktu_pengiriman"],
      onChange: function onChange(value) {
        setFormTransaksi(_objectSpread(_objectSpread({}, formTransaksi), {
          waktu_pengiriman: value
        }));
      },
      appendix: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
        "class": "fa fa-calendar",
        "aria-hidden": "true"
      })
    }))
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    "class": "col-lg-4"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_7__["default"], {
    title: "Promo",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputModalSelectorWithLabel"], {
      label: "Promo: ",
      desc: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("small", null, "Gunakan Promo yang anda punya"),
      appendix: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
        "class": "fa fa-percent",
        "aria-hidden": "true"
      }),
      value: selectedVoucher,
      onChange: function onChange(selected) {
        setSelectedVoucher(selected);
        onVoucherSelected(selected);
      },
      items: isLoading ? [] : data,
      itemRenderer: function itemRenderer(currentItem, currentId, selected, setSelected) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          "class": classnames__WEBPACK_IMPORTED_MODULE_6___default()("card no-border mb-2", {
            'text-white': selected.id == currentItem.id,
            'bg-primary': selected.id == currentItem.id
          }),
          onClick: function onClick() {
            setSelected(currentItem);
          }
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          "class": "card-body "
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          className: "d-flex align-items-center"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("img", {
          src: currentItem.cover_image,
          style: {
            width: '100px',
            marginRight: '10px'
          },
          alt: ""
        })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h5", {
          "class": "card-title p-0"
        }, currentItem.name), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("p", {
          "class": "card-text p-0 m-0"
        }, currentItem.description), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_10__["Badge"], {
          variant: "info",
          className: "text-white"
        }, moment__WEBPACK_IMPORTED_MODULE_11___default()(currentItem.start_date).format('D-M-Y'), " \xA0 Sampai \xA0", moment__WEBPACK_IMPORTED_MODULE_11___default()(currentItem.end_date).format('D-M-Y')))))));
      }
    })), validatedDiscount && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, "Potongan  "), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h5", null, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(validatedDiscount.discount ? validatedDiscount.discount : 0).format("0,0"), " "))))
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("hr", null), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_7__["default"], {
    title: "Ringkasan Pesanan",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("small", null, "Daftar belanjaan anda"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, Object.keys(mappedByMitra).map(function (keyItem) {
      var item = mappedByMitra[keyItem];
      var mitra = item[0].mitra;
      var jarakkeMItra = getMapJarakMitra(mitra.id);
      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("b", null, mitra.name), item.map(function (cartItem) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          className: "d-flex flex-column "
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", null, cartItem.name, " x ", cartItem.jumlah), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "text-muted"
        }, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_5___default()((cartItem.selling_price - (cartItem.discount > 0 ? cartItem.discount : 0)) * cartItem.jumlah).format('0,0')));
      }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "d-flex flex-column"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, "Ongkos Kirim (", jarakkeMItra, " KM) "), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h6", null, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(jarakkeMItra * (mitra.detail_mitra ? mitra.detail_mitra.ongkir_km : 10000)).format("0,0")))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("hr", null));
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column mt-2"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, "Total Pesanan"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h5", null, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(getTotalTransaksi() - (validatedDiscount.discount ? validatedDiscount.discount : 0)).format("0,0"), " "))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column mt-2"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, "Total Ongkos Kirim"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h5", null, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(totalOngkir).format("0,0"), " "))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "d-flex flex-column mt-2"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, "Total "), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h5", null, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(getTotalTransaksi() - (validatedDiscount.discount ? validatedDiscount.discount : 0) + totalOngkir).format("0,0"), " ")))))
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("hr", null), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "d-flex flex-column mt-3"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, " "), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
    disabled: checkoutProcess,
    onClick: function onClick() {
      sendCheckoutRequest();
    },
    className: "btn btn-danger",
    style: {
      height: '50px',
      width: '100%',
      fontWeight: 'bold'
    }
  }, "Pembayaran ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
    "class": "fa fa-chevron-right",
    "aria-hidden": "true"
  }), " "))))))));
}

function PaymentPage(_ref4) {
  var createdTransaction = _ref4.createdTransaction;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "row justify-content-center"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "col-lg-10 d-flex  flex-column justify-content-center align-items-center "
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_7__["default"], {
    title: "Pembayaran"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "d-flex flex-column justify-content-center align-items-center"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("b", null, "Pesanan Anda anda sudah kami terima"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", null, "Dengan Total Transaksi : "), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      marginTop: '30px'
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h3", null, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(createdTransaction.total_transaksi ? createdTransaction.total_transaksi : 0).format('0,0')), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", null, "Silahkan klik tautan di bawah untuk melakukan pembayaran"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("a", {
    href: createdTransaction.payment ? createdTransaction.payment.deep_link_url : "",
    className: "btn btn-danger ",
    style: {
      fontWeight: 'bold',
      width: '300px',
      marginTop: '30px'
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
    "class": "fa fa-id-card",
    "aria-hidden": "true"
  }), " \xA0 Lakukan pembayaran")))));
}

function VoucherBox(_ref5) {
  var onVoucherValidated = _ref5.onVoucherValidated;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null);
}

/* harmony default export */ __webpack_exports__["default"] = (CartDetailContainer);

if (document.getElementById('cart-detail')) {
  var container = document.getElementById("cart-detail");
  var logedin = container.getAttribute("logedin");
  var verified = container.getAttribute("verified");
  react_dom__WEBPACK_IMPORTED_MODULE_2___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(CartDetailContainer, {
    logedin: logedin ? logedin : false,
    verified: verified ? verified : false
  }), container);
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

/***/ }),

/***/ "./resources/js/components/utls.js":
/*!*****************************************!*\
  !*** ./resources/js/components/utls.js ***!
  \*****************************************/
/*! exports provided: encodeQuery, calcCrow */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "encodeQuery", function() { return encodeQuery; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "calcCrow", function() { return calcCrow; });
function encodeQuery(data) {
  var query = "";

  for (var d in data) {
    query += encodeURIComponent(d) + '=' + encodeURIComponent(data[d]) + '&';
  }

  return query.slice(0, -1);
} // alert(calcCrow(59.3293371,13.4877472,59.3225525,13.4619422).toFixed(1));
//This function takes in latitude and longitude of two location and returns the distance between them as the crow flies (in km)


function calcCrow(lat1, lon1, lat2, lon2) {
  var R = 6371; // km

  var dLat = toRad(lat2 - lat1);
  var dLon = toRad(lon2 - lon1);
  var lat1 = toRad(lat1);
  var lat2 = toRad(lat2);
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  return d;
} // Converts numeric degrees to radians


function toRad(Value) {
  return Value * Math.PI / 180;
}



/***/ }),

/***/ "./resources/js/store/useCart.js":
/*!***************************************!*\
  !*** ./resources/js/store/useCart.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var zustand__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! zustand */ "./node_modules/zustand/index.js");
/* harmony import */ var zustand_middleware__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! zustand/middleware */ "./node_modules/zustand/middleware.js");
/* harmony import */ var zustand_middleware__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(zustand_middleware__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var underscore__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! underscore */ "./node_modules/underscore/modules/index-all.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }




var useCart = Object(zustand__WEBPACK_IMPORTED_MODULE_0__["default"])(Object(zustand_middleware__WEBPACK_IMPORTED_MODULE_1__["persist"])(function (set, get) {
  return {
    cart: {},
    addItem: function addItem(reqItem) {
      var cartState = localStorage.getItem("cart-storage") ? JSON.parse(localStorage.getItem("cart-storage")).state : {};
      console.log(cartState);
      set(function (state) {
        return {
          cart: _objectSpread(_objectSpread({}, cartState.cart), reqItem)
        };
      });
    },
    removeItem: function removeItem(key) {
      var tempState = _objectSpread({}, get().cart);

      delete tempState[key];
      set(function (state) {
        return {
          cart: tempState
        };
      });
    },
    removeAllItem: function removeAllItem() {
      return set({
        cart: {}
      });
    },
    getTotalTransaksi: function getTotalTransaksi() {
      var currentCart = _objectSpread({}, get().cart);

      return underscore__WEBPACK_IMPORTED_MODULE_2__["default"].reduce(Object.keys(currentCart), function (memo, iten) {
        var item = currentCart[iten];
        var realPrice = item.selling_price - (item.discount > 0 ? item.discount : 0);
        return Number(item.jumlah * realPrice) + Number(memo);
      }, 0);
    },
    mapCartByMitra: function mapCartByMitra() {
      var currentCart = _objectSpread({}, get().cart);

      var grouped = underscore__WEBPACK_IMPORTED_MODULE_2__["default"].groupBy(currentCart, function (item) {
        return item.mitra_id;
      });

      console.log(grouped);
      return grouped;
    }
  };
}, {
  name: "cart-storage",
  // unique name
  getStorage: function getStorage() {
    return localStorage;
  } // (optional) by default the 'localStorage' is used

}));
/* harmony default export */ __webpack_exports__["default"] = (useCart);

/***/ })

}]);