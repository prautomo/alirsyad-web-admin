(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[30],{

/***/ "./node_modules/css-loader/index.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./resources/js/frontoffice/components/ToggleSwitch/ToggleSwitch.scss":
/*!***************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./resources/js/frontoffice/components/ToggleSwitch/ToggleSwitch.scss ***!
  \***************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".toggle-switch {\n  position: relative;\n  margin-right: 10px;\n  width: 75px;\n  display: inline-block;\n  vertical-align: middle;\n  -webkit-user-select: none;\n  -moz-user-select: none;\n  -ms-user-select: none;\n  text-align: left;\n}\n.toggle-switch-checkbox {\n  display: none;\n}\n.toggle-switch-label {\n  display: block;\n  overflow: hidden;\n  cursor: pointer;\n  border: 0 solid #bbb;\n  border-radius: 20px;\n  margin: 0;\n}\n.toggle-switch-label:focus {\n  outline: none;\n}\n.toggle-switch-label:focus > span {\n  box-shadow: 0 0 2px 5px red;\n}\n.toggle-switch-label > span:focus {\n  outline: none;\n}\n.toggle-switch-inner {\n  display: block;\n  width: 200%;\n  margin-left: -100%;\n  transition: margin 0.3s ease-in 0s;\n}\n.toggle-switch-inner:before, .toggle-switch-inner:after {\n  display: block;\n  float: left;\n  width: 50%;\n  height: 34px;\n  padding: 0;\n  line-height: 34px;\n  font-size: 14px;\n  color: white;\n  font-weight: bold;\n  box-sizing: border-box;\n}\n.toggle-switch-inner:before {\n  content: attr(data-yes);\n  text-transform: uppercase;\n  padding-left: 10px;\n  background-color: #2F855A;\n  color: #fff;\n}\n.toggle-switch-disabled {\n  background-color: #ddd;\n  cursor: not-allowed;\n}\n.toggle-switch-disabled:before {\n  background-color: #ddd;\n  cursor: not-allowed;\n}\n.toggle-switch-inner:after {\n  content: attr(data-no);\n  text-transform: uppercase;\n  padding-right: 10px;\n  background-color: #bbb;\n  color: #fff;\n  text-align: right;\n}\n.toggle-switch-switch {\n  display: block;\n  width: 24px;\n  margin: 5px;\n  background: #fff;\n  position: absolute;\n  top: 0;\n  bottom: 0;\n  right: 40px;\n  border: 0 solid #bbb;\n  border-radius: 20px;\n  transition: all 0.3s ease-in 0s;\n}\n.toggle-switch-checkbox:checked + .toggle-switch-label .toggle-switch-inner {\n  margin-left: 0;\n}\n.toggle-switch-checkbox:checked + .toggle-switch-label .toggle-switch-switch {\n  right: 0px;\n}\n.toggle-switch.small-switch {\n  width: 40px;\n}\n.toggle-switch.small-switch .toggle-switch-inner:after, .toggle-switch.small-switch .toggle-switch-inner:before {\n  content: \"\";\n  height: 20px;\n  line-height: 20px;\n}\n.toggle-switch.small-switch .toggle-switch-switch {\n  width: 16px;\n  right: 20px;\n  margin: 2px;\n}\n@media screen and (max-width: 991px) {\n  .toggle-switch {\n    transform: scale(0.9);\n  }\n}\n@media screen and (max-width: 767px) {\n  .toggle-switch {\n    transform: scale(0.825);\n  }\n}\n@media screen and (max-width: 575px) {\n  .toggle-switch {\n    transform: scale(0.75);\n  }\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/frontoffice/components/Modul/Detail.css":
/*!**********************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/postcss-loader/src??ref--6-2!./resources/js/frontoffice/components/Modul/Detail.css ***!
  \**********************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".layer-toolbox {\r\n    padding: 30px 30px 10px 30px;\r\n    width: 66.66666667%;\r\n    background-color: #d2f1f0 ;\r\n    position: fixed;\r\n    left: 17%;\r\n    bottom: 0;\r\n    z-index: 999999;\r\n}\r\n\r\n.rcp-dark {\r\n    width: 100% !important;\r\n}\r\n\r\n/* for desktop / tablet style */\r\n@media only screen and (min-device-width: 768px) {\r\n    .toggle-switch {\r\n        display: none;\r\n    }\r\n\r\n    .pdf-viewer-mobile {\r\n        display: none;\r\n    }\r\n}\r\n\r\n@media only screen and (max-device-width: 768px) {\r\n    .pdf-viewer-desktop {\r\n        display: none;\r\n    }\r\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./resources/js/components/pdf/ViewSDKClient.js":
/*!******************************************************!*\
  !*** ./resources/js/components/pdf/ViewSDKClient.js ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var ViewSDKClient = /*#__PURE__*/function () {
  function ViewSDKClient() {
    _classCallCheck(this, ViewSDKClient);
    this.readyPromise = new Promise(function (resolve) {
      if (window.AdobeDC) {
        resolve();
      } else {
        document.addEventListener("adobe_dc_view_sdk.ready", function () {
          resolve();
        });
      }
    });
    this.adobeDCView = undefined;
  }
  return _createClass(ViewSDKClient, [{
    key: "ready",
    value: function ready() {
      return this.readyPromise;
    }
  }, {
    key: "previewFile",
    value: function previewFile(clientId, divId, viewerConfig, url) {
      var config = {
        clientId: clientId
      };
      if (divId) {
        config.divId = divId;
      }
      this.adobeDCView = new window.AdobeDC.View(config);
      var previewFilePromise = this.adobeDCView.previewFile({
        content: {
          location: {
            url: url
          }
        },
        metaData: {
          fileName: "Viewer.pdf",
          id: "6d07d124-ac85-43b3-a867-36930f502ac6"
        }
      }, viewerConfig);
      return previewFilePromise;
    }
  }, {
    key: "previewFileUsingFilePromise",
    value: function previewFileUsingFilePromise(clientId, divId, filePromise, fileName) {
      this.adobeDCView = new window.AdobeDC.View({
        clientId: clientId,
        divId: divId
      });
      this.adobeDCView.previewFile({
        content: {
          promise: filePromise
        },
        metaData: {
          fileName: fileName
        }
      }, {});
    }
  }, {
    key: "registerSaveApiHandler",
    value: function registerSaveApiHandler() {
      var saveApiHandler = function saveApiHandler(metaData, content, options) {
        console.log(metaData, content, options);
        return new Promise(function (resolve) {
          setTimeout(function () {
            var response = {
              code: window.AdobeDC.View.Enum.ApiResponseCode.SUCCESS,
              data: {
                metaData: Object.assign(metaData, {
                  updatedAt: new Date().getTime()
                })
              }
            };
            resolve(response);
          }, 2000);
        });
      };
      this.adobeDCView.registerCallback(window.AdobeDC.View.Enum.CallbackType.SAVE_API, saveApiHandler, {});
    }
  }, {
    key: "registerEventsHandler",
    value: function registerEventsHandler() {
      this.adobeDCView.registerCallback(window.AdobeDC.View.Enum.CallbackType.EVENT_LISTENER, function (event) {
        console.log(event);
      }, {
        enablePDFAnalytics: true
      });
    }
  }]);
}();
/* harmony default export */ __webpack_exports__["default"] = (ViewSDKClient);

/***/ }),

/***/ "./resources/js/frontoffice/components/Modul/Detail.css":
/*!**************************************************************!*\
  !*** ./resources/js/frontoffice/components/Modul/Detail.css ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/postcss-loader/src??ref--6-2!./Detail.css */ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/frontoffice/components/Modul/Detail.css");

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

/***/ "./resources/js/frontoffice/components/Modul/Detail.js":
/*!*************************************************************!*\
  !*** ./resources/js/frontoffice/components/Modul/Detail.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var reactstrap__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! reactstrap */ "./node_modules/reactstrap/es/index.js");
