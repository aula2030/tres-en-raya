export default () => {

    let celdasLibres = document.querySelectorAll('.celda-tablero-libre');

    celdasLibres.forEach(function (celda) {
        celda.addEventListener('click', () => { nuevoMovimiento(celda.dataset.indexNumber); });
    })

    function nuevoMovimiento(posicion) {
        let formMovimiento = document.getElementById('formMovimiento');
        formMovimiento.elements.namedItem("celdaSeleccionada").value = posicion;
        formMovimiento.submit();
    }

};
