(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[3],{

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
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }
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
      window.axios.post("/backoffice/json/dashboard/tingkat").then(function (response) {
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
    var barLabel = data.labels[dataIndex];
    var selectedIdx = dataIndex;
    setIsLoading(true);
    setSelectedBarIdx({
      label: barLabel,
      idx: selectedIdx,
      isClick: true
    });
  }
  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    var fetchData = /*#__PURE__*/function () {
      var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
        var labelParts, foundTingkat, response, data, _labelParts, foundKelas, _response, _data, _labelParts2, foundMapel, _labelParts3, foundBab;
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              _context.prev = 0;
              if (!(currentLevel === 'kelas')) {
                _context.next = 16;
                break;
              }
              labelParts = selectedBarIdx.label.split(" ");
              foundTingkat = filters.tingkat.find(function (data) {
                return labelParts[1] === data.name;
              });
              if (!foundTingkat) {
                _context.next = 13;
                break;
              }
              _context.next = 7;
              return window.axios.post("/backoffice/json/dashboard/filter/kelas", {
                tingkat_id: foundTingkat.id
              });
            case 7:
              response = _context.sent;
              data = response.data.data;
              setFilters(function (prevFilters) {
                return _objectSpread(_objectSpread({}, prevFilters), {}, {
                  kelas: data
                });
              });
              $("#kelas").selectpicker("refresh");
              _context.next = 14;
              break;
            case 13:
              console.log("Tingkat tidak ditemukan");
            case 14:
              _context.next = 32;
              break;
            case 16:
              if (!(currentLevel === 'mapel')) {
                _context.next = 31;
                break;
              }
              _labelParts = selectedBarIdx.label.split(" ");
              foundKelas = filters.kelas.find(function (data) {
                return _labelParts[1].match(/\d+|\D+/g)[1] === data.name;
              });
              if (!foundKelas) {
                _context.next = 28;
                break;
              }
              _context.next = 22;
              return window.axios.post("/backoffice/json/dashboard/filter/mapel");
            case 22:
              _response = _context.sent;
              _data = _response.data.data;
              setFilters(function (prevFilters) {
                return _objectSpread(_objectSpread({}, prevFilters), {}, {
                  mapel: _data
                });
              });
              $("#mapel").selectpicker("refresh");
              _context.next = 29;
              break;
            case 28:
              console.log("Kelas tidak ditemukan");
            case 29:
              _context.next = 32;
              break;
            case 31:
              if (currentLevel === 'bab') {
                _labelParts2 = selectedBarIdx.label;
                foundMapel = filters.mapel.find(function (data) {
                  return _labelParts2 === data.name;
                });
                window.axios.post("/backoffice/json/dashboard/filter/bab", {
                  mapel_id: foundMapel.id
                }).then(function (response) {
                  var data = response.data.data;
                  setFilters(function (prevFilters) {
                    return _objectSpread(_objectSpread({}, prevFilters), {}, {
                      bab: data
                    });
                  });
                  $("#bab").selectpicker("refresh");
                })["catch"](function (err) {
                  console.log(err);
                });
              } else if (currentLevel === 'subbab') {
                _labelParts3 = selectedBarIdx.label;
                foundBab = filters.bab.find(function (data) {
                  return _labelParts3 === data.name;
                });
                window.axios.post("/backoffice/json/dashboard/filter/subbab", {
                  bab_id: foundBab.id
                }).then(function (response) {
                  var data = response.data.data;
                  setFilters(function (prevFilters) {
                    return _objectSpread(_objectSpread({}, prevFilters), {}, {
                      subbab: data
                    });
                  });
                  $("#subbab").selectpicker("refresh");
                })["catch"](function (err) {
                  console.log(err);
                });
              }
            case 32:
              _context.next = 37;
              break;
            case 34:
              _context.prev = 34;
              _context.t0 = _context["catch"](0);
              console.log(_context.t0);
            case 37:
            case "end":
              return _context.stop();
          }
        }, _callee, null, [[0, 34]]);
      }));
      return function fetchData() {
        return _ref.apply(this, arguments);
      };
    }();
    fetchData();
  }, [currentLevel, selectedBarIdx.label, filters]);
  var fetchData = /*#__PURE__*/function () {
    var _ref2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2(endpoint, params, setter, pickerId) {
      var response, data;
      return _regeneratorRuntime().wrap(function _callee2$(_context2) {
        while (1) switch (_context2.prev = _context2.next) {
          case 0:
            _context2.prev = 0;
            _context2.next = 3;
            return window.axios.post(endpoint, params);
          case 3:
            response = _context2.sent;
            data = response.data.data;
            setter(function (prevFilters) {
              return _objectSpread(_objectSpread({}, prevFilters), {}, _defineProperty({}, pickerId, data));
            });
            $("#".concat(pickerId)).selectpicker("refresh");
            _context2.next = 12;
            break;
          case 9:
            _context2.prev = 9;
            _context2.t0 = _context2["catch"](0);
            console.log(_context2.t0);
          case 12:
          case "end":
            return _context2.stop();
        }
      }, _callee2, null, [[0, 9]]);
    }));
    return function fetchData(_x, _x2, _x3, _x4) {
      return _ref2.apply(this, arguments);
    };
  }();
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
    if (currentLevel == 'mapel') {
      params['kelas_id'] = kelasId;
    } else if (currentLevel == 'bab') {
      // params['bab_id'] = 
      params['kelas_id'] = kelasId;
      params['mapel_id'] = mapelId;
    } else if (currentLevel == 'subbab') {
      params['bab_id'] = babId;
      params['kelas_id'] = kelasId;
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
    className: "dashboard-filter"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("label", {
    className: "my-auto mr-2",
    style: {
      color: "#9E9E9E"
    }
  }, "Filter By"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("select", {
    id: "tingkat",
    name: "tingkat",
    "data-style": "btn-green-pastel",
    className: "selectpicker mr-2",
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
    className: "selectpicker mr-2",
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
    className: "selectpicker mr-2",
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
    className: "selectpicker mr-2",
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
    className: "selectpicker mr-2",
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
    className: "mt-2"
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