/* harmony import */ var react_select__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react-select */ "./node_modules/react-select/dist/react-select.esm.js");
/* harmony import */ var reactjs_pdf_reader__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! reactjs-pdf-reader */ "./node_modules/reactjs-pdf-reader/lib/app.js");
/* harmony import */ var reactjs_pdf_reader__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(reactjs_pdf_reader__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var react_icons_fi__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react-icons/fi */ "./node_modules/react-icons/fi/index.esm.js");
/* harmony import */ var react_sketch_canvas__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! react-sketch-canvas */ "./node_modules/react-sketch-canvas/react-sketch-canvas.esm.js");
/* harmony import */ var _store_useFetch__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../../store/useFetch */ "./resources/js/store/useFetch.js");
/* harmony import */ var _ToggleSwitch_ToggleSwitch__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../ToggleSwitch/ToggleSwitch */ "./resources/js/frontoffice/components/ToggleSwitch/ToggleSwitch.js");
/* harmony import */ var react_alert__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! react-alert */ "./node_modules/react-alert/dist/esm/react-alert.js");
/* harmony import */ var react_alert_template_basic__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! react-alert-template-basic */ "./node_modules/react-alert-template-basic/dist/esm/react-alert-template-basic.js");
/* harmony import */ var react_color_palette__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! react-color-palette */ "./node_modules/react-color-palette/lib/index.module.js");
/* harmony import */ var react_color_palette_lib_css_styles_css__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! react-color-palette/lib/css/styles.css */ "./node_modules/react-color-palette/lib/css/styles.css");
/* harmony import */ var react_color_palette_lib_css_styles_css__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(react_color_palette_lib_css_styles_css__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var react_color__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! react-color */ "./node_modules/react-color/es/index.js");
/* harmony import */ var reactcss__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! reactcss */ "./node_modules/reactcss/lib/index.js");
/* harmony import */ var reactcss__WEBPACK_IMPORTED_MODULE_15___default = /*#__PURE__*/__webpack_require__.n(reactcss__WEBPACK_IMPORTED_MODULE_15__);
/* harmony import */ var _Detail_css__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./Detail.css */ "./resources/js/frontoffice/components/Modul/Detail.css");
/* harmony import */ var _Detail_css__WEBPACK_IMPORTED_MODULE_16___default = /*#__PURE__*/__webpack_require__.n(_Detail_css__WEBPACK_IMPORTED_MODULE_16__);
/* harmony import */ var _components_pdf_ViewSDKClient__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ../../../components/pdf/ViewSDKClient */ "./resources/js/components/pdf/ViewSDKClient.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _extends() { _extends = Object.assign ? Object.assign.bind() : function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }



















