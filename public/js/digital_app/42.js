(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[42],{

/***/ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/backoffice/components/Dashboard/index.css":
/*!************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/postcss-loader/src??ref--6-2!./resources/js/backoffice/components/Dashboard/index.css ***!
  \************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".dashboard-final-score {\n    background: #F6D0A14D;\n    padding: 10px 20px;\n    border-radius: 4px !important;\n    color: #E98A15 !important;\n}\n\n.dashboard-filter .bootstrap-select {\n    width: 200px !important;\n}", ""]);

// exports


/***/ }),

/***/ "./resources/js/backoffice/components/Dashboard/KepalaSekolah.js":
/*!***********************************************************************!*\
  !*** ./resources/js/backoffice/components/Dashboard/KepalaSekolah.js ***!
  \***********************************************************************/
/*! exports provided: options, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "options", function() { return options; });
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
/* harmony import */ var react_loader_spinner__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react-loader-spinner */ "./node_modules/react-loader-spinner/dist/module.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
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
  },
  onHover: function onHover(event, chartElement) {
    event["native"].target.style.cursor = chartElement[0] ? 'pointer' : 'default';
  }
};
function DashboardKepalaSekolah() {
  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])([]),
    _useState2 = _slicedToArray(_useState, 2),
    listConfigData = _useState2[0],
    setListConfigData = _useState2[1];
  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])([]),
    _useState4 = _slicedToArray(_useState3, 2),
    listDatas = _useState4[0],
    setListDatas = _useState4[1];
  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])([]),
    _useState6 = _slicedToArray(_useState5, 2),
    listDataIds = _useState6[0],
    setListDataIds = _useState6[1];
  var _useState7 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])({}),
    _useState8 = _slicedToArray(_useState7, 2),
    nextApi = _useState8[0],
    setNextApi = _useState8[1];
  var _useState9 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])({}),
    _useState10 = _slicedToArray(_useState9, 2),
    selectedBarIdx = _useState10[0],
    setSelectedBarIdx = _useState10[1];
  var _useState11 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])([]),
    _useState12 = _slicedToArray(_useState11, 2),
    filterLevel = _useState12[0],
    setfilterLevel = _useState12[1];
  var _useState13 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])({
      tingkat: [],
      kelas: [],
      mapel: [],
      bab: [],
      subbab: []
    }),
    _useState14 = _slicedToArray(_useState13, 2),
    filters = _useState14[0],
    setFilters = _useState14[1];
  var _useState15 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(0),
    _useState16 = _slicedToArray(_useState15, 2),
    kelasId = _useState16[0],
    setKelasId = _useState16[1];
  var _useState17 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(0),
    _useState18 = _slicedToArray(_useState17, 2),
    mapelId = _useState18[0],
    setMapelId = _useState18[1];
  var _useState19 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(0),
    _useState20 = _slicedToArray(_useState19, 2),
    babId = _useState20[0],
    setBabId = _useState20[1];
  var _useState21 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(""),
    _useState22 = _slicedToArray(_useState21, 2),
    graphicTitle = _useState22[0],
    setGraphicTitle = _useState22[1];
  var _useState23 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(""),
    _useState24 = _slicedToArray(_useState23, 2),
    currentLevel = _useState24[0],
    setCurrentLevel = _useState24[1];
  var _useState25 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(true),
    _useState26 = _slicedToArray(_useState25, 2),
    isLoading = _useState26[0],
    setIsLoading = _useState26[1];
  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    if (listDatas.length < 1) {
      window.axios.post("/backoffice/json/dashboard/current").then(function (response) {
        var data = response.data.data;
        var level = data.level;
        var param = data.param;
        var param2nd = data.param2nd;
        var param3rd = data.param3rd;
        var params = {};
        if (level == null) {
          level = 'tingkat';
        }
        if (param != null) {
          params[param] = data.value;
        }
        if (param2nd != null) {
          params[param2nd] = data.value2nd;
        }
        if (param3rd != null) {
          params[param3rd] = data.value3rd;
        }
        window.axios.post("/backoffice/json/dashboard/".concat(level), params).then(function (response) {
          var data = response.data.data;
          var chartData = data.data;
          var chartDataId = data.data_id;
          var nextApi = data.next_api;
          var graphicTitle = data.graphic_title;
          var currentLevel = data.level;
          options['onClick'] = graphClickEvent;
          if (data.kelas_id) {
            setKelasId(data.kelas_id);
          }
          if (data.bab_id) {
            setBabId(data.bab_id);
          }
          if (data.mapel_id) {
            setMapelId(data.mapel_id);
          }
          setIsLoading(false);
          setGraphicTitle(graphicTitle);
          setCurrentLevel(currentLevel);
          setNextApi(nextApi);
          setListDatas(chartData);
          setListDataIds(chartDataId);
        })["catch"](function (err) {
          console.log(err);
        });
      })["catch"](function (err) {
        console.log(err);
      });
      window.axios.post("/backoffice/json/dashboard/filter/level").then(function (response) {
        var data = response.data.data;
        setfilterLevel(data);
      })["catch"](function (err) {
        console.log(err);
      });
    }
  }, []);
  var spanBorderRight = {
    borderLeft: "1px solid #F6D0A1",
    marginLeft: "5px",
    marginRight: "5px"
  };
  function graphClickEvent(event, clickedElements) {
    if (clickedElements.length === 0) return;
    var _clickedElements$0$el = clickedElements[0].element.$context,
      dataIndex = _clickedElements$0$el.dataIndex,
      raw = _clickedElements$0$el.raw;
    var data = event.chart.data;
    var barLabel = event.chart.data.labels[dataIndex];
    var selectedIdx = dataIndex;
    setIsLoading(true);
    setSelectedBarIdx({
      label: barLabel,
      idx: selectedIdx,
      isClick: true
    });
  }
  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    if (filters.tingkat.length < 1) {
      window.axios.post("/backoffice/json/dashboard/filter/tingkat").then(function (response) {
        var data = response.data.data;
        setFilters(_objectSpread(_objectSpread({}, filters), {}, {
          tingkat: data
        }));
        $("#tingkat").selectpicker("refresh");
      })["catch"](function (err) {
        console.log(err);
      });
    }
  }, []);
  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    var selectedId = selectedBarIdx.isClick ? listDataIds[selectedBarIdx.idx] : selectedBarIdx.idx;
    if (currentLevel == 'siswa') {
      window.location.href = "/backoffice/e-raport/".concat(selectedId, "/").concat(mapelId);
      return;
    }
    setIsLoading(true);
    var params = _defineProperty({}, nextApi.param, selectedId);
    if (kelasId != 0) {
      params['kelas_id'] = kelasId;
    }
    if (babId != 0) {
      params['bab_id'] = babId;
    }
    window.axios.post("/backoffice/json/dashboard/".concat(nextApi.name), params).then(function (response) {
      var data = response.data.data;
      options['onClick'] = graphClickEvent;
      var chartData = data.data;
      var chartDataId = data.data_id;
      var graphicTitle = data.graphic_title;
      var nextApi = data.next_api;
      var currentLevel = data.level;
      if (data.kelas_id) {
        setKelasId(data.kelas_id);
      }
      if (data.bab_id) {
        setBabId(data.bab_id);
      }
      if (data.mapel_id) {
        setMapelId(data.mapel_id);
      }
      setIsLoading(false);
      setGraphicTitle(graphicTitle);
      setCurrentLevel(currentLevel);
      setNextApi(nextApi);
      setListDataIds(chartDataId);
      setListDatas(chartData);
    })["catch"](function (err) {
      console.log(err);
    });
  }, [selectedBarIdx]);
  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    var listConfig = [];
    var _loop = function _loop() {
        var labels = [];
        var tempScores = [];
        listDatas[i].forEach(function (element) {
          var data = element;
          labels.push(data.label);
          tempScores.push(data.score);
        });
        objConfig = {
          labels: labels,
          datasets: [{
            label: 'Score',
            data: tempScores,
            backgroundColor: "rgba(2, 65, 2, 1)",
            borderRadius: 10,
            minBarLength: 1
            // barThickness: 120,
          }]
        };
        listConfig.push(objConfig);
      },
      objConfig;
    for (var i = 0; i < listDatas.length; i++) {
      _loop();
    }
    console.log('listConfig', listConfig);
    setListConfigData(listConfig);
  }, [listDatas]);
  var handleChange = function handleChange(e) {
    var getLevel = filterLevel.filter(function (el) {
      return el.option == e.target.id;
    });
    if (getLevel.length == 0) {
      return;
    }
    var level = getLevel[0];
    setNextApi(level.next_api);
    var params = _defineProperty({}, level.next_api.param, e.target.value);
    if (kelasId != 0) {
      params['kelas_id'] = kelasId;
    }
    window.axios.post("/backoffice/json/dashboard/filter/".concat(level.next_api.name), params).then(function (response) {
      var data = response.data.data;
      setFilters(_objectSpread(_objectSpread({}, filters), {}, _defineProperty({}, level.next_api.name, data)));
      $("#".concat(level.next_api.name)).selectpicker("refresh");
    })["catch"](function (err) {
      console.log(err);
    });
    setIsLoading(true);
    setSelectedBarIdx({
      label: e.target.id,
      idx: e.target.value,
      isClick: false
    });
  };
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
    id: "tingkat",
    name: "tingkat",
    "data-style": "btn-green-pastel",
    "class": "selectpicker mr-2",
    placeholder: "Tingkat",
    onChange: handleChange
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: ""
  }, "Semua Tingkat"), filters.tingkat.length > 0 && filters.tingkat.map(function (data) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
      value: data.id
    }, data.name);
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("select", {
    id: "kelas",
    name: "kelas",
    "data-style": "btn-green-pastel",
    multiple: true,
    "class": "selectpicker mr-2",
    placeholder: "Kelas",
    onChange: handleChange
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: ""
  }, "Semua Kelas"), filters.kelas.length > 0 && filters.kelas.map(function (data) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
      value: data.id
    }, data.name);
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("select", {
    id: "mapel",
    name: "mapel",
    "data-style": "btn-green-pastel",
    "class": "selectpicker mr-2",
    placeholder: "Mata Pelajaran",
    onChange: handleChange
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: ""
  }, "Semua Mata Pelajaran"), filters.mapel.length > 0 && filters.mapel.map(function (data) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
      value: data.id
    }, data.name);
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("select", {
    id: "bab",
    name: "bab",
    "data-style": "btn-green-pastel",
    "class": "selectpicker mr-2",
    placeholder: "Module",
    onChange: handleChange
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: ""
  }, "Semua Module"), filters.bab.length > 0 && filters.bab.map(function (data) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
      value: data.id
    }, data.name);
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("select", {
    id: "subbab",
    name: "subbab",
    "data-style": "btn-green-pastel",
    "class": "selectpicker mr-2",
    placeholder: "Sub-Module",
    onChange: handleChange
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
    value: ""
  }, "Semua Sub-Module"), filters.subbab.length > 0 && filters.subbab.map(function (data) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("option", {
      value: data.id
    }, data.name);
  })))))), !isLoading ? listConfigData && listConfigData.map(function (data, idxData) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
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
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h2", {
      className: "text-primary"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("b", null, graphicTitle)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
      className: "dashboard-final-score",
      style: {
        marginLeft: 'auto'
      }
    }, data.datasets[0].data.length < 15 && data.datasets[0].data.map(function (value, idx) {
      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, data.labels[idx], " : ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("b", null, value)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
        style: spanBorderRight
      }));
    }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_chartjs_2__WEBPACK_IMPORTED_MODULE_5__["Bar"], {
      options: options,
      data: data
    })))));
  }) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "row",
    style: {
      height: '70vh',
      width: '100%'
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "col-12 d-flex justify-content-center align-items-center",
    style: {
      flexDirection: 'column'
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_loader_spinner__WEBPACK_IMPORTED_MODULE_6__["ThreeCircles"], {
    visible: true,
    height: "100",
    width: "100",
    color: "#024102",
    ariaLabel: "three-circles-loading",
    wrapperStyle: {},
    wrapperClass: ""
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h2", {
    "class": "mt-2"
  }, "Mohon tunggu..."))));
}
/* harmony default export */ __webpack_exports__["default"] = (DashboardKepalaSekolah);
if (document.getElementById('dashboard-kepala-sekolah')) {
  react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(DashboardKepalaSekolah, null), document.getElementById('dashboard-kepala-sekolah'));
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