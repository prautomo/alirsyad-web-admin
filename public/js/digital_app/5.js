(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

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
exports.push([module.i, ".layer-toolbox {\r\n    padding: 30px 30px 10px 30px;\r\n    width: 66.66666667%;\r\n    background-color: #d2f1f0 ;\r\n    position: fixed;\r\n    left: 17%;\r\n    bottom: 0;\r\n    z-index: 999999;\r\n}\r\n\r\n.rcp-dark {\r\n    width: 100% !important;\r\n}", ""]);

// exports


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
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var reactstrap__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! reactstrap */ "./node_modules/reactstrap/es/index.js");
/* harmony import */ var react_select__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-select */ "./node_modules/react-select/dist/react-select.esm.js");
/* harmony import */ var reactjs_pdf_reader__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! reactjs-pdf-reader */ "./node_modules/reactjs-pdf-reader/lib/app.js");
/* harmony import */ var reactjs_pdf_reader__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(reactjs_pdf_reader__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var react_icons_fi__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! react-icons/fi */ "./node_modules/react-icons/fi/index.esm.js");
/* harmony import */ var react_sketch_canvas__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! react-sketch-canvas */ "./node_modules/react-sketch-canvas/react-sketch-canvas.esm.js");
/* harmony import */ var _store_useFetch__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../../../store/useFetch */ "./resources/js/store/useFetch.js");
/* harmony import */ var _ToggleSwitch_ToggleSwitch__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../ToggleSwitch/ToggleSwitch */ "./resources/js/frontoffice/components/ToggleSwitch/ToggleSwitch.js");
/* harmony import */ var react_alert__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! react-alert */ "./node_modules/react-alert/dist/esm/react-alert.js");
/* harmony import */ var react_alert_template_basic__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! react-alert-template-basic */ "./node_modules/react-alert-template-basic/dist/esm/react-alert-template-basic.js");
/* harmony import */ var react_color_palette__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! react-color-palette */ "./node_modules/react-color-palette/lib/index.module.js");
/* harmony import */ var react_color_palette_lib_css_styles_css__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! react-color-palette/lib/css/styles.css */ "./node_modules/react-color-palette/lib/css/styles.css");
/* harmony import */ var react_color_palette_lib_css_styles_css__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(react_color_palette_lib_css_styles_css__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var react_color__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! react-color */ "./node_modules/react-color/es/index.js");
/* harmony import */ var reactcss__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! reactcss */ "./node_modules/reactcss/lib/index.js");
/* harmony import */ var reactcss__WEBPACK_IMPORTED_MODULE_16___default = /*#__PURE__*/__webpack_require__.n(reactcss__WEBPACK_IMPORTED_MODULE_16__);
/* harmony import */ var _Detail_css__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ./Detail.css */ "./resources/js/frontoffice/components/Modul/Detail.css");
/* harmony import */ var _Detail_css__WEBPACK_IMPORTED_MODULE_17___default = /*#__PURE__*/__webpack_require__.n(_Detail_css__WEBPACK_IMPORTED_MODULE_17__);


function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }



















var styles = {
  border: "0.0625rem solid #9c9c9c",
  borderRadius: "0.25rem",
  opacity: "40%",
  marginTop: "10px"
};

