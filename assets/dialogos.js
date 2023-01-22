/**
 * Diálogo bootstrap modal, mostrarDialogo
 * (puede usarse como diálogo de confirmación o diálogo de mensaje)
 * 
 * textotitulo - texto de la barra de título
 * textomensaje - mensaje a mostrar (o pregunta)
 * textobotonaccion - texto del botón aceptar (si null no se muestra)
 * urldestino - url asociada al boton de acción (ejecutará la acción)
 * textobotoncancelar - texto del botón cancelar, si null se muestra el texto Cerrar
 */

mostrarDialogo = function(textotitulo,
							   textomensaje,
							   textobotonaccion = null,
							   urldestino = null,
							   textobotoncancelar = null) {

	var myModal = new bootstrap.Modal(document.getElementById('modalDialogo'));
	var titulo = document.getElementById('modalDialogoTitulo');
	titulo.innerHTML = textotitulo;
	var texto = document.getElementById('modalDialogoCuerpo');
	texto.innerHTML = textomensaje;
	var botonAccion = document.getElementById('modalBotonAccion');
	if(textobotonaccion) {
		botonAccion.innerHTML = textobotonaccion;
		botonAccion.href=urldestino;
	} else {
		botonAccion.style.display = "none";
	}
	if(textobotoncancelar) {
		var botonCancelar = document.getElementById('modalBotonCancelar');
		botonCancelar.innerHTML = textobotoncancelar;
	}
	myModal.show();
}