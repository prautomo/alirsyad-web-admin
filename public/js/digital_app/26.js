(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[26],{

/***/ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/guru/components/Progress/DetailSiswa.css":
/*!***********************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/postcss-loader/src??ref--6-2!./resources/js/guru/components/Progress/DetailSiswa.css ***!
  \***********************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/***/ }),

/***/ "./resources/js/guru/components/Progress/DetailSiswa.css":
/*!***************************************************************!*\
  !*** ./resources/js/guru/components/Progress/DetailSiswa.css ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/postcss-loader/src??ref--6-2!./DetailSiswa.css */ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./resources/js/guru/components/Progress/DetailSiswa.css");

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

/***/ "./resources/js/guru/components/Progress/DetailSiswa.js":
/*!**************************************************************!*\
  !*** ./resources/js/guru/components/Progress/DetailSiswa.js ***!
  \**************************************************************/
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
/* harmony import */ var _DetailSiswa_css__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./DetailSiswa.css */ "./resources/js/guru/components/Progress/DetailSiswa.css");
/* harmony import */ var _DetailSiswa_css__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_DetailSiswa_css__WEBPACK_IMPORTED_MODULE_8__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }










function DetailSiswa(_ref) {
  var idMapel = _ref.idMapel,
      idSiswa = _ref.idSiswa;

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(0),
      _useState2 = _slicedToArray(_useState, 2),
      activeTab = _useState2[0],
      setActiveTab = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState4 = _slicedToArray(_useState3, 2),
      isLoadingModul = _useState4[0],
      setIsLoadingModul = _useState4[1];

  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])([]),
      _useState6 = _slicedToArray(_useState5, 2),
      dataModul = _useState6[0],
      setDataModul = _useState6[1];

  var _useState7 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState8 = _slicedToArray(_useState7, 2),
      isLoadingVideo = _useState8[0],
      setIsLoadingVideo = _useState8[1];

  var _useState9 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])([]),
      _useState10 = _slicedToArray(_useState9, 2),
      dataVideo = _useState10[0],
      setDataVideo = _useState10[1];

  var _useState11 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState12 = _slicedToArray(_useState11, 2),
      isLoadingSimulasi = _useState12[0],
      setIsLoadingSimulasi = _useState12[1];

  var _useState13 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])([]),
      _useState14 = _slicedToArray(_useState13, 2),
      dataSimulasi = _useState14[0],
      setDataSimulasi = _useState14[1]; // const { data, isLoading, isError } = useFetch(`/guru/json/getModuls?q_mata_pelajaran_id=${idMapel}`)


  var toggleTab = /*#__PURE__*/function () {
    var _ref2 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(tabIndex, tabName) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              // load data
              if (tabName === "video") {
                loadDataVideo(idMapel, idSiswa);
              } else if (tabName === "simulasi") {
                loadDataSimulasi(idMapel, idSiswa);
              } else {
                loadDataModul(idMapel, idSiswa);
              } // switch tab


              if (activeTab !== tabIndex) setActiveTab(tabIndex);

            case 2:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));

    return function toggleTab(_x, _x2) {
      return _ref2.apply(this, arguments);
    };
  }();
  /**
   * load data modul
   * @param {*} mapelId 
   * @param {*} siswaId 
   */


  function loadDataModul(_x3, _x4) {
    return _loadDataModul.apply(this, arguments);
  }
  /**
   * load data video
   * @param {*} mapelId 
   * @param {*} siswaId 
   */


  function _loadDataModul() {
    _loadDataModul = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(mapelId, siswaId) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              setIsLoadingModul(true);
              _context2.next = 3;
              return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/guru/json/getModuls?q_mata_pelajaran_id=".concat(mapelId, "&q_siswa_id=").concat(siswaId), {
                headers: {
                  "Content-Type": "application/json"
                }
              }).then(function (response) {
                var data = response.data;

                if (data === null || data === void 0 ? void 0 : data.success) {
                  setDataModul(data === null || data === void 0 ? void 0 : data.data);
                }
              })["catch"](function (e) {
                var _e$response, _e$response$data;

                console.error("dika error", e === null || e === void 0 ? void 0 : (_e$response = e.response) === null || _e$response === void 0 ? void 0 : (_e$response$data = _e$response.data) === null || _e$response$data === void 0 ? void 0 : _e$response$data.message);
              });

            case 3:
              setIsLoadingModul(false);

            case 4:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2);
    }));
    return _loadDataModul.apply(this, arguments);
  }

  function loadDataVideo(_x5, _x6) {
    return _loadDataVideo.apply(this, arguments);
  }
  /**
   * load data simulasi
   * @param {*} mapelId 
   * @param {*} siswaId 
   */


  function _loadDataVideo() {
    _loadDataVideo = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(mapelId, siswaId) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              setIsLoadingVideo(true);
              _context3.next = 3;
              return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/guru/json/getVideos?q_mata_pelajaran_id=".concat(mapelId, "&q_siswa_id=").concat(siswaId), {
                headers: {
                  "Content-Type": "application/json"
                }
              }).then(function (response) {
                var data = response.data;

                if (data === null || data === void 0 ? void 0 : data.success) {
                  setDataVideo(data === null || data === void 0 ? void 0 : data.data);
                }
              })["catch"](function (e) {
                var _e$response2, _e$response2$data;

                console.error("dika error", e === null || e === void 0 ? void 0 : (_e$response2 = e.response) === null || _e$response2 === void 0 ? void 0 : (_e$response2$data = _e$response2.data) === null || _e$response2$data === void 0 ? void 0 : _e$response2$data.message);
              });

            case 3:
              setIsLoadingVideo(false);

            case 4:
            case "end":
              return _context3.stop();
          }
        }
      }, _callee3);
    }));
    return _loadDataVideo.apply(this, arguments);
  }

  function loadDataSimulasi(_x7, _x8) {
    return _loadDataSimulasi.apply(this, arguments);
  }

  function _loadDataSimulasi() {
    _loadDataSimulasi = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4(mapelId, siswaId) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
        while (1) {
          switch (_context4.prev = _context4.next) {
            case 0:
              setIsLoadingSimulasi(true);
              _context4.next = 3;
              return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/guru/json/getSimulasis?q_mata_pelajaran_id=".concat(mapelId, "&q_siswa_id=").concat(siswaId), {
                headers: {
                  "Content-Type": "application/json"
                }
              }).then(function (response) {
                var data = response.data;

                if (data === null || data === void 0 ? void 0 : data.success) {
                  setDataSimulasi(data === null || data === void 0 ? void 0 : data.data);
                }
              })["catch"](function (e) {
                var _e$response3, _e$response3$data;

                console.error("dika error", e === null || e === void 0 ? void 0 : (_e$response3 = e.response) === null || _e$response3 === void 0 ? void 0 : (_e$response3$data = _e$response3.data) === null || _e$response3$data === void 0 ? void 0 : _e$response3$data.message);
              });

            case 3:
              setIsLoadingSimulasi(false);

            case 4:
            case "end":
              return _context4.stop();
          }
        }
      }, _callee4);
    }));
    return _loadDataSimulasi.apply(this, arguments);
  }

  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {
    loadDataModul(idMapel, idSiswa);
  }, []);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Nav"], {
    tabs: true,
    className: "detail-progress-siswa-tabs"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["NavItem"], {
    key: 0
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["NavLink"], {
    href: "#",
    className: classnames__WEBPACK_IMPORTED_MODULE_7___default()({
      active: activeTab === 0
    }),
    onClick: function onClick() {
      toggleTab(0, 'modul');
    }
  }, "Modul")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["NavItem"], {
    key: 1
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["NavLink"], {
    href: "#",
    className: classnames__WEBPACK_IMPORTED_MODULE_7___default()({
      active: activeTab === 1
    }),
    onClick: function onClick() {
      toggleTab(1, 'video');
    }
  }, "Video")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["NavItem"], {
    key: 2
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["NavLink"], {
    href: "#",
    className: classnames__WEBPACK_IMPORTED_MODULE_7___default()({
      active: activeTab === 2
    }),
    onClick: function onClick() {
      toggleTab(2, 'simulasi');
    }
  }, "Simulasi"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["TabContent"], {
    activeTab: activeTab
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["TabPane"], {
    tabId: 0
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Row"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    sm: "12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Card"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["CardBody"], {
    className: "pr-0 pl-0"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react_table_scrollbar__WEBPACK_IMPORTED_MODULE_4___default.a, {
    height: "350px"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("table", {
    className: "table",
    id: "user"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("thead", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", {
    style: {
      backgroundColor: "#FFFFFF"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "5%",
    className: "text-center"
  }, "No"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "65%"
  }, "Nama Modul"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "30%"
  }, "Progres Modul"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tbody", null, !isLoadingModul && (dataModul === null || dataModul === void 0 ? void 0 : dataModul.map(function (val, idx) {
    var _val$name;

    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", {
      key: idx
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "5%",
      className: "text-center"
    }, idx + 1), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "65%",
      className: ""
    }, (_val$name = val['name']) !== null && _val$name !== void 0 ? _val$name : '-'), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "30%",
      className: "text-left"
    }, val['read'] ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
      className: "badge badge-success"
    }, "Selesai dipelajari") : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
      className: "badge badge-warning"
    }, "Sedang dipelajari")));
  })), isLoadingModul && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
    colSpan: "5",
    className: "text-center"
  }, "Loading...")), !isLoadingModul && dataModul.length < 1 && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
    colSpan: "5",
    className: "text-left"
  }, "Belum ada data.")))))))))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["TabPane"], {
    tabId: 1
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Row"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    sm: "12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Card"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["CardBody"], {
    className: "pr-0 pl-0"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react_table_scrollbar__WEBPACK_IMPORTED_MODULE_4___default.a, {
    height: "350px"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("table", {
    className: "table",
    id: "user"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("thead", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", {
    style: {
      backgroundColor: "#FFFFFF"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "5%",
    className: "text-center"
  }, "No"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "65%"
  }, "Nama Video"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "30%"
  }, "Progres Video"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tbody", null, !isLoadingVideo && (dataVideo === null || dataVideo === void 0 ? void 0 : dataVideo.map(function (val, idx) {
    var _val$name2;

    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", {
      key: idx
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "5%",
      className: "text-center"
    }, idx + 1), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "65%",
      className: ""
    }, (_val$name2 = val['name']) !== null && _val$name2 !== void 0 ? _val$name2 : '-'), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "30%",
      className: "text-left"
    }, val['watched'] ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
      "class": "badge badge-success"
    }, "Selesai ditonton") : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
      "class": "badge badge-warning"
    }, "Belum selesai ditonton")));
  })), isLoadingVideo && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
    colSpan: "5",
    className: "text-center"
  }, "Loading...")), !isLoadingVideo && dataVideo.length < 1 && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
    colSpan: "5",
    className: "text-left"
  }, "Belum ada data.")))))))))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["TabPane"], {
    tabId: 2
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Row"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Col"], {
    sm: "12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["Card"], null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_6__["CardBody"], {
    className: "pr-0 pl-0"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react_table_scrollbar__WEBPACK_IMPORTED_MODULE_4___default.a, {
    height: "350px",
    style: {
      overflowX: "hidden !important"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("table", {
    className: "table",
    id: "user"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("thead", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", {
    style: {
      backgroundColor: "#FFFFFF"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "5%",
    className: "text-center"
  }, "No"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "45%"
  }, "Nama Simulasi"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "10%",
    className: "text-center"
  }, "Total Percobaan"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "10%",
    className: "text-center"
  }, "Jumlah Berhasil", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("br", null), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    style: {
      fontSize: "8px"
    },
    className: "text-primary"
  }, "10 Percobaan terakhir")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "10%",
    className: "text-center"
  }, "Jumlah Gagal", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("br", null), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    style: {
      fontSize: "8px"
    },
    className: "text-primary"
  }, "10 Percobaan terakhir")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", {
    width: "20%",
    className: "text-center"
  }, "Nilai Siswa", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("br", null), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
    style: {
      fontSize: "8px"
    },
    className: "text-primary"
  }, "10 Percobaan terakhir")))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tbody", null, !isLoadingSimulasi && (dataSimulasi === null || dataSimulasi === void 0 ? void 0 : dataSimulasi.map(function (val, idx) {
    var _val$name3, _val$level, _val$total_percobaan, _val$10_percobaan_ter, _val$10_percobaan_ter2, _val$rata_rata_score;

    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", {
      key: idx
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "5%",
      className: "text-center"
    }, idx + 1), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "45%",
      className: ""
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("a", {
      href: "/guru/simulasi-percobaan/".concat(val['id'], "/detail?q_siswa_id=").concat(idSiswa),
      target: "_blank"
    }, (_val$name3 = val['name']) !== null && _val$name3 !== void 0 ? _val$name3 : '-', /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("br", null), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
      className: "text-primary",
      style: {
        fontSize: "12px"
      }
    }, "Level ", (_val$level = val['level']) !== null && _val$level !== void 0 ? _val$level : '-'))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "10%",
      className: "text-center"
    }, (_val$total_percobaan = val['total_percobaan']) !== null && _val$total_percobaan !== void 0 ? _val$total_percobaan : 0), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "10%",
      className: "text-center"
    }, (_val$10_percobaan_ter = val['10_percobaan_terakhir_berhasil']) !== null && _val$10_percobaan_ter !== void 0 ? _val$10_percobaan_ter : 0), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "10%",
      className: "text-center"
    }, (_val$10_percobaan_ter2 = val['10_percobaan_terakhir_gagal']) !== null && _val$10_percobaan_ter2 !== void 0 ? _val$10_percobaan_ter2 : 0), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
      width: "20%",
      className: "text-center"
    }, (_val$rata_rata_score = val['rata_rata_score']) !== null && _val$rata_rata_score !== void 0 ? _val$rata_rata_score : 0));
  })), isLoadingSimulasi && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
    colSpan: "5",
    className: "text-center"
  }, "Loading...")), !isLoadingSimulasi && dataSimulasi.length < 1 && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", {
    colSpan: "5",
    className: "text-left"
  }, "Belum ada data."))))))))))));
}

/* harmony default export */ __webpack_exports__["default"] = (DetailSiswa);
var container = document.getElementById("progress-detail-siswa");

if (container) {
  var idMapel = container.getAttribute("mapel-id");
  var idSiswa = container.getAttribute("siswa-id");
  react_dom__WEBPACK_IMPORTED_MODULE_2___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(DetailSiswa, {
    idMapel: idMapel,
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