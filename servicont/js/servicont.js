/**
 * Nueva seccion de estadisticas, tabla rasa Julio 2008, 
 * todas actuan en el div resultados, fichero estadisticas.php
 * @todo Cabezera fichero y descripciones de funciones y variables
 */
/**
 * Url de destino de las peticiones Ajax
 * @type {String}
 */
var url = "handler.php";
/**
 * Imagen de pregarga
 * @type {String}
 */
var cargando = "<center><img src='imagenes/loading.gif' alt='cargando' /></center>";
/**
 * Generacion de los pickup de seleccion de fecha
 * @return {[type]} [description]
 */
var camposFecha = function () {
    "use strict";
    var fieldId, buttonId, i;
    fieldId = ['fechaInicial', 'fechaFinal'];
    buttonId = ['botonFechaInicial', 'botonFechaFinal'];
    i = 0;
    for (i = 0; i < fieldId.length; i++) {
        Calendar.setup({
            inputField     :    fieldId[i],      // id of the input field
            ifFormat       :    '%d-%m-%Y',       // format of the input field
            showsTime      :    true,            // will display a time selector
            button         :    buttonId[i],   // trigger for the calendar (button ID)
            singleClick    :    false,           // double-click mode
            step           :    1                // show all years in drop-down boxes (instead of every other year as default)
        });
    }
};
/**
 * Funcion que lanza el gif de precarga
 * @param  {string} div capa donde se realizara la precarga
 * @return {[type]}     [description]
 */
var precargaDatos = function (div) {
    "use strict";
    $("#" + div).innerHTML = cargando;
};
/**
 * [cargaDatos description]
 * @param  {[type]}   data     [description]
 * @param  {[type]}   div      [description]
 * @param  {Function} callback [description]
 * @return {[type]}            [description]
 */
var cargaDatos = function (data, div, callback) {
    "use strict";
    $("#" + div).html = data.responseText;
    if (callback) {
        callback();
    }
};
/**
 * [peticionAjax description]
 * @param  {[type]}   pars        [description]
 * @param  {[type]}   divPrecarga [description]
 * @param  {[type]}   divCarga    [description]
 * @param  {Function} callback    [description]
 * @return {[type]}               [description]
 */
var peticionAjax = function (pars, divPrecarga, divCarga, callback) {
    "use strict";
    var myAjax = new Ajax.Request(
        url,
        {
            method : 'post',
            parameters : pars,
            onCreate : precargaDatos(divPrecarga),
            onComplete : function gen(respuesta) { 
                cargaDatos(respuesta, divCarga, callback);
            }
        }
    );
};
/**
* [menu description]
* 
* @param  {[type]} form [description]
* 
* @return {[type]}      [description]
*/
function menu(form) {
    "use strict";
	var pars = "opcion=0&form=" + form;
    peticionAjax(pars, 'formulario', 'formulario', false);
}
/**
* Funcion que recibe la peticion procesa y muestra la respuesta
* 
* @return {[type]} [description]
*/
function procesa() {
	"use strict";
	var pars = "opcion=1&" + Form.serialize($('consulta'));
    peticionAjax(pars, 'resultados', 'resultados', false);
}
/**
 * [comparativa description]
 * @return {[type]} [description]
 */
function comparativa() {
	"use strict"; 
	var pars = "opcion=2&tipo=" + $F('tipo_comparativa');
    peticionAjax(pars, 'comparativas', 'comparativas', 'camposFecha');
}
