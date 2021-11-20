(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/guru/components/Progress/DetailSimulasiPercobaan.css":
/*!***********************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/postcss-loader/src??ref--6-2!./resources/js/guru/components/Progress/DetailSimulasiPercobaan.css ***!
  \***********************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".label-progress {\r\n    font-size: 15px;\r\n    font-weight: 300;\r\n}", ""]);

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
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var react_table_scrollbar__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-table-scrollbar */ "./node_modules/react-table-scrollbar/build/index.js");
/* harmony import */ var react_table_scrollbar__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(react_table_scrollbar__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _store_useFetch__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../../store/useFetch */ "./resources/js/store/useFetch.js");
/* harmony import */ var reactstrap__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! reactstrap */ "./node_modules/reactstrap/es/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _DetailSimulasiPercobaan_css__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./DetailSimulasiPercobaan.css */ "./resources/js/guru/components/Progress/DetailSimulasiPercobaan.css");
/* harmony import */ var _DetailSimulasiPercobaan_css__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_DetailSimulasiPercobaan_css__WEBPACK_IMPORTED_MODULE_8__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }










function DetailSimulasiPercobaan(_ref) {
  var idSimulasi = _ref.idSimulasi,
      idSiswa = _ref.idSiswa;

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(-1),
      _useState2 = _slicedToArray(_useState, 2),
      activeTab = _useState2[0],
      setActiveTab = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState4 = _slicedToArray(_useState3, 2),
      isLoadingSiswa = _useState4[0],
      setIsLoadingSiswa = _useState4[1];

  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])([]),
      _useState6 = _slicedToArray(_useState5, 2),
      dataSiswa = _useState6[0],
      setDataSiswa = _useState6[1];

  var _useState7 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(0),
      _useState8 = _slicedToArray(_useState7, 2),
      mapelIdActive = _useState8[0],
      setMapelIdActive = _useState8[1];

  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_5__["default"])("/api/guru/simulasi/".concat(idSimulasi, "/nilai?q_siswa_id=").concat(idSiswa)),
      data = _useFetch.data,
      isLoading = _useFetch.isLoading,
      isError = _useFetch.isError;

  var toggleTab = /*#__PURE__*/function () {
    var _ref2 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(tab, mapelId, kelasId) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              // set mapel id
              setMapelIdActive(mapelId); // load data

              _context.next = 3;
              return loadSiswa(mapelId, kelasId);

            case 3:
              // switch tab
              if (activeTab !== tab) setActiveTab(tab);

            case 4:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));

    return function toggleTab(_x, _x2, _x3) {
      return _ref2.apply(this, arguments);
    };
  }();

  function loadSiswa(_x4, _x5) {
    return _loadSiswa.apply(this, arguments);
  }

  function _loadSiswa() {
    _loadSiswa = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(mapelId, kelasId) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              setIsLoadingSiswa(true);
              _context2.next = 3;
              return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/guru/json/getSiswa?mata_pelajaran_id=".concat(mapelId, "&kelas_id=").concat(kelasId), {
                headers: {
                  "Content-Type": "application/json"
                }
              }).then(function (response) {
                var data = response.data;

                if (data.success) {
                  setDataSiswa(data === null || data === void 0 ? void 0 : data.data);
                }
              })["catch"](function (e) {
                var _e$response, _e$response$data;

                console.error("dika error", e === null || e === void 0 ? void 0 : (_e$response = e.response) === null || _e$response === void 0 ? void 0 : (_e$response$data = _e$response.data) === null || _e$response$data === void 0 ? void 0 : _e$response$data.message);
              });

            case 3:
              setIsLoadingSiswa(false);

            case 4:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2);
    }));
    return _loadSiswa.apply(this, arguments);
  }

  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {}, []);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, isLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("p", null, "Loading...") : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Row"], {
    className: "mb-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "label-progress"
  }, "Total Percobaan")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "label-progress"
  }, ": 12"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Row"], {
    className: "mb-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "label-progress"
  }, "Jumlah Berhasil")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "label-progress"
  }, ": 12"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Row"], {
    className: "mb-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "label-progress"
  }, "Jumlah Gagal")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "label-progress"
  }, ": 12"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Row"], {
    className: "mb-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    md: "12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "label-progress"
  }, "Jumlah Berhasil 10 Percobaan Terakhir: 10"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Row"], {
    className: "mb-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    md: "12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "label-progress"
  }, "Jumlah Gagal 10 Percobaan Terakhir: 0"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("hr", {
    className: "my-1"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Row"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "label-progress"
  }, "Nilai Akhir Siswa")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    md: "6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    className: "label-progress"
  }, ": 12")))));
}

/* harmony default export */ __webpack_exports__["default"] = (DetailSimulasiPercobaan);
var container = document.getElementById("detail-simulasi-percobaan");

if (container) {
  var idSimulasi = container.getAttribute("simulasi-id");
  var idSiswa = container.getAttribute("siswa-id");
  react_dom__WEBPACK_IMPORTED_MODULE_2___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(DetailSimulasiPercobaan, {
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