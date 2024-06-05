(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[35],{

/***/ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/backoffice/components/Dashboard/index.css":
/*!************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/postcss-loader/src??ref--6-2!./resources/js/backoffice/components/Dashboard/index.css ***!
  \************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".dashboard-final-score {\r\n    background: #F6D0A14D;\r\n    padding: 10px 20px;\r\n    border-radius: 4px !important;\r\n    color: #E98A15 !important;\r\n}\r\n\r\n.dashboard-filter .bootstrap-select {\r\n    width: 200px !important;\r\n}", ""]);

// exports


/***/ }),

/***/ "./resources/js/backoffice/components/Dashboard/GuruMapel.js":
/*!*******************************************************************!*\
  !*** ./resources/js/backoffice/components/Dashboard/GuruMapel.js ***!
  \*******************************************************************/
/*! exports provided: options, data, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "options", function() { return options; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "data", function() { return data; });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _index_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./index.css */ "./resources/js/backoffice/components/Dashboard/index.css");
/* harmony import */ var _index_css__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_index_css__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var chart_js_auto_auto_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! chart.js/auto/auto.js */ "./node_modules/chart.js/auto/auto.js");
/* harmony import */ var chart_js_auto_auto_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(chart_js_auto_auto_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var chartjs_plugin_datalabels__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! chartjs-plugin-datalabels */ "./node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.esm.js");
/* harmony import */ var react_chartjs_2__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react-chartjs-2 */ "./node_modules/react-chartjs-2/dist/index.js");
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }






chart_js_auto_auto_js__WEBPACK_IMPORTED_MODULE_3__["Chart"].register(chart_js_auto_auto_js__WEBPACK_IMPORTED_MODULE_3__["CategoryScale"], chart_js_auto_auto_js__WEBPACK_IMPORTED_MODULE_3__["LinearScale"], chart_js_auto_auto_js__WEBPACK_IMPORTED_MODULE_3__["BarElement"], chart_js_auto_auto_js__WEBPACK_IMPORTED_MODULE_3__["Title"], chart_js_auto_auto_js__WEBPACK_IMPORTED_MODULE_3__["Tooltip"], chart_js_auto_auto_js__WEBPACK_IMPORTED_MODULE_3__["Legend"], chartjs_plugin_datalabels__WEBPACK_IMPORTED_MODULE_4__["default"]);
var options = {
  responsive: true,
  plugins: {
    legend: {
      display: false
    },
    datalabels: {
      display: true,
      align: 'center',
      anchor: 'center',
      color: 'white'
    },
    title: {
      display: false
    },
    scales: {
      y: {
        ticks: {
          stepSize: 500
        }
      }
    }
  }
};
var data = {
  undefined: undefined,
  datasets: [{
    label: 'Score',
    data: [],
    backgroundColor: 'rgba(2, 65, 2, 1)'
  }]
};
function DashboardGuruMapel() {
  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(data),
    _useState2 = _slicedToArray(_useState, 2),
    configData = _useState2[0],
    setConfigData = _useState2[1];
  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])([]),
    _useState4 = _slicedToArray(_useState3, 2),
    datas = _useState4[0],
    setDatas = _useState4[1];
  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    if (datas.length < 1) {
      setDatas([{
        label: "5A",
        score: 1376
      }, {
        label: "5B",
        score: 1518
      }]);
    }
  }, []);
  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    var labels = [];
    var tempScores = [];
    for (var i = 0; i < datas.length; i++) {
      var _data = datas[i];
      labels.push(_data.label);
      tempScores.push(_data.score);
    }
    setConfigData({
      labels: labels,
      datasets: [{
        label: 'Score',
        data: tempScores,
        backgroundColor: 'rgba(2, 65, 2, 1)',
        borderRadius: 10,
        minBarLength: 1,
        barThickness: 120
      }]
    });
  }, [datas]);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "row mb-4"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "col-12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center'
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    style: {
      marginLeft: 'auto'
    },
    "class": "dashboard-filter"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("label", {
    className: "my-auto mr-2",
    style: {
      color: "#9E9E9E"
    }
  }, "Filter By"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("select", {
    id: "mapel",
    name: "mapel",
    "data-style": "btn-green-pastel",
    "class": "selectpicker mr-2",
    placeholder: "Mata Pelajaran"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: ""
  }, "Mata Pelajaran"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: "matematika"
  }, "MTK")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("select", {
    id: "jenjang",
    name: "jenjang",
    "data-style": "btn-green-pastel",
    "class": "selectpicker mr-2",
    placeholder: "Jenjang"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: ""
  }, "Semua Jenjang"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: "sd"
  }, "SD")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("select", {
    id: "tingkat",
    name: "tingkat",
    "data-style": "btn-green-pastel",
    "class": "selectpicker mr-2",
    placeholder: "Tingkat"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: ""
  }, "Semua Tingkat"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: "5"
  }, "5"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: "6"
  }, "6")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("select", {
    id: "kelas",
    name: "kelas",
    "data-style": "btn-green-pastel",
    multiple: true,
    "class": "selectpicker mr-2",
    placeholder: "Kelas"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: ""
  }, "Semua Kelas"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: "5a"
  }, "5 A"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: "5b"
  }, "5 B")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("select", {
    id: "module",
    name: "module",
    "data-style": "btn-green-pastel",
    "class": "selectpicker mr-2",
    placeholder: "Module"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: ""
  }, "Semua Module"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: "5"
  }, "5"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: "6"
  }, "6")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("select", {
    id: "submodule",
    name: "submodule",
    "data-style": "btn-green-pastel",
    "class": "selectpicker mr-2",
    placeholder: "Sub-Module"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: ""
  }, "Semua Sub-Module"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: "5"
  }, "5"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: "6"
  }, "6")))))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "row"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "col-12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "card"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "card-body"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center'
    },
    className: "mb-3"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "text-primary"
  }, "Matematika"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "dashboard-final-score",
    style: {
      marginLeft: 'auto'
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, "Final Score 5A : 1376"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    style: {
      borderLeft: "1px solid #F6D0A1",
      marginLeft: "5px",
      marginRight: "5px"
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, "Final Score 5B : 1518"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_chartjs_2__WEBPACK_IMPORTED_MODULE_5__["Bar"], {
    options: options,
    data: configData
  }))))));
}
/* harmony default export */ __webpack_exports__["default"] = (DashboardGuruMapel);
if (document.getElementById('dashboard-guru-mapel')) {
  react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(DashboardGuruMapel, null), document.getElementById('dashboard-guru-mapel'));
}

/***/ }),

/***/ "./resources/js/backoffice/components/Dashboard/index.css":
/*!****************************************************************!*\
  !*** ./resources/js/backoffice/components/Dashboard/index.css ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/postcss-loader/src??ref--6-2!./index.css */ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/backoffice/components/Dashboard/index.css");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ })

}]);