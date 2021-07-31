(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[19],{

/***/ "./resources/js/components/Breadcomb.js":
/*!**********************************************!*\
  !*** ./resources/js/components/Breadcomb.js ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return BreadCumb; });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_1__);


function BreadCumb(_ref) {
  var params = _ref.params;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex align-items-center"
  }, Object.keys(params).map(function (value, index) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, index != 0 && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("i", {
      "class": "fa fa-chevron-right",
      "aria-hidden": "true"
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
      style: {
        padding: '10px'
      },
      className: classnames__WEBPACK_IMPORTED_MODULE_1___default()({
        'text-muted': index != Object.keys(params).length - 1,
        'font-weight-bold': index == Object.keys(params).length - 1
      })
    }, params[value]));
  })));
}

/***/ }),

/***/ "./resources/js/components/Products/detail.js":
/*!****************************************************!*\
  !*** ./resources/js/components/Products/detail.js ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _store_useFetch__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../store/useFetch */ "./resources/js/store/useFetch.js");
/* harmony import */ var _Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../Form/InputRenderer */ "./resources/js/components/Form/InputRenderer.js");
/* harmony import */ var numeral__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! numeral */ "./node_modules/numeral/numeral.js");
/* harmony import */ var numeral__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(numeral__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _Form_Pagination__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../Form/Pagination */ "./resources/js/components/Form/Pagination.js");
/* harmony import */ var _assets_loading_svg__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../assets/loading.svg */ "./resources/js/components/assets/loading.svg");
/* harmony import */ var _assets_loading_svg__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_assets_loading_svg__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _Breadcomb__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../Breadcomb */ "./resources/js/components/Breadcomb.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var _SimpleContainer__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../SimpleContainer */ "./resources/js/components/SimpleContainer.js");
/* harmony import */ var _store_useCart__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../../store/useCart */ "./resources/js/store/useCart.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var _per_toko__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./per_toko */ "./resources/js/components/Products/per_toko.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
















function ProductDetailContainer(_ref) {
  var prod_id = _ref.prod_id;

  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_3__["default"])("/product/detail/" + prod_id),
      data = _useFetch.data,
      isLoading = _useFetch.isLoading,
      isError = _useFetch.isError;

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "row",
    style: {
      marginTop: '100px'
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "col-lg-12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Breadcomb__WEBPACK_IMPORTED_MODULE_8__["default"], {
    params: {
      "/": "Home",
      "/produk": "Produk",
      "": data ? data.name : "Product Name"
    }
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "col-lg-6"
  }, isLoading ? "Loading" : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(GaleryRender, {
    cover: data.cover,
    galery: data.galery
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      marginTop: '50px'
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_10__["default"], {
    title: "Detail Produk & Spesifikasi",
    content: (data.spesification ? data.spesification : "").split("\n").map(function (item) {
      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
        className: "detail_info"
      }, item);
    })
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      marginTop: '50px'
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_10__["default"], {
    title: "Keunggulan :",
    content: (data.keunggulan ? data.keunggulan : "").split("\n").map(function (item) {
      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
        className: "detail_info"
      }, item);
    })
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      marginTop: '50px'
    }
  }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "col-lg-6"
  }, isLoading ? "Loading" : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h2", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("b", null, data.name), "\xA0 ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "text-muted"
  }, "(Terjual : ", data.terjual, ")")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_10__["default"], {
    title: "Deskripsi :",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
      className: "detail_info"
    }, data.description)
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      marginTop: '30px'
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_10__["default"], {
    title: "SKU :",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
      className: "detail_info"
    }, data.code)
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      marginTop: '30px'
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_10__["default"], {
    title: "Harga :",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, data.discount > 0 && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("strike", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h4", {
      className: "pb-2 striped_price text-muted"
    }, "Rp ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(data.selling_price).format("0,0")))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h3", {
      className: "pb-2 prod_price"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("b", null, "Rp ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(data.selling_price - (data.discount ? data.discount : 0)).format("0,0"))))
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      marginTop: '30px'
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(ItemCountPicker, {
    item: data
  }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "col-lg-12"
  }, isLoading ? "Loading" : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("hr", null), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_SimpleContainer__WEBPACK_IMPORTED_MODULE_10__["default"], {
    title: "Rekomendasi",
    content: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: "row"
    }, data.recomendations ? data.recomendations.map(function (item) {
      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_per_toko__WEBPACK_IMPORTED_MODULE_13__["ProductItems"], {
        item: item
      });
    }) : "Tidak Ada Rekomendasi"))
  })))));
}

