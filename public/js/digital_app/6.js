(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[6],{

/***/ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/backoffice/components/ERaport/index.css":
/*!**********************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/postcss-loader/src??ref--6-2!./resources/js/backoffice/components/ERaport/index.css ***!
  \**********************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".dashboard-final-score {\n    background: #F6D0A14D;\n    padding: 10px 20px;\n    border-radius: 4px !important;\n    color: #E98A15 !important;\n}\n\n.dashboard-filter .bootstrap-select {\n    width: 200px !important;\n}", ""]);

// exports


/***/ }),

/***/ "./resources/js/backoffice/components/ERaport/Grafik.js":
/*!**************************************************************!*\
  !*** ./resources/js/backoffice/components/ERaport/Grafik.js ***!
  \**************************************************************/
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
/* harmony import */ var _index_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./index.css */ "./resources/js/backoffice/components/ERaport/index.css");
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
  },
  onHover: function onHover(event, chartElement) {
    event["native"].target.style.cursor = chartElement[0] ? 'pointer' : 'default';
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
function GrafikERaport(_ref) {
  var siswa_id = _ref.siswa_id,
    mapel_id = _ref.mapel_id;
  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(data),
    _useState2 = _slicedToArray(_useState, 2),
    configData = _useState2[0],
    setConfigData = _useState2[1];
  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])([]),
    _useState4 = _slicedToArray(_useState3, 2),
    datas = _useState4[0],
    setDatas = _useState4[1];
  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])({}),
    _useState6 = _slicedToArray(_useState5, 2),
    title = _useState6[0],
    setTitle = _useState6[1];
  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    var searchParams = new URLSearchParams(window.location.search);
    if (datas.length < 1) {
      // get data from /json/e-raport/grafik/{id}/{mapelId}; id = siswa_id
      window.axios.get("/backoffice/json/e-raport/grafik/".concat(siswa_id, "/").concat(mapel_id)).then(function (response) {
        var data = response.data.data;
        var data_babs = data.babs;
        var result;
        if (searchParams.has('bab')) {
          var bab_id = searchParams.get('bab');
          var data_subbabs = data_babs.find(function (element) {
            return element.id == bab_id;
          });
          result = data_subbabs.subbabs.map(function (element) {
            return {
              'label': element.label,
              'score': element.score,
              'mudah': element.mudah,
              'sedang': element.sedang,
              'sulit': element.sulit
            };
          });
        } else {
          result = data_babs.map(function (element) {
            return {
              'label': element.label,
              'score': element.score,
              'mudah': element.mudah,
              'sedang': element.sedang,
              'sulit': element.sulit
            };
          });
        }
        setDatas(result);
        setTitle({
          'label': data.label,
          'total_score': data.score
        });
      });
    }
  }, []);
  var getOrCreateTooltip = function getOrCreateTooltip(chart) {
    var tooltipEl = chart.canvas.parentNode.querySelector('div');
    if (tooltipEl != undefined) {
      var existTooltip = document.getElementById("chart-tooltip");
      if (existTooltip != undefined) {
        existTooltip.remove();
      }
      tooltipEl = document.createElement('div');
      tooltipEl.id = 'chart-tooltip';
      tooltipEl.style.background = 'rgba(0, 0, 0, 0.7)';
      tooltipEl.style.borderRadius = '3px';
      tooltipEl.style.color = 'white';
      tooltipEl.style.opacity = 1;
      tooltipEl.style.pointerEvents = 'none';
      tooltipEl.style.position = 'absolute';
      tooltipEl.style.transform = 'translate(-50%, 0)';
      tooltipEl.style.transition = 'all .1s ease';
      var table = document.createElement('table');
      table.style.margin = '0px';
      tooltipEl.appendChild(table);
      chart.canvas.parentNode.appendChild(tooltipEl);
    }
    return tooltipEl;
  };
  var externalTooltipHandler = function externalTooltipHandler(context) {
    // Tooltip Element
    var chart = context.chart,
      tooltip = context.tooltip;
    var tooltipEl = getOrCreateTooltip(chart);

    // Hide if no tooltip
    if (tooltip.opacity === 0) {
      tooltipEl.style.opacity = 0;
      return;
    }

    // Set Text
    if (tooltip.body) {
      var dataPoints = tooltip.dataPoints;
      var innerHtml = "<tbody style=\"font-size:12px;\" border=\"0\">";
      dataPoints.forEach(function (dataPoint, i) {
        var dataIndex = dataPoint === null || dataPoint === void 0 ? void 0 : dataPoint.dataIndex;
        var dataset = dataPoint === null || dataPoint === void 0 ? void 0 : dataPoint.dataset;
        var dataBenar = dataset === null || dataset === void 0 ? void 0 : dataset.benars[dataIndex];
        var dataTerjawab = dataset === null || dataset === void 0 ? void 0 : dataset.terjawabs[dataIndex];
        var dataPercentage = dataset === null || dataset === void 0 ? void 0 : dataset.data[dataIndex];
        innerHtml += "<tr style=\"background-color: inherit; border-width: 0; text-align: center; font-weight: bold;\">\n                    <td colspan=\"3\" style='padding: 0px 3px; margin: 0px;'>".concat(dataPoint === null || dataPoint === void 0 ? void 0 : dataPoint.label, "</td>\n                </tr>");
        innerHtml += "<tr style=\"background-color: inherit; border-width: 0;\">\n                    <td style='padding: 0px 3px; margin: 0px;'>Level</td>\n                    <td style='padding: 0px 3px; margin: 0px;'>:</td>\n                    <td style='padding: 0px 3px; margin: 0px;'>".concat(dataset === null || dataset === void 0 ? void 0 : dataset.label, "</td>\n                </tr>");
        innerHtml += "<tr style=\"background-color: inherit; border-width: 0;\">\n                    <td style='padding: 0px 3px; margin: 0px;'>Total Benar</td>\n                    <td style='padding: 0px 3px; margin: 0px;'>:</td>\n                    <td style='padding: 0px 3px; margin: 0px;'>".concat(dataBenar, "</td>\n                </tr>");
        innerHtml += "<tr style=\"background-color: inherit; border-width: 0;\">\n                    <td style='padding: 0px 3px; margin: 0px;'>Total Terjawab</td>\n                    <td style='padding: 0px 3px; margin: 0px;'>:</td>\n                    <td style='padding: 0px 3px; margin: 0px;'>".concat(dataTerjawab, "</td>\n                </tr>");
        innerHtml += "<tr style=\"background-color: inherit; border-width: 0;\">\n                    <td style='padding: 0px 3px; margin: 0px;'>Persentase</td>\n                    <td style='padding: 0px 3px; margin: 0px;'>:</td>\n                    <td style='padding: 0px 3px; margin: 0px;'>".concat(dataPercentage, "%</td>\n                </tr>");
      });
      innerHtml += "</tbody>";
      var tableRoot = tooltipEl.querySelector('table');

      // Remove old children
      while (tableRoot.firstChild) {
        tableRoot.firstChild.remove();
      }
      // Add new children
      tableRoot.innerHTML = innerHtml;
    }
    var _chart$canvas = chart.canvas,
      positionX = _chart$canvas.offsetLeft,
      positionY = _chart$canvas.offsetTop;

    // Display, position, and set styles for font
    tooltipEl.style.opacity = 1;
    tooltipEl.style.left = positionX + tooltip.caretX + 'px';
    tooltipEl.style.top = positionY + tooltip.caretY + 'px';
    tooltipEl.style.font = tooltip.options.bodyFont.string;
    tooltipEl.style.padding = tooltip.options.padding + 'px ' + tooltip.options.padding + 'px';
  };
  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    var labels = [];
    var tempMudah = {
      totalBenar: [],
      totalTerjawab: [],
      percentage: []
    };
    var tempSedang = {
      totalBenar: [],
      totalTerjawab: [],
      percentage: []
    };
    var tempSulit = {
      totalBenar: [],
      totalTerjawab: [],
      percentage: []
    };
    options.plugins['tooltip'] = {
      enabled: false,
      external: externalTooltipHandler
    };
    for (var i = 0; i < datas.length; i++) {
      var _data = datas[i];
      labels.push(_data.label);
      tempMudah.totalBenar.push(_data.mudah.total_benar);
      tempSedang.totalBenar.push(_data.sedang.total_benar);
      tempSulit.totalBenar.push(_data.sulit.total_benar);
      tempMudah.totalTerjawab.push(_data.mudah.total_terjawab);
      tempSedang.totalTerjawab.push(_data.sedang.total_terjawab);
      tempSulit.totalTerjawab.push(_data.sulit.total_terjawab);
      tempMudah.percentage.push(_data.mudah.percentage);
      tempSedang.percentage.push(_data.sedang.percentage);
      tempSulit.percentage.push(_data.sulit.percentage);
    }
    setConfigData({
      labels: labels,
      datasets: [{
        label: 'Percentage Mudah',
        data: tempMudah.percentage,
        backgroundColor: 'rgba(2, 65, 2, 1)',
        borderRadius: 10,
        minBarLength: 1,
        benars: tempMudah.totalBenar,
        terjawabs: tempMudah.totalTerjawab
        // barThickness: 120,
      }, {
        label: 'Percentage Sedang',
        data: tempSedang.percentage,
        backgroundColor: 'rgba(255, 153, 51, 1)',
        borderRadius: 10,
        minBarLength: 1,
        benars: tempSedang.totalBenar,
        terjawabs: tempSedang.totalTerjawab
        // barThickness: 120,
      }, {
        label: 'Percentage Sulit',
        data: tempSulit.percentage,
        backgroundColor: 'rgba(255, 51, 51, 1)',
        borderRadius: 10,
        minBarLength: 1,
        benars: tempSulit.totalBenar,
        terjawabs: tempSulit.totalTerjawab
        // barThickness: 120,
      }]
    });
  }, [datas]);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "row mt-4"
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
  }, title.label), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "dashboard-final-score",
    style: {
      marginLeft: 'auto'
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, title.label, " : ", title.total_score))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_chartjs_2__WEBPACK_IMPORTED_MODULE_5__["Bar"], {
    options: options,
    data: configData
  }))))));
}
/* harmony default export */ __webpack_exports__["default"] = (GrafikERaport);
var container = document.getElementById("grafik-eraport");
if (container) {
  var siswaId = container.getAttribute("siswa-id");
  var mapelId = container.getAttribute("mapel-id");
  react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(GrafikERaport, {
    siswa_id: siswaId,
    mapel_id: mapelId
  }), container);
}

/***/ }),

/***/ "./resources/js/backoffice/components/ERaport/index.css":
/*!**************************************************************!*\
  !*** ./resources/js/backoffice/components/ERaport/index.css ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/postcss-loader/src??ref--6-2!./index.css */ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/backoffice/components/ERaport/index.css");

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