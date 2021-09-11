(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[6],{

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
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var react_icons_fi__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react-icons/fi */ "./node_modules/react-icons/fi/index.esm.js");
/* harmony import */ var react_sketch_canvas__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react-sketch-canvas */ "./node_modules/react-sketch-canvas/react-sketch-canvas.esm.js");
/* harmony import */ var _store_useFetch__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../../store/useFetch */ "./resources/js/store/useFetch.js");
/* harmony import */ var _ToggleSwitch_ToggleSwitch__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../ToggleSwitch/ToggleSwitch */ "./resources/js/frontoffice/components/ToggleSwitch/ToggleSwitch.js");
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }










var styles = {
  border: "0.0625rem solid #9c9c9c",
  borderRadius: "0.25rem",
  opacity: "40%"
};

function ModulDetail(_ref) {
  var _data$data$name, _data$data, _data$data2;

  var idModul = _ref.idModul,
      linkModul = _ref.linkModul,
      linkVideo = _ref.linkVideo,
      linkSimulasi = _ref.linkSimulasi;
  var canvas = Object(react__WEBPACK_IMPORTED_MODULE_0__["useRef"])();

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(false),
      _useState2 = _slicedToArray(_useState, 2),
      showCanvas = _useState2[0],
      setShowCanvas = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(false),
      _useState4 = _slicedToArray(_useState3, 2),
      dropdownOpen = _useState4[0],
      setDropdownOpen = _useState4[1];

  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_7__["default"])("/modul/" + idModul + "/json"),
      data = _useFetch.data,
      isLoading = _useFetch.isLoading,
      isError = _useFetch.isError;

  var toggle = function toggle() {
    return setDropdownOpen(function (prevState) {
      return !prevState;
    });
  };

  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    console.log("dika idModul", idModul);
    console.log("dika data", data);
  }, []);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Row"], {
    className: "mb-1"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["Col"], {
    md: "12"
  }, !isLoading && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "text-left form-inline"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h3", null, (_data$data$name = data === null || data === void 0 ? void 0 : (_data$data = data.data) === null || _data$data === void 0 ? void 0 : _data$data.name) !== null && _data$data$name !== void 0 ? _data$data$name : '-'), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    id: "toggle",
    className: "ml-auto form-inline"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_ToggleSwitch_ToggleSwitch__WEBPACK_IMPORTED_MODULE_8__["default"], {
    id: "showCanvas",
    small: true,
    checked: showCanvas,
    onChange: setShowCanvas
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
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_icons_fi__WEBPACK_IMPORTED_MODULE_5__["FiMoreVertical"], {
    size: "15"
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["DropdownMenu"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["DropdownItem"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("a", {
    href: linkModul
  }, "Modul Pembelajaran")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["DropdownItem"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("a", {
    href: linkVideo
  }, "Video Pembelajaran")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_2__["DropdownItem"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("a", {
    href: linkSimulasi
  }, "Simulasi Pembelajaran")))))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("hr", null)))), isLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("p", null, "Loading...") : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, showCanvas && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    id: "layer-coret",
    style: {
      position: "absolute",
      paddingRight: "12px"
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
  }, "Redo"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_sketch_canvas__WEBPACK_IMPORTED_MODULE_6__["ReactSketchCanvas"], {
    ref: canvas,
    style: styles,
    width: "100%",
    height: "800px",
    strokeWidth: 3,
    strokeColor: "black"
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    style: {
      overflowX: 'auto',
      height: '100%'
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("object", {
    data: data === null || data === void 0 ? void 0 : (_data$data2 = data.data) === null || _data$data2 === void 0 ? void 0 : _data$data2.pdf_url,
    type: "application/pdf",
    width: "100%",
    height: "800px"
  }))));
}

/* harmony default export */ __webpack_exports__["default"] = (ModulDetail);
var container = document.getElementById("modul-detail-fe");

if (container) {
  var idModul = container.getAttribute("modul-id");
  var linkModul = container.getAttribute("link-modul");
  var linkVideo = container.getAttribute("link-video");
  var linkSimulasi = container.getAttribute("link-simulasi");
  react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(ModulDetail, {
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