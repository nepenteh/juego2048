/**
 * Programación de eventos de toque para el móvil
 * (Desplazamientos a distintas direcciones)
 */

var touchStartX = 0;
var touchStartY = 0;
var touchEndX = 0;
var touchEndY = 0;


        
document.getElementById('tablero').addEventListener('touchstart', function(event) {
    var touches = event.changedTouches;
    touchStartX = touches[0].screenX;
    touchStartY = touches[0].screenY;
},false);

document.getElementById('tablero').addEventListener('touchend', function(event) {
    var touches = event.changedTouches;
    touchEndX = touches[0].screenX;
    touchEndY = touches[0].screenY;
    Mover();
},false);

function Mover() {

    var horizontal = Math.abs(touchEndX-touchStartX);
    var vertical = Math.abs(touchEndY-touchStartY);

    if(horizontal>vertical) {
        if (touchEndX < touchStartX) {  //izquierda
            window.location = window.location.origin + "/izquierda";
        } 
        if (touchEndX > touchStartX) { //derecha
            window.location = window.location.origin + "/derecha";
        }
    } else {
        if (touchEndY < touchStartY) {  //arriba
            window.location = window.location.origin + "/arriba";
        } 
        if (touchEndY > touchStartY) { //abajo
            window.location = window.location.origin + "/abajo";
        }
    } 
}



