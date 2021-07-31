(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[12],{

/***/ "./resources/js/components/Form/Pagination.js":
/*!****************************************************!*\
  !*** ./resources/js/components/Form/Pagination.js ***!
  \****************************************************/
/*! exports provided: Pagination */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Pagination", function() { return Pagination; });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_bootstrap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-bootstrap */ "./node_modules/react-bootstrap/esm/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_3__);
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }






function Pagination(_ref) {
  var pagination = _ref.pagination,
      setPageConfig = _ref.setPageConfig,
      pageConfig = _ref.pageConfig;
  var pageRangeStart = pagination.current_page - 3 > 0 ? pagination.current_page - 3 : 1;
  var pageRangeEnd = pagination.current_page + 4 <= pagination.last_page ? pagination.current_page + 4 : pagination.last_page + 1;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex justify-content-center align-items-center"
  }, pagination.prev_page_url && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("i", {
    "class": "fa fa-chevron-left",
    "aria-hidden": "true",
    onClick: function onClick() {
      setPageConfig(_objectSpread(_objectSpread({}, pageConfig), {
        page: pagination.current_page - 1
      }));
    },
    style: {
      fontSize: '30px',
      color: 'red',
      width: '40px',
      cursor: 'pointer'
    }
  }), Object(lodash__WEBPACK_IMPORTED_MODULE_3__["range"])(pageRangeStart, pageRangeEnd).map(function (page) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("button", {
      onClick: function onClick() {
        setPageConfig(_objectSpread(_objectSpread({}, pageConfig), {
          page: page
        }));
      },
      className: classnames__WEBPACK_IMPORTED_MODULE_2___default()("btn", {
        'btn-danger': page == pagination.current_page
      })
    }, page);
  }), pagination.next_page_url && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("i", {
    "class": "fa fa-chevron-right",
    "aria-hidden": "true",
    onClick: function onClick() {
      setPageConfig(_objectSpread(_objectSpread({}, pageConfig), {
        page: pagination.current_page + 1
      }));
    },
    style: {
      fontSize: '30px',
      color: 'red',
      width: '40px',
      textAlign: 'right',
      cursor: 'pointer'
    }
  })));
}



/***/ }),

/***/ "./resources/js/components/Products/per_toko.js":
/*!******************************************************!*\
  !*** ./resources/js/components/Products/per_toko.js ***!
  \******************************************************/
/*! exports provided: default, Pagination, ProductItems */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ProductItems", function() { return ProductItems; });
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
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "Pagination", function() { return _Form_Pagination__WEBPACK_IMPORTED_MODULE_6__["Pagination"]; });

/* harmony import */ var _assets_loading_svg__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../assets/loading.svg */ "./resources/js/components/assets/loading.svg");
/* harmony import */ var _assets_loading_svg__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_assets_loading_svg__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _utls__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../utls */ "./resources/js/components/utls.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }











function ProductTokoContainer(_ref) {
  var initialPageConfig = _ref.initialPageConfig,
      tokoDetail = _ref.tokoDetail;

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState2 = _slicedToArray(_useState, 2),
      pageConfig = _useState2[0],
      setPageConfig = _useState2[1];

  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    setPageConfig(initialPageConfig);
  }, []);

  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_3__["default"])("/app/data/getproducts?" + Object(_utls__WEBPACK_IMPORTED_MODULE_8__["encodeQuery"])(_objectSpread({}, pageConfig))),
      data = _useFetch.data,
      isLoading = _useFetch.isLoading,
      isError = _useFetch.isError;

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      marginTop: '100px'
    },
    className: "d-flex flex-column align-items-start"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "mb-4 mt-4 prod-page-header"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h3", null, "Produk Di Toko ", tokoDetail.name)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "row",
    style: {
      width: '100%'
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "col-lg-3"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(RenderFilter, {
    setPageConfig: setPageConfig,
    pageConfig: pageConfig
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "col-lg-9"
  }, isLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(LoadingScreen, null) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(RenderProducts, {
    items: data
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_Pagination__WEBPACK_IMPORTED_MODULE_6__["Pagination"], {
    pagination: data,
    setPageConfig: setPageConfig,
    pageConfig: pageConfig
  })))))));
}

function LoadingScreen() {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    "class": "card card-no-locations col-lg-12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    "class": "card-body  text-center "
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("img", {
    src: _assets_loading_svg__WEBPACK_IMPORTED_MODULE_7___default.a,
    "class": "",
    width: "200px",
    alt: ""
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("p", {
    "class": "card-text text-center mt-2"
  }, "Sedang Mengambil Data"))));
}

function RenderProducts(_ref2) {
  var items = _ref2.items;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "row"
  }, items.data.map(function (item) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(ProductItems, {
      item: item
    });
  })));
}

