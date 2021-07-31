(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[16],{

/***/ "./resources/js/components/Home/NearestMitra.js":
/*!******************************************************!*\
  !*** ./resources/js/components/Home/NearestMitra.js ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _store_LocationStore__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../store/LocationStore */ "./resources/js/store/LocationStore.js");
/* harmony import */ var _store_useFetch__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../store/useFetch */ "./resources/js/store/useFetch.js");
/* harmony import */ var swr__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! swr */ "./node_modules/swr/esm/index.js");
/* harmony import */ var _iconify_react__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @iconify/react */ "./node_modules/@iconify/react/dist/icon.js");
/* harmony import */ var _iconify_react__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_iconify_react__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _iconify_icons_carbon_location_hazard_filled__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @iconify/icons-carbon/location-hazard-filled */ "./node_modules/@iconify/icons-carbon/location-hazard-filled.js");
/* harmony import */ var _iconify_icons_carbon_location_hazard_filled__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_iconify_icons_carbon_location_hazard_filled__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _assets_loading_svg__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../assets/loading.svg */ "./resources/js/components/assets/loading.svg");
/* harmony import */ var _assets_loading_svg__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_assets_loading_svg__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _utls__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../utls */ "./resources/js/components/utls.js");










function NearestMitra(_ref) {
  var data = _ref.data;
  return function (data) {
    var _useLocationStore = Object(_store_LocationStore__WEBPACK_IMPORTED_MODULE_2__["default"])(),
        hasError = _useLocationStore.hasError,
        latitude = _useLocationStore.latitude,
        longitude = _useLocationStore.longitude,
        setCurrentPosition = _useLocationStore.setCurrentPosition;

    var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_3__["default"])(!hasError ? "/home/nearestmitra?" + Object(_utls__WEBPACK_IMPORTED_MODULE_8__["encodeQuery"])({
      latitude: latitude,
      longitude: longitude
    }) : null),
        data = _useFetch.data,
        isLoading = _useFetch.isLoading,
        isError = _useFetch.isError;

    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
      "class": "row "
    }, hasError ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(NoLocationScreen, null) : isLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(LoadingScreen, null) : data.map(function (item) {
      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "col-lg-3 col-md-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "card  "
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("img", {
        className: "card-img-top",
        src: item.photo,
        alt: "Card image cap",
        height: "241px"
      }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
        className: "card-body"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h4", {
        className: "card-title"
      }, item.name), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
        className: "card-text"
      }, item.distance_in_km ? item.distance_in_km.toFixed() : 0, " Km"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("p", {
        className: "card-text"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("small", {
        className: "text-muted"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("i", {
        className: "fa fa-map-marker"
      }, " "), " ", item.district ? item.district.name : "Not Set")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("p", {
        style: {
          textAlign: 'center'
        }
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("a", {
        href: "/toko/" + item.id,
        className: "btn btn-danger btn-md",
        style: {
          width: '100%'
        }
      }, "Lihat Toko")))));
    })));
  }(data);
}

function NoLocationScreen() {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    "class": "card card-no-locations col-lg-12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    "class": "card-body  text-center "
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_iconify_react__WEBPACK_IMPORTED_MODULE_5__["Icon"], {
    icon: _iconify_icons_carbon_location_hazard_filled__WEBPACK_IMPORTED_MODULE_6___default.a,
    width: 200,
    color: "#999999"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("p", {
    "class": "card-text text-center mt-2"
  }, "Ups . Lokasi belum di set"))));
}

function LoadingScreen() {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    "class": "card card-no-locations col-lg-12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    "class": "card-body  text-center "
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("img", {
    src: _assets_loading_svg__WEBPACK_IMPORTED_MODULE_7___default.a,
    "class": "",
    width: "200px",
    alt: ""
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("p", {
    "class": "card-text text-center mt-2"
  }, "Sedang Mengambil Data"))));
}

/* harmony default export */ __webpack_exports__["default"] = (NearestMitra);

if (document.getElementById('nearestmitra')) {
  react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(NearestMitra, null), document.getElementById('nearestmitra'));
}

/***/ }),

/***/ "./resources/js/components/assets/loading.svg":
/*!****************************************************!*\
  !*** ./resources/js/components/assets/loading.svg ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/loading.svg?18c817a3629b66748247d40c6234c549";

/***/ }),

/***/ "./resources/js/components/utls.js":
/*!*****************************************!*\
  !*** ./resources/js/components/utls.js ***!
  \*****************************************/
/*! exports provided: encodeQuery, calcCrow */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "encodeQuery", function() { return encodeQuery; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "calcCrow", function() { return calcCrow; });
function encodeQuery(data) {
  var query = "";

  for (var d in data) {
    query += encodeURIComponent(d) + '=' + encodeURIComponent(data[d]) + '&';
  }

  return query.slice(0, -1);
} // alert(calcCrow(59.3293371,13.4877472,59.3225525,13.4619422).toFixed(1));
//This function takes in latitude and longitude of two location and returns the distance between them as the crow flies (in km)


function calcCrow(lat1, lon1, lat2, lon2) {
  var R = 6371; // km

  var dLat = toRad(lat2 - lat1);
  var dLon = toRad(lon2 - lon1);
  var lat1 = toRad(lat1);
  var lat2 = toRad(lat2);
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  return d;
} // Converts numeric degrees to radians


function toRad(Value) {
  return Value * Math.PI / 180;
}



/***/ }),

/***/ "./resources/js/store/LocationStore.js":
/*!*********************************************!*\
  !*** ./resources/js/store/LocationStore.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var zustand__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! zustand */ "./node_modules/zustand/index.js");

var useLocationStore = Object(zustand__WEBPACK_IMPORTED_MODULE_0__["default"])(function (set) {
  return {
    hasError: true,
    latitude: null,
    longitude: null,
    setCurrentPosition: function setCurrentPosition(position) {
      set(function (state) {
        return {
          latitude: position.latitude,
          longitude: position.longitude,
          hasError: position.error
        };
      });
    }
  };
});
/* harmony default export */ __webpack_exports__["default"] = (useLocationStore);

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