function ItemCountPicker(_ref2) {
  var item = _ref2.item;

  var _useCart = Object(_store_useCart__WEBPACK_IMPORTED_MODULE_11__["default"])(),
      cart = _useCart.cart,
      addItem = _useCart.addItem,
      removeItem = _useCart.removeItem;

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState2 = _slicedToArray(_useState, 2),
      inCart = _useState2[0],
      setInCart = _useState2[1];

  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    setJumlah(cart[item.sku_id] ? cart[item.sku_id].jumlah : 0);
    setInCart(cart[item.sku_id] ? true : false);
  }, [cart]);

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(1),
      _useState4 = _slicedToArray(_useState3, 2),
      jumlah = _useState4[0],
      setJumlah = _useState4[1];

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "d-flex flex-column"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "d-flex align-items-center  justify-content-between",
    style: {
      width: '177.93px',
      height: '60px',
      border: "1px solid #BEBEBE"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
    className: "btn ",
    style: {
      width: '60px',
      height: '60px'
    },
    onClick: function onClick() {
      setJumlah(jumlah - 1 >= 0 ? jumlah - 1 : 0);
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
    "class": "fa fa-minus",
    "aria-hidden": "true"
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h3", {
    className: "mb-0"
  }, jumlah), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
    className: "btn",
    style: {
      width: '60px',
      height: '60px'
    },
    onClick: function onClick() {
      setJumlah(jumlah + 1 < 1000 ? jumlah + 1 : 1000);
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
    "class": "fa fa-plus",
    "aria-hidden": "true"
  }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      marginTop: '20px'
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
    className: "w-100 btn btn-danger font-weight-bold",
    style: {
      height: '60px'
    },
    onClick: function onClick() {
      if (jumlah > 0) {
        var tmpItem = {};
        tmpItem[item.sku_id] = _objectSpread(_objectSpread({}, item), {
          jumlah: jumlah
        });
        addItem(tmpItem);
        sweetalert2__WEBPACK_IMPORTED_MODULE_12___default.a.fire("Keranjang Belanja", item.name + "  berhasil di tambahkan ke keranjang", "success");
      } else if (inCart && jumlah == 0) {
        sweetalert2__WEBPACK_IMPORTED_MODULE_12___default.a.fire({
          title: 'Keranjang belanja',
          text: "Anda yakin akan mengeluarkan " + item.name + "  dari keranjang",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya'
        }).then(function (result) {
          if (result.isConfirmed) {
            removeItem(item.sku_id);
          }
        });
      }
    }
  }, " ", inCart && jumlah == 0 ? "Keluarkan Dari Keranjang " : "Masukan Keranjang")));
}

function GaleryRender(_ref3) {
  var cover = _ref3.cover,
      galery = _ref3.galery;
  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    setCurretnCover(cover ? cover : galery[0]);
  }, []);

  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState6 = _slicedToArray(_useState5, 2),
      curretnCover = _useState6[0],
      setCurretnCover = _useState6[1];

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "d-flex flex-column justify-items-center"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "galery-cover d-flex align-items-center justify-content-center "
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("img", {
    src: curretnCover.image_url,
    style: {
      height: '300px'
    },
    "class": "img-fluid ",
    alt: ""
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: " d-flex align-items-center flex-wrap justify-content-center",
    style: {
      margin: '0px'
    }
  }, galery.map(function (galeryItem) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
      className: classnames__WEBPACK_IMPORTED_MODULE_9___default()("d-flex  align-items-center thumb-container", {
        'active': galeryItem.id == curretnCover.id
      }),
      onClick: function onClick() {
        setCurretnCover(galeryItem);
      }
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("img", {
      src: galeryItem.image_url,
      "class": "img-fluid ",
      alt: ""
    }));
  })))));
}

/* harmony default export */ __webpack_exports__["default"] = (ProductDetailContainer);

if (document.getElementById('products-detail')) {
  var container = document.getElementById("products-detail");
  var prod_id = container.getAttribute("prod_id");
  react_dom__WEBPACK_IMPORTED_MODULE_2___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(ProductDetailContainer, {
    prod_id: prod_id
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