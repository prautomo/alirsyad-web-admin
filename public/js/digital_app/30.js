(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[30],{

/***/ "./resources/js/components/Transaction/CustomerTransaction.js":
/*!********************************************************************!*\
  !*** ./resources/js/components/Transaction/CustomerTransaction.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _store_useFetch__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../store/useFetch */ "./resources/js/store/useFetch.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var numeral__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! numeral */ "./node_modules/numeral/numeral.js");
/* harmony import */ var numeral__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(numeral__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _Products__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../Products */ "./resources/js/components/Products/index.js");
/* harmony import */ var _utls__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../utls */ "./resources/js/components/utls.js");
/* harmony import */ var _CustomerTransactionRenderer__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./CustomerTransactionRenderer */ "./resources/js/components/Transaction/CustomerTransactionRenderer.js");
/* harmony import */ var _Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../Form/InputRenderer */ "./resources/js/components/Form/InputRenderer.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }










var status_transaksi_const = {
  "NEW": "Pesanan Baru",
  "NOT_PAID": "Menunggu Pembayaran",
  "WAIT_CONFIRM_PAID": "Menunggu verifikasi",
  "PAID": "Pesanan Sudah Diverifikasi DigiBook",
  "WAIT_MITRA_CONFIRM": "Pesanan Menunggu Konfirmasi Mitra",
  "MITRA_CONFIRM_ACC": "Pesanan Sedang diproses",
  "MITRA_CONFIRM_DEC": "Pesanan Ditolak",
  "MITRA_SEND": "Pesanan Anda Sedang Dikirim",
  "CUSTOMER_RECEIVE": "Pesanan Sudah Diterima",
  "CUSTOMER_COMPLAINT": "customer Melakukan Komplain",
  "DIBATALKAN": "Pesanan Dibatalkan",
  "BERMAN_COMPLAINT_ACC": "Komplain Diterima DigiBook",
  "BERMAN_COMPLAINT_DEC": "Komplain Ditolak DigiBook"
};
var map_page_header = {
  "recent": "Pesanan Terbaru",
  "process": " Pesanan Sedang Di Proses",
  "new": "Pesanan  Baru",
  "finish": "Pesanan Selesai"
};

function CustomerTransaction(_ref) {
  var status = _ref.status;

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])({}),
      _useState2 = _slicedToArray(_useState, 2),
      pageConfig = _useState2[0],
      setPageConfig = _useState2[1];

  var _useFetch = Object(_store_useFetch__WEBPACK_IMPORTED_MODULE_2__["default"])("/customer/transaction/" + status + "/data?" + Object(_utls__WEBPACK_IMPORTED_MODULE_6__["encodeQuery"])(pageConfig)),
      data = _useFetch.data,
      isLoading = _useFetch.isLoading,
      isEroor = _useFetch.isEroor;

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    "class": "d-flex  flex-column"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex flex-row w-100 justify-content-between"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h4", null, map_page_header[status]), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_Form_InputRenderer__WEBPACK_IMPORTED_MODULE_8__["InputWithLabel"], {
    label: null,
    onChange: function onChange(e) {
      setPageConfig(_objectSpread(_objectSpread({}, pageConfig), {
        search: e
      }));
    },
    placeholder: "Pencarian"
  }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("hr", null), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    "class": "d-flex flex-column "
  }, isLoading ? "Loading" : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_CustomerTransactionRenderer__WEBPACK_IMPORTED_MODULE_7__["default"], {
    data: data,
    role: "CUSTOMER",
    setRevalidate: function setRevalidate(token) {
      setPageConfig(_objectSpread(_objectSpread({}, pageConfig), {
        "revalidate": token
      }));
    }
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(_Products__WEBPACK_IMPORTED_MODULE_5__["Pagination"], {
    pagination: data,
    current_page: 1,
    setPageConfig: setPageConfig
  })))));
}

/* harmony default export */ __webpack_exports__["default"] = (CustomerTransaction);

