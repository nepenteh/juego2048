document.onkeyup = function(evt) {
    evt.preventDefault();
    switch(evt.code) {
        case "ArrowLeft":
            evt.preventDefault();
            window.location = window.location.origin + "/i";
            break;
        case "ArrowUp":
            evt.preventDefault();
            window.location = window.location.origin + "/a";
            break;
        case "ArrowRight":
            evt.preventDefault();
            window.location = window.location.origin + "/d";
            break;
        case "ArrowDown":
            evt.preventDefault();
            window.location = window.location.origin + "/b";
    }                
};

document.getElementById("nuevo-juego").onclick = function(evt) {
    window.mostrarDialogo("Nuevo Juego","¿Empezar nuevo juego?","Aceptar",window.location.origin + "/nuevo");
}



