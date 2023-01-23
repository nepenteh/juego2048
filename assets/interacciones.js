document.onkeyup = function(evt) {
    evt.preventDefault();
    switch(evt.code) {
        case "ArrowLeft":
            evt.preventDefault();
            window.location = window.location.origin + "/izquierda";
            break;
        case "ArrowUp":
            evt.preventDefault();
            window.location = window.location.origin + "/arriba";
            break;
        case "ArrowRight":
            evt.preventDefault();
            window.location = window.location.origin + "/derecha";
            break;
        case "ArrowDown":
            evt.preventDefault();
            window.location = window.location.origin + "/abajo";
    }                
};

document.getElementById("nuevo-juego").onclick = function(evt) {
    window.mostrarDialogo("Nuevo Juego","¿Empezar nuevo juego?","Aceptar",window.location.origin + "/nuevo");
}



