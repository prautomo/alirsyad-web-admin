(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[21],{

/***/ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/guru/components/Progress/DetailSimulasiPercobaan.css":
/*!***********************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/postcss-loader/src??ref--6-2!./resources/js/guru/components/Progress/DetailSimulasiPercobaan.css ***!
  \***********************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".label-progress {\n    font-size: 15px;\n    font-weight: 300;\n}", ""]);

// exports


/***/ }),

/***/ "./resources/js/guru/components/Progress/DetailSimulasiPercobaan.css":
/*!***************************************************************************!*\
  !*** ./resources/js/guru/components/Progress/DetailSimulasiPercobaan.css ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/postcss-loader/src??ref--6-2!./DetailSimulasiPercobaan.css */ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/guru/components/Progress/DetailSimulasiPercobaan.css");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./resources/js/guru/components/Progress/DetailSimulasiPercobaan.js":
/*!**************************************************************************!*\
  !*** ./resources/js/guru/components/Progress/DetailSimulasiPercobaan.js ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var react_table_scrollbar__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react-table-scrollbar */ "./node_modules/react-table-scrollbar/build/index.js");
/* harmony import */ var react_table_scrollbar__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react_table_scrollbar__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _store_useFetch__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../store/useFetch */ "./resources/js/store/useFetch.js");
/* harmony import */ var reactstrap__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! reactstrap */ "./node_modules/reactstrap/es/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _DetailSimulasiPercobaan_css__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./DetailSimulasiPercobaan.css */ "./resources/js/guru/components/Progress/DetailSimulasiPercobaan.css");
/* harmony import */ var _DetailSimulasiPercobaan_css__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_DetailSimulasiPercobaan_css__WEBPACK_IMPORTED_MODULE_7__);








function DetailSimulasiPercobaan(_ref) {
  var _data$data$jumlah_per, _data$data, _data$data$jumlah_ben, _data$data2, _data$data$jumlah_sal, _data$data3, _data$data$percobaan_, _data$data4, _data$data$percobaan_2, _data$data5, _data$data$nilai_akhi, _data$data6;
  var idSimulasi = _ref.idSimulasi,
    idSiswa = _ref.idSiswa;
  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_4__["default"])("/guru/json/simulasi/".concat(idSimulasi, "/nilai?q_siswa_id=").concat(idSiswa)),
    data = _useFetch.data,
    isLoading = _useFetch.isLoading,
    isError = _useFetch.isError;
  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {}, []);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, isLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("p", null, "Loading...") : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Row"], {
    className: "mb-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "label-progress"
  }, "Total Percobaan")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "label-progress"
  }, ": ", (_data$data$jumlah_per = data === null || data === void 0 || (_data$data = data.data) === null || _data$data === void 0 ? void 0 : _data$data.jumlah_percobaan) !== null && _data$data$jumlah_per !== void 0 ? _data$data$jumlah_per : 0))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Row"], {
    className: "mb-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "label-progress"
  }, "Jumlah Berhasil")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "label-progress"
  }, ": ", (_data$data$jumlah_ben = data === null || data === void 0 || (_data$data2 = data.data) === null || _data$data2 === void 0 ? void 0 : _data$data2.jumlah_benar) !== null && _data$data$jumlah_ben !== void 0 ? _data$data$jumlah_ben : 0))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Row"], {
    className: "mb-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "label-progress"
  }, "Jumlah Gagal")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "label-progress"
  }, ": ", (_data$data$jumlah_sal = data === null || data === void 0 || (_data$data3 = data.data) === null || _data$data3 === void 0 ? void 0 : _data$data3.jumlah_salah) !== null && _data$data$jumlah_sal !== void 0 ? _data$data$jumlah_sal : 0))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Row"], {
    className: "mb-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    md: "12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "label-progress"
  }, "Jumlah Berhasil 10 Percobaan Terakhir: ", (_data$data$percobaan_ = data === null || data === void 0 || (_data$data4 = data.data) === null || _data$data4 === void 0 || (_data$data4 = _data$data4.percobaan_terakhir) === null || _data$data4 === void 0 ? void 0 : _data$data4.jumlah_benar) !== null && _data$data$percobaan_ !== void 0 ? _data$data$percobaan_ : 0))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Row"], {
    className: "mb-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    md: "12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "label-progress"
  }, "Jumlah Gagal 10 Percobaan Terakhir: ", (_data$data$percobaan_2 = data === null || data === void 0 || (_data$data5 = data.data) === null || _data$data5 === void 0 || (_data$data5 = _data$data5.percobaan_terakhir) === null || _data$data5 === void 0 ? void 0 : _data$data5.jumlah_salah) !== null && _data$data$percobaan_2 !== void 0 ? _data$data$percobaan_2 : 0))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("hr", {
    className: "my-1"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Row"], {
    className: ""
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "label-progress font-weight-bolder"
  }, "Nilai Akhir Siswa")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "label-progress font-weight-bolder"
  }, ": ", (_data$data$nilai_akhi = data === null || data === void 0 || (_data$data6 = data.data) === null || _data$data6 === void 0 ? void 0 : _data$data6.nilai_akhir) !== null && _data$data$nilai_akhi !== void 0 ? _data$data$nilai_akhi : 0)))));
}
/* harmony default export */ __webpack_exports__["default"] = (DetailSimulasiPercobaan);
var container = document.getElementById("detail-simulasi-percobaan");
if (container) {
  var idSimulasi = container.getAttribute("simulasi-id");
  var idSiswa = container.getAttribute("siswa-id");
  react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(DetailSimulasiPercobaan, {
    idSimulasi: idSimulasi,
    idSiswa: idSiswa
  }), container);
}

/***/ }),

/***/ "./resources/js/store/useFetch.js":
/*!****************************************!*\
  !*** ./resources/js/store/useFetch.js ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return useFetch; });
/* harmony import */ var swr__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swr */ "./node_modules/swr/esm/index.js");

function useFetch(url) {
  var _useSWR = Object(swr__WEBPACK_IMPORTED_MODULE_0__["default"])(url, window.getAxios),
    data = _useSWR.data,
    error = _useSWR.error;
  return {
    data: data,
    isLoading: !error && !data,
    isError: error
  };
}

/***/ })

}]);