function RenderFilter(_ref3) {
  var item = _ref3.item,
      pageConfig = _ref3.pageConfig,
      setPageConfig = _ref3.setPageConfig;
  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    setTempPageConfig(pageConfig);
  }, [pageConfig]);

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])({}),
      _useState4 = _slicedToArray(_useState3, 2),
      tempPageConfig = _useState4[0],
      setTempPageConfig = _useState4[1];

  var _useFetch2 = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_3__["default"])("/app/data/getbrand"),
      data = _useFetch2.data,
      isLoading = _useFetch2.isLoading,
      isError = _useFetch2.isError;

  var kategoriData = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_3__["default"])("/app/data/getsubcategory").data;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "d-flex flex-column md-none mb-4"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h3", {
    className: "mb-4"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("b", null, "Filter Produk")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "md-none"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputWithLabel"], {
    value: tempPageConfig['nama_produk'],
    onChange: function onChange(selected) {
      setTempPageConfig(_objectSpread(_objectSpread({}, tempPageConfig), {
        "nama_produk": selected
      }));
    },
    label: "Nama Produk",
    placeholder: "Ex: cat"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputWithLabel"], {
    type: "number",
    value: tempPageConfig['harga_minumum'],
    onChange: function onChange(selected) {
      setTempPageConfig(_objectSpread(_objectSpread({}, tempPageConfig), {
        "harga_minumum": selected
      }));
    },
    label: "Harga Minimum",
    appendix: "Rp.",
    placeholder: "Ex: 50.000"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputWithLabel"], {
    type: "number",
    value: tempPageConfig['harga_maximum'],
    onChange: function onChange(selected) {
      setTempPageConfig(_objectSpread(_objectSpread({}, tempPageConfig), {
        "harga_maximum": selected
      }));
    },
    label: "Harga Maksimum",
    appendix: "Rp.",
    placeholder: "Ex: 500.000"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputSelectWithLabel"], {
    value: tempPageConfig['kategori'],
    onChange: function onChange(selected) {
      setTempPageConfig(_objectSpread(_objectSpread({}, tempPageConfig), {
        "kategori": selected
      }));
    },
    label: "Kategori",
    placeholder: "--Pilih Kategori--",
    items: kategoriData
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputSelectWithLabel"], {
    value: tempPageConfig['brand'],
    onChange: function onChange(selected) {
      setTempPageConfig(_objectSpread(_objectSpread({}, tempPageConfig), {
        "brand": selected
      }));
    },
    label: "Brand",
    placeholder: "--Pilih Brand--",
    items: data
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputChooseWithLabel"], {
    value: tempPageConfig['urutan'],
    onChange: function onChange(selected) {
      setTempPageConfig(_objectSpread(_objectSpread({}, tempPageConfig), {
        "urutan": selected
      }));
    },
    label: "Urutan",
    items: {
      HARGA_TERENDAH: "Harga Terendah - Tertinggi",
      HARGA_TERTINGGI: "Harga Tertinggi - Terendah"
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputCheckWithLabel"], {
    value: tempPageConfig['urutan_a_Z'],
    onChange: function onChange(selected) {
      setTempPageConfig(_objectSpread(_objectSpread({}, tempPageConfig), {
        "urutan_a_Z": selected
      }));
    },
    items: {
      URUTAN_A_Z: "Urutan dari A - Z"
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_4__["InputCheckWithLabel"], {
    value: tempPageConfig['urutan_penjualan'],
    onChange: function onChange(selected) {
      setTempPageConfig(_objectSpread(_objectSpread({}, tempPageConfig), {
        "urutan_penjualan": selected
      }));
    },
    items: {
      URUTAN_PENJUALAN: "Uratan berdasarkan penjualan"
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "mt-4"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
    onClick: function onClick() {
      setPageConfig(tempPageConfig);
    },
    className: "btn btn-danger",
    style: {
      width: '100%',
      height: '50px'
    }
  }, "Terapkan filter")))));
}

function ProductItems(_ref4) {
  var item = _ref4.item;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    "class": "col-lg-3 mb-4"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "d-flex flex-column product-container"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("img", {
    src: item.cover.image_url,
    "class": "img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}",
    alt: ""
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "p-2 d-flex flex-column"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("a", {
    href: "/product/detail/" + (item.sku_id ? item.sku_id : "")
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "prod_name"
  }, item.name)), item.discount > 0 && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("strike", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    style: {
      color: "#F26525"
    },
    className: "pb-2 striped_price"
  }, "Rp ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(item.price).format("0,0")))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    style: {
      color: "#F26525"
    },
    className: "pb-2 prod_price"
  }, "Rp ", numeral__WEBPACK_IMPORTED_MODULE_5___default()(item.price - (item.discount ? item.discount : 0)).format("0,0")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "prod_mitra"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("i", {
    "class": "fa fa-home",
    color: "",
    "aria-hidden": "true"
  }), " \xA0 ", item.mitra.name), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("a", {
    href: "/product/detail/" + (item.sku_id ? item.sku_id : ""),
    className: "btn btn-danger w-100 text-white"
  }, "Detail")))));
}

/* harmony default export */ __webpack_exports__["default"] = (ProductTokoContainer);


if (document.getElementById('products-container-toko')) {
  var container = document.getElementById("products-container-toko");
  var tokoDetail = container.getAttribute("toko_detail") ? JSON.parse(container.getAttribute("toko_detail")) : {};
  var search_nama_produk = container.getAttribute("search_nama_produk");
  var search_kategori_id = container.getAttribute("subcategory");
  var brand_id = container.getAttribute("brand_id");
  var initialPageConfig = {
    mitra_id: tokoDetail.id,
    nama_produk: search_nama_produk ? search_nama_produk : "",
    kategori: search_kategori_id ? search_kategori_id : "",
    brand: brand_id ? brand_id : ""
  };
  react_dom__WEBPACK_IMPORTED_MODULE_2___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(ProductTokoContainer, {
    initialPageConfig: initialPageConfig,
    tokoDetail: tokoDetail
  }), container);
}

/***/ }),

/***/ "./resources/js/components/assets/loading.svg":
/*!****************************************************!*\
  !*** ./resources/js/components/assets/loading.svg ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/loading.svg?18c817a3629b66748247d40c6234c549";

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



/***/ })

}]);