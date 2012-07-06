/**
 * Funciones JavaScript que procesan del modulo de Almacen
 * 
 * @author      Ruben Lacasa <ruben@ensenalia.com>
 * @package     cniEstable/almacen
 * @license     Creative Commons Atribución-NoComercial-SinDerivadas 3.0 Unported
 * @version     2.0e Estable
 * @link        https://github.com/sbarrat/cniEstable
 * @requires    Prototype JavaScript framework, version 1.5.0
 * @todo        Migrar a JQuery
 */
/**
 * [url description]
 * 
 * @type {String}
 */
var url = 'datos.php';
/**
 * [pars description]
 * 
 * @type {[type]}
 */
var pars = null;
/**
 * [myAjax description]
 * 
 * @type {[type]}
 */
var myAjax = null;
/**
 * Procesa la solicitud Ajax
 * 
 * @param  {string}   url      url de destino
 * @param  {string}   pars     parametros
 * @param  {Function} callback funcion que ejecutamos una vez procesada la solicitud
 * 
 * @return {[type]}            [description]
 */
var procesaSolicitud = function (url, pars, callback) {
    "use strict";
    myAjax = new Ajax.Request(
        url,
        {
            method: 'post',
            parameters: pars,
            onComplete: callback
        }
    );
};
/**
 * [tabla description]
 * 
 * @param  {[type]} nuval [description]
 * 
 * @return {[type]}       [description]
 */
function tabla(nuval) {
    "use strict";
    pars = 'tabla=' + nuval;
    myAjax = new Ajax.Request(
        url,
        {
            method: 'get',
            parameters: pars,
            onComplete:
                function gen(respuesta) {
                    $('tabla_datos').innerHTML = respuesta.responseText;
                }
        }
    );
}
/**
 * [generadora description]
 * 
 * @param  {[type]} respuesta [description]
 * 
 * @return {[type]}           [description]
 */
function generadora(respuesta) {
    "use strict";
    $('formulario_almacen').innerHTML = respuesta.responseText;
    Calendar.setup({
        inputField      : 'finicio',      // id of the input field
        ifFormat        : '%d/%m/%Y',       // format of the input field
        showsTime       : true,            // will display a time selector
        button          : 'f_trigger_a',   // trigger for the calendar (button ID)
        singleClick     : false,           // double-click mode
        step            : 1                // show all years in drop-down boxes (instead of every other year as default)
    });
    Calendar.setup({
        inputField      : 'ffinal',      // id of the input field
        ifFormat        : '%d/%m/%Y',       // format of the input field
        showsTime       : true,            // will display a time selector
        button          : 'f_trigger_b',   // trigger for the calendar (button ID)
        singleClick     : false,           // double-click mode
        step            : 1                // show all years in drop-down boxes (instead of every other year as default)
    });
    var nuval = $F('cliente');
    tabla(nuval);
}
/**
 * [abre description]
 * 
 * @return {[type]} [description]
 */
function abre() {
    "use strict";
    pars = 'cliente=' + $F('cliente');
    procesaSolicitud(url, pars, generadora);
}
/**
 * [abreform description]
 * 
 * @return {[type]} [description]
 */
function abreform() {
    "use strict";
	$('formulario_almacen').innerHTML = 'Cargando Datos ... <p/>' +
        '<img src="../imagenes/loader.gif" alt="Actualizando Datos.." />';
	abre();
}
/**
 * [a_almacen description]
 * 
 * @return {[type]} [description]
 */
function a_almacen() {
    "use strict";
	pars = 'op=' + $F('opcion') + '&bcliente=' + $F('cliente') +
        '&bultos=' + $F('bultos') + '&finicio=' + $F('finicio') +
        '&ffinal=' + $F('ffinal');
	procesaSolicitud(url, pars, abreform);
}
/**
 * [edita_almacen description]
 * 
 * @param  {[type]} item [description]
 * 
 * @return {[type]}      [description]
 */
function edita_almacen(item) {
	"use strict";
	pars = 'cliente=' + $F('cliente') + '&item=' + item;
	procesaSolicitud(url, pars, generadora);
}
/**
 * [borra_almacen description]
 * 
 * @param  {[type]} item [description]
 * 
 * @return {[type]}      [description]
 */
function borra_almacen(item) {
	"use strict";
    pars = 'borra=' + item;
	if (confirm("Borrar almacenaje?")) {
        procesaSolicitud(url, pars, abre);
	}
}
/**
 * [reportError description]
 * 
 * @return {[type]} [description]
 */
function reportError() {
    "use strict";
	alert("Error");
}