var styles = {
  border: "0.0625rem solid #9c9c9c",
  borderRadius: "0.25rem",
  opacity: "40%",
  marginTop: "10px"
};
function ModulDetail(_ref) {
  var _data$data$name, _data$data, _data$data2;
  var idModul = _ref.idModul,
    linkModul = _ref.linkModul,
    linkVideo = _ref.linkVideo,
    linkSimulasi = _ref.linkSimulasi,
    adobeKey = _ref.adobeKey;
  var canvas = Object(react__WEBPACK_IMPORTED_MODULE_0__["useRef"])();
  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(false),
    _useState2 = _slicedToArray(_useState, 2),
    showCanvas = _useState2[0],
    setShowCanvas = _useState2[1];
  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(false),
    _useState4 = _slicedToArray(_useState3, 2),
    dropdownOpen = _useState4[0],
    setDropdownOpen = _useState4[1];
  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])("#000000"),
    _useState6 = _slicedToArray(_useState5, 2),
    warna = _useState6[0],
    setWarna = _useState6[1];
  var _useState7 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])("#000000"),
    _useState8 = _slicedToArray(_useState7, 2),
    warnaTemp = _useState8[0],
    setWarnaTemp = _useState8[1];
  var _useState9 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(false),
    _useState10 = _slicedToArray(_useState9, 2),
    disabledBtnDone = _useState10[0],
    setDisabledBtnDone = _useState10[1];
  var _useState11 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])([]),
    _useState12 = _slicedToArray(_useState11, 2),
    path = _useState12[0],
    setPath = _useState12[1];
  var _useState13 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(false),
    _useState14 = _slicedToArray(_useState13, 2),
    showColor = _useState14[0],
    setShowColor = _useState14[1];
  var _useColor = Object(react_color_palette__WEBPACK_IMPORTED_MODULE_12__["useColor"])("hex", "#121212"),
    _useColor2 = _slicedToArray(_useColor, 2),
    color = _useColor2[0],
    setColor = _useColor2[1];
  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_8__["default"])("/modul/" + idModul + "/json"),
    data = _useFetch.data,
    isLoading = _useFetch.isLoading,
    isError = _useFetch.isError;
  var alert = Object(react_alert__WEBPACK_IMPORTED_MODULE_10__["useAlert"])();
  var toggle = function toggle() {
    return setDropdownOpen(function (prevState) {
      return !prevState;
    });
  };

  // useEffect(() => {
  //     console.log("dika idModul", idModul)
  // }, [])

  // display from data
  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    if (data !== null && data !== void 0 && data.data) {
      displayPDF(data === null || data === void 0 ? void 0 : data.data);
    }
  }, [data]);
  function displayPDF(data) {
    var viewSDKClient = new _components_pdf_ViewSDKClient__WEBPACK_IMPORTED_MODULE_17__["default"]();
    viewSDKClient.ready().then(function () {
      viewSDKClient.previewFile(adobeKey, "pdf-view-desktop", {
        showAnnotationTools: true,
        showLeftHandPanel: true,
        showPageControls: true,
        showDownloadPDF: false,
        showPrintPDF: true
      }, data === null || data === void 0 ? void 0 : data.pdf_url);
    });
  }
  function finishModul(_x) {
    return _finishModul.apply(this, arguments);
  }
  function _finishModul() {
    _finishModul = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee(nextUrl) {
      return _regeneratorRuntime().wrap(function _callee$(_context) {
        while (1) switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return postFlag(idModul);
          case 2:
            // direct to next url
            if (nextUrl) {
              setTimeout(function () {
                window.location.href = nextUrl;
              }, 3000);
            }
          case 3:
          case "end":
            return _context.stop();
        }
      }, _callee);
    }));
    return _finishModul.apply(this, arguments);
  }
  function postFlag(_x2) {
    return _postFlag.apply(this, arguments);
  }
  function _postFlag() {
    _postFlag = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2(idModul) {
      var payload;
      return _regeneratorRuntime().wrap(function _callee2$(_context2) {
        while (1) switch (_context2.prev = _context2.next) {
          case 0:
            payload = {};
            _context2.next = 3;
            return axios__WEBPACK_IMPORTED_MODULE_5___default.a.post("/moduls/".concat(idModul, "/flag/json"), {
              payload: payload
            }).then(function (res) {
              setDisabledBtnDone(true);
              // console.log("dika res post flag", res.data);
              alert.show('Modul berhasil dibaca!', {
                timeout: 3000,
                // custom timeout just for this one alert
                type: 'success',
                onOpen: function onOpen() {},
                // callback that will be executed after this alert open
                onClose: function onClose() {} // callback that will be executed after this alert is removed
              });
            })["catch"](function (e) {
              var _e$response$data;
              setDisabledBtnDone(false);
              console.error("dika res post flag failed", e === null || e === void 0 ? void 0 : e.response);
              alert.show(e === null || e === void 0 || (_e$response$data = e.response.data) === null || _e$response$data === void 0 ? void 0 : _e$response$data.message, {
                timeout: 3000,
                // custom timeout just for this one alert
                type: 'error',
                onOpen: function onOpen() {},
                // callback that will be executed after this alert open
                onClose: function onClose() {} // callback that will be executed after this alert is removed
              });
            });
          case 3:
          case "end":
            return _context2.stop();
        }
      }, _callee2);
    }));
    return _postFlag.apply(this, arguments);
  }
  function savePath() {
    return _savePath.apply(this, arguments);
  }
  function _savePath() {
    _savePath = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee3() {
      var _canvas$current2;
      var a;
      return _regeneratorRuntime().wrap(function _callee3$(_context3) {
        while (1) switch (_context3.prev = _context3.next) {
          case 0:
            _context3.next = 2;
            return canvas === null || canvas === void 0 || (_canvas$current2 = canvas.current) === null || _canvas$current2 === void 0 ? void 0 : _canvas$current2.exportPaths();
          case 2:
            a = _context3.sent;
            setPath(a);
          case 4:
          case "end":
            return _context3.stop();
        }
      }, _callee3);
    }));
    return _savePath.apply(this, arguments);
  }
  function loadPath() {
    var _canvas$current;
    canvas === null || canvas === void 0 || (_canvas$current = canvas.current) === null || _canvas$current === void 0 || _canvas$current.loadPaths(path);
  }
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Row"], {
    className: "mb-1"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Col"], {
    md: "12"
  }, !isLoading && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "text-left form-inline"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h3", null, (_data$data$name = data === null || data === void 0 || (_data$data = data.data) === null || _data$data === void 0 ? void 0 : _data$data.name) !== null && _data$data$name !== void 0 ? _data$data$name : '-'), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    id: "toggle",
    className: "ml-auto form-inline"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_ToggleSwitch_ToggleSwitch__WEBPACK_IMPORTED_MODULE_9__["default"], {
    id: "showCanvas",
    small: true,
    checked: showCanvas,
    onChange: function onChange() {
      setShowCanvas(!showCanvas);
      if (showCanvas) {
        loadPath();
      } else {
        savePath();
      }
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Dropdown"], {
    isOpen: dropdownOpen,
    toggle: toggle,
    size: "sm",
    className: "btn-outline",
    direction: "left"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["DropdownToggle"], {
    style: {
      background: "none",
      color: "#000000",
      borderColor: "#ffffff"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_icons_fi__WEBPACK_IMPORTED_MODULE_6__["FiMoreVertical"], {
    size: "15"
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["DropdownMenu"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["DropdownItem"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("a", {
    href: linkModul
  }, "Modul Pembelajaran")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["DropdownItem"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("a", {
    href: linkVideo
  }, "Video Pembelajaran")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["DropdownItem"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("a", {
    href: linkSimulasi
  }, "Simulasi Pembelajaran")))))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("hr", null)))), isLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("p", null, "Loading...") : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Row"], {
    className: "mb-1"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Col"], {
    md: "12"
  }, showCanvas && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    id: "layer-coret",
    style: {
      position: "absolute",
      paddingRight: "25px",
      width: "100%"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    onClick: function onClick() {
      canvas.current.clearCanvas();
    },
    className: "btn-main mr-2 btn-small"
  }, "Clear"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    onClick: function onClick() {
      canvas.current.undo();
    },
    className: "btn-main mr-2 btn-small"
  }, "Undo"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    onClick: function onClick() {
      canvas.current.redo();
    },
    className: "btn-main mr-2 btn-small"
  }, "Redo"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    onClick: function onClick() {
      setWarna("red");
    },
    className: "btn-main mr-2 btn-small"
  }, "Red"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    onClick: function onClick() {
      setWarna("black");
    },
    className: "btn-main mr-2 btn-small"
  }, "Black"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_sketch_canvas__WEBPACK_IMPORTED_MODULE_7__["ReactSketchCanvas"], {
    ref: canvas,
    style: styles,
    width: "100%",
    height: "800px",
    strokeWidth: 3,
    strokeColor: warna
  }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    style: {
      overflowX: 'auto',
      height: '100%',
      marginTop: showCanvas ? "50px" : "0px"
    },
    className: "pdf-viewer-mobile"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("iframe", {
    src: "https://docs.google.com/gview?url=" + (data === null || data === void 0 || (_data$data2 = data.data) === null || _data$data2 === void 0 ? void 0 : _data$data2.pdf_url) + "?hsLang=en&embedded=true",
    style: {
      width: "100%",
      height: "800px"
    },
    frameBorder: "0"
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    style: {
      width: "100%",
      height: "800px"
    },
    className: "pdf-viewer-desktop",
    id: "pdf-view-desktop"
  }, "Viewer Desktop")))), showCanvas && false && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "layer-toolbox"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    onClick: function onClick() {
      canvas.current.undo();
    },
    className: "btn-main mr-2 btn-small mb-2"
  }, "Undo"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    onClick: function onClick() {
      canvas.current.clearCanvas();
    },
    className: "btn-main mr-2 btn-small mb-2"
  }, "Clear"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    onClick: function onClick() {
      setWarna("red");
    },
    className: "btn-main mr-2 btn-small mb-2"
  }, "Pen Red"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    onClick: function onClick() {
      setWarna("black");
    },
    className: "btn-main mr-2 btn-small mb-2"
  }, "Pen Black"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    onClick: function onClick() {
      canvas.current.redo();
    },
    className: "btn-main mr-2 btn-small mb-2"
  }, "Redo"), showColor && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_color__WEBPACK_IMPORTED_MODULE_14__["PhotoshopPicker"], {
    className: "mr-auto ml-auto",
    color: warnaTemp,
    onChange: function onChange(color) {
      return setWarnaTemp(color.hex);
    },
    onChangeComplete: function onChangeComplete(color) {
      setWarnaTemp(color.hex);
    },
    onAccept: function onAccept() {
      setWarna(warnaTemp);
      setShowColor(!showColor);
    },
    onCancel: function onCancel() {
      setWarnaTemp(warna);
      setShowColor(!showColor);
    }
  })));
}
/* harmony default export */ __webpack_exports__["default"] = (ModulDetail);
var options = {
  position: 'bottom right',
  timeout: 3000,
  offset: '30px',
  transition: 'scale'
};
var RootVideoDetail = function RootVideoDetail(props) {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_alert__WEBPACK_IMPORTED_MODULE_10__["Provider"], _extends({
    template: react_alert_template_basic__WEBPACK_IMPORTED_MODULE_11__["default"]
  }, options), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(ModulDetail, {
    idModul: props === null || props === void 0 ? void 0 : props.idModul,
    linkModul: props === null || props === void 0 ? void 0 : props.linkModul,
    linkVideo: props === null || props === void 0 ? void 0 : props.linkVideo,
    linkSimulasi: props === null || props === void 0 ? void 0 : props.linkSimulasi,
    adobeKey: props === null || props === void 0 ? void 0 : props.adobeKey
  }));
};
var container = document.getElementById("modul-detail-fe");
if (container) {
  var idModul = container.getAttribute("modul-id");
  var linkModul = container.getAttribute("link-modul");
  var linkVideo = container.getAttribute("link-video");
  var linkSimulasi = container.getAttribute("link-simulasi");
  var adobeKey = container.getAttribute("adobe-key");
  react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(RootVideoDetail, {
    idModul: idModul,
    linkModul: linkModul,
    linkVideo: linkVideo,
    linkSimulasi: linkSimulasi,
    adobeKey: adobeKey
  }), container);
}

