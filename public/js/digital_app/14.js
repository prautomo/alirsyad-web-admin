(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[14],{

/***/ "./resources/js/backoffice/components/ExternalUser/index.js":
/*!******************************************************************!*\
  !*** ./resources/js/backoffice/components/ExternalUser/index.js ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var query_string__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! query-string */ "./node_modules/query-string/index.js");
/* harmony import */ var query_string__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(query_string__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var react_dropzone__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react-dropzone */ "./node_modules/react-dropzone/dist/es/index.js");
/* harmony import */ var xlsx__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! xlsx */ "./node_modules/xlsx/xlsx.js");
/* harmony import */ var xlsx__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(xlsx__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var react_bootstrap__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react-bootstrap */ "./node_modules/react-bootstrap/esm/index.js");
/* harmony import */ var validator__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! validator */ "./node_modules/validator/index.js");
/* harmony import */ var validator__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(validator__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_7__);
function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }










function UploadBatchSiswa() {
  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])({}),
      _useState2 = _slicedToArray(_useState, 2),
      queryParams = _useState2[0],
      setQueryParams = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])({}),
      _useState4 = _slicedToArray(_useState3, 2),
      params = _useState4[0],
      setParams = _useState4[1];

  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])([]),
      _useState6 = _slicedToArray(_useState5, 2),
      excelData = _useState6[0],
      setExcelData = _useState6[1];

  var _useState7 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])([]),
      _useState8 = _slicedToArray(_useState7, 2),
      tingkats = _useState8[0],
      setTingkats = _useState8[1];

  var onDrop = Object(react__WEBPACK_IMPORTED_MODULE_0__["useCallback"])(function (acceptedFiles) {
    acceptedFiles.forEach(function (file) {
      var reader = new FileReader();

      reader.onabort = function () {
        return console.log('file reading was aborted');
      };

      reader.onerror = function () {
        return console.log('file reading has failed');
      };

      reader.onload = function () {
        // Do whatever you want with the file contents
        // const binaryStr = reader.result
        // console.log(binaryStr)

        /* Parse data */
        var bstr = reader.result;
        var wb = xlsx__WEBPACK_IMPORTED_MODULE_4__["read"](bstr, {
          type: 'binary'
        });
        /* Get first worksheet */

        var wsname = wb.SheetNames[0];
        var ws = wb.Sheets[wsname];
        /* Convert array of arrays */

        var data = xlsx__WEBPACK_IMPORTED_MODULE_4__["utils"].sheet_to_json(ws, {
          header: "A"
        });
        /* Update state */

        data.splice(0, 1);
        console.log("Data>>>", data); // load tingkat

        getTingkats(); // set excel data

        setExcelData(data);
      };

      reader.readAsBinaryString(file);
    });
  }, []);

  var _useDropzone = Object(react_dropzone__WEBPACK_IMPORTED_MODULE_3__["useDropzone"])({
    onDrop: onDrop
  }),
      getRootProps = _useDropzone.getRootProps,
      getInputProps = _useDropzone.getInputProps;

  var doUploadBatch = function doUploadBatch() {
    if (excelData.length < 1) {
      sweetalert2__WEBPACK_IMPORTED_MODULE_7___default.a.fire("Gagal Mengupload", "Data masih kosong!");
      return;
    }

    window.axios.post("/backoffice/external-users/import", {
      data: excelData,
      params: params
    }).then(function (response) {
      console.log(response.data.data); // Swal.fire("Berhasil Mengupload", response.data.message)

      sweetalert2__WEBPACK_IMPORTED_MODULE_7___default.a.fire({
        title: 'Berhasil Mengupload',
        showDenyButton: false,
        showCancelButton: false,
        confirmButtonText: "OK"
      }).then(function (result) {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          window.location.href = '/backoffice/external-users?role=SISWA';
        }
      });
    })["catch"](function (err) {
      sweetalert2__WEBPACK_IMPORTED_MODULE_7___default.a.fire("Gagal Mengupload", err.response.data.message);
    });
  }; // const onUploadSuccess = (index, url) => {
  //     const currentItem = Object.assign({}, excelData[index]);
  //     currentItem.default_image = url
  //     excelData[index] = currentItem
  //     console.log(excelData)
  //     setExcelData(excelData)
  // }


  var onTingkatChange = function onTingkatChange(index, val) {
    var currentItem = Object.assign({}, excelData[index]);
    currentItem.G = val;
    excelData[index] = currentItem;
    setExcelData(excelData);
  };

  var onKelasChange = function onKelasChange(index, val) {
    var currentItem = Object.assign({}, excelData[index]);
    currentItem.H = val;
    excelData[index] = currentItem;
    setExcelData(excelData);
  };

  var handleRemove = function handleRemove(index) {
    return function () {
      var rows = _toConsumableArray(excelData);

      rows.splice(index, 1);
      setExcelData(rows); // use nis
      // let items = excelData.filter(row => row.A != item.A);
      // setExcelData(items);
    };
  };

  var getTingkats = function getTingkats() {
    window.axios.get("/backoffice/tingkats").then(function (response) {
      console.log("dika", response.data);
      setTingkats(response.data.data);
    });
  };

  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    var params = query_string__WEBPACK_IMPORTED_MODULE_2___default.a.parse(location.search);
    setQueryParams(params);
  }, [excelData]);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "row gap-20 masonry pos-r"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "masonry-sizer col-lg-12"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "masonry-item col-lg-12"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "bd bgc-white"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "layers"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    className: "mt-2 text-left pl-0"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h3", null, "1. Download Sample Excel"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__["Button"], {
    className: "btn-info",
    size: "sm",
    onClick: function onClick() {
      window.location.href = '/uploads/template_batch_siswa.xlsx';
    }
  }, "Download Template")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "layer w-100 p-20 mt-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h3", null, "2. Upload File Excel"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", _extends({}, getRootProps(), {
    style: {
      border: "1px dashed #dddddd",
      borderRadius: "5px"
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("input", getInputProps()), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("p", {
    style: {
      textAlign: "center",
      marginTop: 10
    }
  }, "Geser File Excel Ke sini"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__["Col"], {
    className: "mt-2 text-left pl-0"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h3", null, "3. Upload Data or Cancel"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__["Button"], {
    color: "primary",
    size: "sm",
    onClick: doUploadBatch
  }, "Upload Data"), " ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__["Button"], {
    className: "btn-secondary",
    size: "sm",
    onClick: function onClick() {
      window.location.href = '/backoffice/external-users?role=SISWA';
    }
  }, "Cancel")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "layer w-100 p-20 mt-2"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h3", null, "Preview Data"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("table", {
    className: "table table-bordered"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("thead", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("tr", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("th", {
    width: "15%"
  }, "NIS"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("th", {
    width: "15%"
  }, "Name"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("th", {
    width: "15%"
  }, "Jenjang Pendidikan"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("th", {
    width: "15%"
  }, "Kelas"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("th", {
    width: "15%"
  }, "Email"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("th", {
    width: "5%"
  }, "Aksi"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("tbody", null, excelData.map(function (item, index) {
    // init var
    var nisCol = item.A;
    var nameCol = item.B;
    var jenjangCol = item.C;
    var tingkatCol = item.D;
    var kelasCol = item.E ? item.E : '-';
    var usernameCol = item.F ? item.F : '-';
    var passwordCol = item.G;
    var emailCol = item.H;
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("tr", {
      key: index
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("td", null, nisCol), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("td", null, nameCol), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("td", null, jenjangCol), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("td", null, tingkatCol, " ", kelasCol), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("td", null, emailCol, !validator__WEBPACK_IMPORTED_MODULE_6___default.a.isEmail(emailCol) && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("br", null), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("small", {
      className: "text-danger"
    }, "Email not valid."))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("td", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("a", {
      onClick: handleRemove(index),
      style: {
        cursor: "pointer"
      }
    }, "Delete")));
  })), excelData.length === 0 && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("tr", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("td", {
    colSpan: "7"
  }, "No data."))))))));
}

/* harmony default export */ __webpack_exports__["default"] = (UploadBatchSiswa);

if (document.getElementById('uploadsiswa-list')) {
  react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(UploadBatchSiswa, null), document.getElementById('uploadsiswa-list'));
}

/***/ }),

/***/ 1:
/*!********************!*\
  !*** fs (ignored) ***!
  \********************/
/*! no static exports found */
/***/ (function(module, exports) {

/* (ignored) */

/***/ }),

/***/ 2:
/*!************************!*\
  !*** crypto (ignored) ***!
  \************************/
/*! no static exports found */
/***/ (function(module, exports) {

/* (ignored) */

/***/ }),

/***/ 3:
/*!************************!*\
  !*** stream (ignored) ***!
  \************************/
/*! no static exports found */
/***/ (function(module, exports) {

/* (ignored) */

/***/ })

}]);