function ModulDetail(_ref) {
  var _data$data$name, _data$data, _data$data2, _data$data3, _data$data3$previous, _data$data4, _data$data4$previous, _data$data5, _data$data5$next, _data$data7;

  var idModul = _ref.idModul,
      linkModul = _ref.linkModul,
      linkVideo = _ref.linkVideo,
      linkSimulasi = _ref.linkSimulasi;
  var canvas = Object(react__WEBPACK_IMPORTED_MODULE_1__["useRef"])();

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState2 = _slicedToArray(_useState, 2),
      showCanvas = _useState2[0],
      setShowCanvas = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState4 = _slicedToArray(_useState3, 2),
      dropdownOpen = _useState4[0],
      setDropdownOpen = _useState4[1];

  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])("#000000"),
      _useState6 = _slicedToArray(_useState5, 2),
      warna = _useState6[0],
      setWarna = _useState6[1];

  var _useState7 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])("#000000"),
      _useState8 = _slicedToArray(_useState7, 2),
      warnaTemp = _useState8[0],
      setWarnaTemp = _useState8[1];

  var _useState9 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState10 = _slicedToArray(_useState9, 2),
      disabledBtnDone = _useState10[0],
      setDisabledBtnDone = _useState10[1];

  var _useState11 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])([]),
      _useState12 = _slicedToArray(_useState11, 2),
      path = _useState12[0],
      setPath = _useState12[1];

  var _useState13 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState14 = _slicedToArray(_useState13, 2),
      showColor = _useState14[0],
      setShowColor = _useState14[1];

  var _useColor = Object(react_color_palette__WEBPACK_IMPORTED_MODULE_13__["useColor"])("hex", "#121212"),
      _useColor2 = _slicedToArray(_useColor, 2),
      color = _useColor2[0],
      setColor = _useColor2[1];

  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_9__["default"])("/modul/" + idModul + "/json"),
      data = _useFetch.data,
      isLoading = _useFetch.isLoading,
      isError = _useFetch.isError;

  var alert = Object(react_alert__WEBPACK_IMPORTED_MODULE_11__["useAlert"])();

  var toggle = function toggle() {
    return setDropdownOpen(function (prevState) {
      return !prevState;
    });
  };

  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    console.log("dika idModul", idModul);
  }, []);

  function finishModul(_x) {
    return _finishModul.apply(this, arguments);
  }

  function _finishModul() {
    _finishModul = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(nextUrl) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              console.log("dika nextUrl", nextUrl); // update history

              _context.next = 3;
              return postFlag(idModul);

            case 3:
              // direct to next url
              if (nextUrl) {
                setTimeout(function () {
                  window.location.href = nextUrl;
                }, 3000);
              }

            case 4:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));
    return _finishModul.apply(this, arguments);
  }

  function postFlag(_x2) {
    return _postFlag.apply(this, arguments);
  }

  function _postFlag() {
    _postFlag = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(idModul) {
      var payload;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              payload = {};
              _context2.next = 3;
              return axios__WEBPACK_IMPORTED_MODULE_6___default.a.post("/moduls/".concat(idModul, "/flag/json"), {
                payload: payload
              }).then(function (res) {
                setDisabledBtnDone(true); // console.log("dika res post flag", res.data);

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
                alert.show(e === null || e === void 0 ? void 0 : (_e$response$data = e.response.data) === null || _e$response$data === void 0 ? void 0 : _e$response$data.message, {
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
        }
      }, _callee2);
    }));
    return _postFlag.apply(this, arguments);
  }

  function savePath() {
    return _savePath.apply(this, arguments);
  }

  function _savePath() {
    _savePath = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3() {
      var _canvas$current2;

      var a;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              _context3.next = 2;
              return canvas === null || canvas === void 0 ? void 0 : (_canvas$current2 = canvas.current) === null || _canvas$current2 === void 0 ? void 0 : _canvas$current2.exportPaths();

            case 2:
              a = _context3.sent;
              setPath(a);

            case 4:
            case "end":
              return _context3.stop();
          }
        }
      }, _callee3);
    }));
    return _savePath.apply(this, arguments);
  }

  function loadPath() {
    var _canvas$current;

    canvas === null || canvas === void 0 ? void 0 : (_canvas$current = canvas.current) === null || _canvas$current === void 0 ? void 0 : _canvas$current.loadPaths(path);
  }

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Row"], {
    className: "mb-1"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Col"], {
    md: "12"
  }, !isLoading && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "text-left form-inline"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h3", null, (_data$data$name = data === null || data === void 0 ? void 0 : (_data$data = data.data) === null || _data$data === void 0 ? void 0 : _data$data.name) !== null && _data$data$name !== void 0 ? _data$data$name : '-'), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    id: "toggle",
    className: "ml-auto form-inline"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_ToggleSwitch_ToggleSwitch__WEBPACK_IMPORTED_MODULE_10__["default"], {
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
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Dropdown"], {
    isOpen: dropdownOpen,
    toggle: toggle,
    size: "sm",
    className: "btn-outline",
    direction: "left"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["DropdownToggle"], {
    style: {
      background: "none",
      color: "#000000",
      borderColor: "#ffffff"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react_icons_fi__WEBPACK_IMPORTED_MODULE_7__["FiMoreVertical"], {
    size: "15"
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["DropdownMenu"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["DropdownItem"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("a", {
    href: linkModul
  }, "Modul Pembelajaran")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["DropdownItem"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("a", {
    href: linkVideo
  }, "Video Pembelajaran")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["DropdownItem"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("a", {
    href: linkSimulasi
  }, "Simulasi Pembelajaran")))))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("hr", null)))), isLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("p", null, "Loading...") : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Row"], {
    className: "mb-1"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Col"], {
    md: "12"
  }, showCanvas && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    id: "layer-coret",
    style: {
      position: "absolute",
      paddingRight: "25px",
      width: "100%"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    onClick: function onClick() {
      canvas.current.clearCanvas();
    },
    className: "btn-main mr-2 btn-small"
  }, "Clear"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    onClick: function onClick() {
      canvas.current.undo();
    },
    className: "btn-main mr-2 btn-small"
  }, "Undo"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    onClick: function onClick() {
      canvas.current.redo();
    },
    className: "btn-main mr-2 btn-small"
  }, "Redo"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    onClick: function onClick() {
      setWarna("red");
    },
    className: "btn-main mr-2 btn-small"
  }, "Red"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    onClick: function onClick() {
      setWarna("black");
    },
    className: "btn-main mr-2 btn-small"
  }, "Black"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react_sketch_canvas__WEBPACK_IMPORTED_MODULE_8__["ReactSketchCanvas"], {
    ref: canvas,
    style: styles,
    width: "100%",
    height: "800px",
    strokeWidth: 3,
    strokeColor: warna
  }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    style: {
      overflowX: 'auto',
      height: '100%',
      marginTop: showCanvas ? "50px" : "0px"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("iframe", {
    src: "https://docs.google.com/gview?url=" + (data === null || data === void 0 ? void 0 : (_data$data2 = data.data) === null || _data$data2 === void 0 ? void 0 : _data$data2.pdf_url) + "?hsLang=en&embedded=true",
    style: {
      width: "100%",
      height: "800px"
    },
    frameBorder: "0"
  })), (data === null || data === void 0 ? void 0 : (_data$data3 = data.data) === null || _data$data3 === void 0 ? void 0 : (_data$data3$previous = _data$data3.previous) === null || _data$data3$previous === void 0 ? void 0 : _data$data3$previous.url) && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    className: "mt-1 btn-main btn-small mr-4",
    href: data === null || data === void 0 ? void 0 : (_data$data4 = data.data) === null || _data$data4 === void 0 ? void 0 : (_data$data4$previous = _data$data4.previous) === null || _data$data4$previous === void 0 ? void 0 : _data$data4$previous.slug_url
  }, "Modul Sebelumnya"), (data === null || data === void 0 ? void 0 : (_data$data5 = data.data) === null || _data$data5 === void 0 ? void 0 : (_data$data5$next = _data$data5.next) === null || _data$data5$next === void 0 ? void 0 : _data$data5$next.url) ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    className: "mt-1 btn-main btn-small",
    onClick: function onClick() {
      var _data$data6, _data$data6$next;

      return finishModul(data === null || data === void 0 ? void 0 : (_data$data6 = data.data) === null || _data$data6 === void 0 ? void 0 : (_data$data6$next = _data$data6.next) === null || _data$data6$next === void 0 ? void 0 : _data$data6$next.slug_url);
    }
  }, "Modul Berikutnya") : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    className: "mt-1 btn-main btn-small",
    disabled: (data === null || data === void 0 ? void 0 : (_data$data7 = data.data) === null || _data$data7 === void 0 ? void 0 : _data$data7.read) || disabledBtnDone,
    onClick: function onClick() {
      return finishModul();
    }
  }, "Selesai Membaca")))), showCanvas && false && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
    className: "layer-toolbox"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    onClick: function onClick() {
      canvas.current.undo();
    },
    className: "btn-main mr-2 btn-small mb-2"
  }, "Undo"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    onClick: function onClick() {
      canvas.current.clearCanvas();
    },
    className: "btn-main mr-2 btn-small mb-2"
  }, "Clear"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    onClick: function onClick() {
      setWarna("red");
    },
    className: "btn-main mr-2 btn-small mb-2"
  }, "Pen Red"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    onClick: function onClick() {
      setWarna("black");
    },
    className: "btn-main mr-2 btn-small mb-2"
  }, "Pen Black"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    onClick: function onClick() {
      canvas.current.redo();
    },
    className: "btn-main mr-2 btn-small mb-2"
  }, "Redo"), showColor && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react_color__WEBPACK_IMPORTED_MODULE_15__["PhotoshopPicker"], {
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
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react_alert__WEBPACK_IMPORTED_MODULE_11__["Provider"], _extends({
    template: react_alert_template_basic__WEBPACK_IMPORTED_MODULE_12__["default"]
  }, options), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(ModulDetail, {
    idModul: props === null || props === void 0 ? void 0 : props.idModul,
    linkModul: props === null || props === void 0 ? void 0 : props.linkModul,
    linkVideo: props === null || props === void 0 ? void 0 : props.linkVideo,
    linkSimulasi: props === null || props === void 0 ? void 0 : props.linkSimulasi
  }));
};

var container = document.getElementById("modul-detail-fe");

if (container) {
  var idModul = container.getAttribute("modul-id");
  var linkModul = container.getAttribute("link-modul");
  var linkVideo = container.getAttribute("link-video");
  var linkSimulasi = container.getAttribute("link-simulasi");
  react_dom__WEBPACK_IMPORTED_MODULE_2___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(RootVideoDetail, {
    idModul: idModul,
    linkModul: linkModul,
    linkVideo: linkVideo,
    linkSimulasi: linkSimulasi
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
}; // Set optionLabels for rendering.


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