/***/ }),

/***/ "./resources/js/frontoffice/components/ToggleSwitch/ToggleSwitch.js":
/*!**************************************************************************!*\
  !*** ./resources/js/frontoffice/components/ToggleSwitch/ToggleSwitch.js ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var prop_types__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! prop-types */ "./node_modules/prop-types/index.js");
/* harmony import */ var prop_types__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(prop_types__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _ToggleSwitch_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ToggleSwitch.scss */ "./resources/js/frontoffice/components/ToggleSwitch/ToggleSwitch.scss");
/* harmony import */ var _ToggleSwitch_scss__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_ToggleSwitch_scss__WEBPACK_IMPORTED_MODULE_2__);




/*
Toggle Switch Component
Note: id, checked and onChange are required for ToggleSwitch component to function. The props name, small, disabled
and optionLabels are optional.
Usage: <ToggleSwitch id="id" checked={value} onChange={checked => setValue(checked)}} />
*/

var ToggleSwitch = function ToggleSwitch(_ref) {
  var id = _ref.id,
    name = _ref.name,
    checked = _ref.checked,
    _onChange = _ref.onChange,
    optionLabels = _ref.optionLabels,
    small = _ref.small,
    disabled = _ref.disabled;
  function handleKeyPress(e) {
    if (e.keyCode !== 32) return;
    e.preventDefault();
    _onChange(!checked);
  }
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "toggle-switch" + (small ? " small-switch" : "")
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("input", {
    type: "checkbox",
    name: name,
    className: "toggle-switch-checkbox",
    id: id,
    checked: checked,
    onChange: function onChange(e) {
      return _onChange(e.target.checked);
    },
    disabled: disabled
  }), id ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("label", {
    className: "toggle-switch-label",
    tabIndex: disabled ? -1 : 1,
    onKeyDown: function onKeyDown(e) {
      return handleKeyPress(e);
    },
    htmlFor: id
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: disabled ? "toggle-switch-inner toggle-switch-disabled" : "toggle-switch-inner",
    "data-yes": optionLabels[0],
    "data-no": optionLabels[1],
    tabIndex: -1
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: disabled ? "toggle-switch-switch toggle-switch-disabled" : "toggle-switch-switch",
    tabIndex: -1
  })) : null);
};

