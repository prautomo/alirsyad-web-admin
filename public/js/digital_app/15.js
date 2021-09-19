(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[15],{

/***/ "./resources/js/frontoffice/components/Video/Detail.js":
/*!*************************************************************!*\
  !*** ./resources/js/frontoffice/components/Video/Detail.js ***!
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
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var react_youtube__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react-youtube */ "./node_modules/react-youtube/dist/index.esm.js");
/* harmony import */ var _store_useFetch__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../../store/useFetch */ "./resources/js/store/useFetch.js");
/* harmony import */ var react_alert__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! react-alert */ "./node_modules/react-alert/dist/esm/react-alert.js");
/* harmony import */ var react_alert_template_basic__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! react-alert-template-basic */ "./node_modules/react-alert-template-basic/dist/esm/react-alert-template-basic.js");


function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }











function VideoDetail(_ref) {
  var _data$data2, _data$data3, _data$data3$previous, _data$data4, _data$data4$previous, _data$data5, _data$data5$next, _data$data6, _data$data6$next;

  var idVideo = _ref.idVideo;

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(idVideo),
      _useState2 = _slicedToArray(_useState, 2),
      videoId = _useState2[0],
      setVideoId = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState4 = _slicedToArray(_useState3, 2),
      showNext = _useState4[0],
      setShowNext = _useState4[1];

  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_6__["default"])("/video/" + idVideo + "/json"),
      data = _useFetch.data,
      isLoading = _useFetch.isLoading,
      isError = _useFetch.isError;

  var alert = Object(react_alert__WEBPACK_IMPORTED_MODULE_7__["useAlert"])();
  Object(react__WEBPACK_IMPORTED_MODULE_1__["useEffect"])(function () {// console.log("dika idVideo", idVideo)
  }, []);

  function _onReady(event) {
    var _data$data$watched, _data$data;

    // access to player in all event handlers via event.target
    // console.log("dika", event);
    // event.target.pauseVideo();
    setShowNext((_data$data$watched = data === null || data === void 0 ? void 0 : (_data$data = data.data) === null || _data$data === void 0 ? void 0 : _data$data.watched) !== null && _data$data$watched !== void 0 ? _data$data$watched : false);
  }

  function _onEnd(e) {
    // console.log("dika post flag", e);
    postFlag(videoId);
  }

  function postFlag(_x) {
    return _postFlag.apply(this, arguments);
  }

  function _postFlag() {
    _postFlag = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(idVideo) {
      var payload;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              payload = {};
              _context.next = 3;
              return axios__WEBPACK_IMPORTED_MODULE_4___default.a.post("/videos/".concat(idVideo, "/flag/json"), {
                payload: payload
              }).then(function (res) {
                setShowNext(true); // console.log("dika res post flag", res.data);

                alert.show('Berhasil menonton video!', {
                  timeout: 3000,
                  // custom timeout just for this one alert
                  type: 'success',
                  onOpen: function onOpen() {},
                  // callback that will be executed after this alert open
                  onClose: function onClose() {} // callback that will be executed after this alert is removed

                });
              })["catch"](function (e) {
                var _e$response$data;

                console.error("dika res post flag failed", e.response.data);
                alert.show((_e$response$data = e.response.data) === null || _e$response$data === void 0 ? void 0 : _e$response$data.message, {
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
              return _context.stop();
          }
        }
      }, _callee);
    }));
    return _postFlag.apply(this, arguments);
  }

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, isLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("p", null, "Loading...") : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react_youtube__WEBPACK_IMPORTED_MODULE_5__["default"], {
    videoId: data === null || data === void 0 ? void 0 : (_data$data2 = data.data) === null || _data$data2 === void 0 ? void 0 : _data$data2.youtubeId,
    opts: {
      height: '600',
      width: '100%',
      playerVars: {
        // https://developers.google.com/youtube/player_parameters
        fs: 1,
        autoplay: 0,
        controls: 0,
        disablekb: 1
      }
    },
    onReady: _onReady,
    onEnd: _onEnd
  }), (data === null || data === void 0 ? void 0 : (_data$data3 = data.data) === null || _data$data3 === void 0 ? void 0 : (_data$data3$previous = _data$data3.previous) === null || _data$data3$previous === void 0 ? void 0 : _data$data3$previous.url) && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    className: "mt-4 btn-main mr-4",
    href: data === null || data === void 0 ? void 0 : (_data$data4 = data.data) === null || _data$data4 === void 0 ? void 0 : (_data$data4$previous = _data$data4.previous) === null || _data$data4$previous === void 0 ? void 0 : _data$data4$previous.url
  }, "Video Sebelumnya"), showNext && (data === null || data === void 0 ? void 0 : (_data$data5 = data.data) === null || _data$data5 === void 0 ? void 0 : (_data$data5$next = _data$data5.next) === null || _data$data5$next === void 0 ? void 0 : _data$data5$next.url) && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(reactstrap__WEBPACK_IMPORTED_MODULE_3__["Button"], {
    className: "mt-4 btn-main",
    href: data === null || data === void 0 ? void 0 : (_data$data6 = data.data) === null || _data$data6 === void 0 ? void 0 : (_data$data6$next = _data$data6.next) === null || _data$data6$next === void 0 ? void 0 : _data$data6$next.url
  }, "Video Berikutnya")));
}

/* harmony default export */ __webpack_exports__["default"] = (VideoDetail);
var options = {
  position: 'bottom right',
  timeout: 3000,
  offset: '30px',
  transition: 'scale'
};

var RootVideoDetail = function RootVideoDetail(props) {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react_alert__WEBPACK_IMPORTED_MODULE_7__["Provider"], _extends({
    template: react_alert_template_basic__WEBPACK_IMPORTED_MODULE_8__["default"]
  }, options), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(VideoDetail, {
    idVideo: props === null || props === void 0 ? void 0 : props.idVideo
  }));
};

var container = document.getElementById("video-detail-fe");

if (container) {
  var idVideo = container.getAttribute("video-id");
  react_dom__WEBPACK_IMPORTED_MODULE_2___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(RootVideoDetail, {
    idVideo: idVideo
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