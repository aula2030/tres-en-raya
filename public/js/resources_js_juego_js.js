(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_juego_js"],{

/***/ "./resources/js/juego.js":
/*!*******************************!*\
  !*** ./resources/js/juego.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (function () {
  var celdasLibres = document.querySelectorAll('.celda-tablero-libre');
  celdasLibres.forEach(function (celda) {
    celda.addEventListener('click', function () {
      nuevoMovimiento(celda.dataset.indexNumber);
    });
  });

  function nuevoMovimiento(posicion) {
    var formMovimiento = document.getElementById('formMovimiento');
    formMovimiento.elements.namedItem("celdaSeleccionada").value = posicion;
    formMovimiento.submit();
  }
});

/***/ })

}]);