// Set optionLabels for rendering.
ToggleSwitch.defaultProps = {
  optionLabels: ["Yes", "No"]
};
ToggleSwitch.propTypes = {
  id: prop_types__WEBPACK_IMPORTED_MODULE_1___default.a.string.isRequired,
  checked: prop_types__WEBPACK_IMPORTED_MODULE_1___default.a.bool.isRequired,
  onChange: prop_types__WEBPACK_IMPORTED_MODULE_1___default.a.func.isRequired,
  name: prop_types__WEBPACK_IMPORTED_MODULE_1___default.a.string,
  optionLabels: prop_types__WEBPACK_IMPORTED_MODULE_1___default.a.array,
  small: prop_types__WEBPACK_IMPORTED_MODULE_1___default.a.bool,
  disabled: prop_types__WEBPACK_IMPORTED_MODULE_1___default.a.bool
};
/* harmony default export */ __webpack_exports__["default"] = (ToggleSwitch);

/***/ }),

/***/ "./resources/js/frontoffice/components/ToggleSwitch/ToggleSwitch.scss":
/*!****************************************************************************!*\
  !*** ./resources/js/frontoffice/components/ToggleSwitch/ToggleSwitch.scss ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!./ToggleSwitch.scss */ "./node_modules/css-loader/index.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./resources/js/frontoffice/components/ToggleSwitch/ToggleSwitch.scss");

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