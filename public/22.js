(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[22],{

/***/ "./node_modules/zustand/index.js":
/*!***************************************!*\
  !*** ./node_modules/zustand/index.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);


function create(createState) {
  let state;
  const listeners = new Set();

  const setState = (partial, replace) => {
    const nextState = typeof partial === 'function' ? partial(state) : partial;

    if (nextState !== state) {
      const previousState = state;
      state = replace ? nextState : Object.assign({}, state, nextState);
      listeners.forEach(listener => listener(state, previousState));
    }
  };

  const getState = () => state;

  const subscribeWithSelector = (listener, selector = getState, equalityFn = Object.is) => {
    let currentSlice = selector(state);

    function listenerToAdd() {
      const nextSlice = selector(state);

      if (!equalityFn(currentSlice, nextSlice)) {
        const previousSlice = currentSlice;
        listener(currentSlice = nextSlice, previousSlice);
      }
    }

    listeners.add(listenerToAdd); // Unsubscribe

    return () => listeners.delete(listenerToAdd);
  };

  const subscribe = (listener, selector, equalityFn) => {
    if (selector || equalityFn) {
      return subscribeWithSelector(listener, selector, equalityFn);
    }

    listeners.add(listener); // Unsubscribe

    return () => listeners.delete(listener);
  };

  const destroy = () => listeners.clear();

  const api = {
    setState,
    getState,
    subscribe,
    destroy
  };
  state = createState(setState, getState, api);
  return api;
}

const useIsoLayoutEffect = typeof window === 'undefined' ? react__WEBPACK_IMPORTED_MODULE_0__["useEffect"] : react__WEBPACK_IMPORTED_MODULE_0__["useLayoutEffect"];
function create$1(createState) {
  const api = typeof createState === 'function' ? create(createState) : createState;

  const useStore = (selector = api.getState, equalityFn = Object.is) => {
    const [, forceUpdate] = Object(react__WEBPACK_IMPORTED_MODULE_0__["useReducer"])(c => c + 1, 0);
    const state = api.getState();
    const stateRef = Object(react__WEBPACK_IMPORTED_MODULE_0__["useRef"])(state);
    const selectorRef = Object(react__WEBPACK_IMPORTED_MODULE_0__["useRef"])(selector);
    const equalityFnRef = Object(react__WEBPACK_IMPORTED_MODULE_0__["useRef"])(equalityFn);
    const erroredRef = Object(react__WEBPACK_IMPORTED_MODULE_0__["useRef"])(false);
    const currentSliceRef = Object(react__WEBPACK_IMPORTED_MODULE_0__["useRef"])();

    if (currentSliceRef.current === undefined) {
      currentSliceRef.current = selector(state);
    }

    let newStateSlice;
    let hasNewStateSlice = false; // The selector or equalityFn need to be called during the render phase if
    // they change. We also want legitimate errors to be visible so we re-run
    // them if they errored in the subscriber.

    if (stateRef.current !== state || selectorRef.current !== selector || equalityFnRef.current !== equalityFn || erroredRef.current) {
      // Using local variables to avoid mutations in the render phase.
      newStateSlice = selector(state);
      hasNewStateSlice = !equalityFn(currentSliceRef.current, newStateSlice);
    } // Syncing changes in useEffect.


    useIsoLayoutEffect(() => {
      if (hasNewStateSlice) {
        currentSliceRef.current = newStateSlice;
      }

      stateRef.current = state;
      selectorRef.current = selector;
      equalityFnRef.current = equalityFn;
      erroredRef.current = false;
    });
    const stateBeforeSubscriptionRef = Object(react__WEBPACK_IMPORTED_MODULE_0__["useRef"])(state);
    Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(() => {
      const listener = () => {
        try {
          const nextState = api.getState();
          const nextStateSlice = selectorRef.current(nextState);

          if (!equalityFnRef.current(currentSliceRef.current, nextStateSlice)) {
            stateRef.current = nextState;
            currentSliceRef.current = nextStateSlice;
            forceUpdate();
          }
        } catch (error) {
          erroredRef.current = true;
          forceUpdate();
        }
      };

      const unsubscribe = api.subscribe(listener);

      if (api.getState() !== stateBeforeSubscriptionRef.current) {
        listener(); // state has changed before subscription
      }

      return unsubscribe;
    }, []);
    return hasNewStateSlice ? newStateSlice : currentSliceRef.current;
  };

  Object.assign(useStore, api); // For backward compatibility (No TS types for this)

  useStore[Symbol.iterator] = function* () {
    console.warn('[useStore, api] = create() is deprecated and will be removed in v4');
    yield useStore;
    yield api;
  };

  return useStore;
}

/* harmony default export */ __webpack_exports__["default"] = (create$1);


/***/ }),

/***/ "./resources/js/components/Example.js":
/*!********************************************!*\
  !*** ./resources/js/components/Example.js ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _store_LocationStore__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../store/LocationStore */ "./resources/js/store/LocationStore.js");




function Example(_ref) {
  var data = _ref.data;

  var _useLocationStore = Object(_store_LocationStore__WEBPACK_IMPORTED_MODULE_2__["default"])(),
      hasError = _useLocationStore.hasError,
      latitude = _useLocationStore.latitude,
      longitude = _useLocationStore.longitude,
      setCurrentPosition = _useLocationStore.setCurrentPosition;

  Object(react__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(function () {
    navigator.geolocation.getCurrentPosition(function (position) {
      setCurrentPosition({
        latitude: position.coords.latitude,
        longitude: position.coords.longitude,
        error: false
      });
    }, function (err) {
      setCurrentPosition({
        latitude: null,
        longitude: null,
        error: true
      });
    });
  }, []);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null);
}

/* harmony default export */ __webpack_exports__["default"] = (Example);

if (document.getElementById('example')) {
  var data = document.getElementById('example').getAttribute("data");
  react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(Example, {
    data: data
  }), document.getElementById('example'));
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

/***/ })

}]);