if (document.getElementById('transaction-list-container')) {
  var container = document.getElementById("transaction-list-container");
  var status = container.getAttribute("status");
  react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(CustomerTransaction, {
    status: status ? status : "recent"
  }), container);
}

/***/ }),

/***/ "./resources/js/components/Transaction/CustomerTransactionRenderer.js":
/*!****************************************************************************!*\
  !*** ./resources/js/components/Transaction/CustomerTransactionRenderer.js ***!
  \****************************************************************************/
/*! exports provided: default, TransactionDetailModal */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return CustomerTransactionRenderer; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "TransactionDetailModal", function() { return TransactionDetailModal; });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var numeral__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! numeral */ "./node_modules/numeral/numeral.js");
/* harmony import */ var numeral__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(numeral__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var react_bootstrap__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-bootstrap */ "./node_modules/react-bootstrap/esm/index.js");
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }






var status_transaksi_const = {
  "NEW": "Pesanan Baru",
  "NOT_PAID": "Menunggu Pembayaran",
  "WAIT_CONFIRM_PAID": "Menunggu verifikasi",
  "PAID": "Pesanan Sudah Diverifikasi DigiBook",
  "WAIT_MITRA_CONFIRM": "Pesanan Menunggu Konfirmasi Mitra",
  "MITRA_CONFIRM_ACC": "Pesanan Sedang diproses",
  "MITRA_CONFIRM_DEC": "Pesanan Ditolak",
  "MITRA_SEND": "Pesanan Anda Sedang Dikirim",
  "CUSTOMER_RECEIVE": "Pesanan Sudah Diterima",
  "CUSTOMER_COMPLAINT": "customer Melakukan Komplain",
  "DIBATALKAN": "Pesanan Dibatalkan",
  "BERMAN_COMPLAINT_ACC": "Komplain Diterima DigiBook",
  "BERMAN_COMPLAINT_DEC": "Komplain Ditolak DigiBook"
};
var actionLabel = {
  "TERIMA": "Menerima Pesanan",
  "TOLAK": "Menolak Pesanan",
  "KIRIM": "Pengirim Pesanan",
  "CUSTOMER_TERIMA": "Menerima Pesanan  ? \n Pastikan Barang Yang Anda Dalam Keadaan Baik"
};
function CustomerTransactionRenderer(_ref) {
  var data = _ref.data,
      role = _ref.role,
      setRevalidate = _ref.setRevalidate;

  function customerAction(item, action) {
    sweetalert2__WEBPACK_IMPORTED_MODULE_3___default.a.fire({
      title: 'Konfirmasi ?',
      text: "Anda yakin akan  " + actionLabel[action],
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya'
    }).then(function (result) {
      if (result.isConfirmed) {
        window.axios.post("/customer/updatepesanan", {
          item: item,
          action: action
        }).then(function (res) {
          sweetalert2__WEBPACK_IMPORTED_MODULE_3___default.a.fire("Customer", res.data.message, "success");
          setRevalidate(Math.random());
        })["catch"](function (err) {
          sweetalert2__WEBPACK_IMPORTED_MODULE_3___default.a.fire("Opss.", err.response.data.message, "success");
          console.log(err);
        })["finally"](function () {});
      }
    });
  }

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(false),
      _useState2 = _slicedToArray(_useState, 2),
      showModal = _useState2[0],
      setShowModal = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])({}),
      _useState4 = _slicedToArray(_useState3, 2),
      currentItem = _useState4[0],
      setCurrentItem = _useState4[1];

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, data.data.length == 0 ? "Belum Ada Pesanan" : data.data.map(function (paymentItem) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
      className: "d-flex justify-content-between align-items-start mb-2 mt-2"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h5", {
      className: "mb-2"
    }, "Invoice : ", paymentItem.payment_number), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, status_transaksi_const[paymentItem.status_transaksi])), (paymentItem.status_transaksi === "NEW" || paymentItem.status_transaksi === "NOT_PAID") && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
      className: "d-flex flex-column"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("a", {
      href: paymentItem.deep_link_url,
      className: "btn btn-sm btn-primary  "
    }, "Bayar  ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("i", {
      "class": "fa fa-money",
      "aria-hidden": "true"
    })))), paymentItem.transactions.map(function (transItem) {
      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(RenderPerTrnsaction, {
        transItem: transItem,
        customerAction: customerAction,
        role: role,
        setShowModal: setShowModal,
        setCurrentItem: setCurrentItem
      });
    })));
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(TransactionDetailModal, {
    showModal: showModal,
    setShowModal: setShowModal,
    item: currentItem
  }));
}

function RenderPerTrnsaction(_ref2) {
  var transItem = _ref2.transItem,
      setShowModal = _ref2.setShowModal,
      setCurrentItem = _ref2.setCurrentItem,
      customerAction = _ref2.customerAction,
      role = _ref2.role;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "card mb-1"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "card-body p-2 "
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex justify-content-between"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex flex-column"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h5", {
    className: "card-title m-0"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "text-danger"
  }, transItem.kode_transaksi)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "text-muted"
  }, moment__WEBPACK_IMPORTED_MODULE_1___default()(transItem.created_at).format("D-M-Y"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex flex-column"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    "class": "badge badge-success text-black"
  }, status_transaksi_const[transItem.status_transaksi]))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex justify-content-between "
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex flex-row"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex flex-column",
    style: {
      width: '230px'
    }
  }, role === "CUSTOMER" && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, "Mitra : ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "text-muted"
  }, transItem.mitra.name)), role === "MITRA" && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, "Customer : ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "text-muted"
  }, transItem.customer.name)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, "Ongkos Kirim: ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "text-muted"
  }, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_2___default()(transItem.ongkos_kirim).format("0,0"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, "Tanggal Pengiriman: ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "text-muted"
  }, moment__WEBPACK_IMPORTED_MODULE_1___default()(transItem.waktu_pengiriman).format("DD-MM-Y")))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex flex-column"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, "Potongan: ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "text-muted"
  }, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_2___default()(transItem.diskon).format("0,0"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, "Total Transaksi : ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "text-muted"
  }, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_2___default()(Number(transItem.total_transaksi)).format("0,0"))))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex flex-row"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex flex-column"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("button", {
    className: "btn btn-success btn-sm",
    onClick: function onClick() {
      setShowModal(true);
      setCurrentItem(transItem);
    }
  }, "Detail")), transItem.status_transaksi === "MITRA_SEND" && role == "CUSTOMER" && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex flex-column"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("button", {
    onClick: function onClick() {
      customerAction(transItem, "CUSTOMER_TERIMA");
    },
    className: "btn btn-sm btn-primary  "
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("i", {
    "class": "fa fa-dropbox",
    "aria-hidden": "true"
  }), " \xA0Terima")))))));
}

function TransactionDetailModal(_ref3) {
  var showModal = _ref3.showModal,
      setShowModal = _ref3.setShowModal,
      item = _ref3.item;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_4__["Modal"], {
    show: showModal,
    onHide: function onHide() {
      setShowModal(false);
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_4__["Modal"].Header, {
    closeButton: true
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_4__["Modal"].Title, null, "Detail Transaksi")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_4__["Modal"].Body, null, item.detail && item.detail.map(function (detail) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
      "class": "card  m-1"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
      "class": "card-body p-2 d-flex flex-column"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h4", {
      "class": "card-title"
    }, detail.product.name), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("small", {
      "class": "card-title"
    }, detail.product.desc), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, "Jumlah : ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
      className: "text-muted"
    }, detail.jumlah)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", null, "Harga  : ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
      className: "text-muted"
    }, "Rp. ", numeral__WEBPACK_IMPORTED_MODULE_2___default()(detail.sub_total).format("0,0")))));
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_4__["Modal"].Footer, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react_bootstrap__WEBPACK_IMPORTED_MODULE_4__["Button"], {
    variant: "secondary",
    onClick: function onClick() {
      setShowModal(false);
    }
  }, "Close"))));
}



/***/ })

}]);