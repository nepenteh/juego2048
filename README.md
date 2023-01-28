# JUEGO 2048
## Ejercicio PHP - Symfony

### Programación del Juego 2048 usando PHP y Symfony

El Juego 2048 consiste en un tablero de 4x4 celdas en las que inicialmente se colocan dos fichas con el número 2.

El jugador puede mover en las cuatro direcciones (arriba, abajo, izquierda, derecha) haciendo que todas las fichas se desplacen hacia dicha dirección.

Cuando dos fichas con el mismo valor chocan, el resultado es que se unen en una nueva ficha con el doble del valor.

El objetivo del juego es ir uniendo fichas hasta conseguir una con el valor 2048.

Si el tablero queda completamente relleno sin posibilidad de mover para hacer nuevos huecos, el juego finaliza y el jugador pierde.


![Juego 2048](https://ejerciciosmesa.com/images/juego-2048/juego_2048.png)

Se puede ver este ejemplo en funcionamiento en la dirección:

[juego2048.ejerciciosmesa.com](https://juego2048.ejerciciosmesa.com/)


# Estructura básica del código

## Controlador y Tablero

El código fuente consiste en dos clases:

### Clase Tablero. 

Esta clase define el objeto tablero, con las distintas características del juego: movimiento de piezas, unión de piezas, detectar cuando el juego termina, cuando gana el jugador, etc. Se puede decir que esta clase define las reglas básicas del juego.

El objeto tablero será almacenado en la sesión actual para que pueda ser mantenido su estado de una petición a otra. Por este motivo, es necesario dotar a este objeto de la posibilidad de ser serializado.

### Controlador Principal.

Es el único controlador de la aplicación. Se encarga de recibir las distintas peticiones del jugador y actuar en consecuencia. Estas peticiones son:

* Nuevo Juego. Se crea un objeto tablero y se almacena en la sesión actual. A continuación se envía a la vista para que se muestre en pantalla.

* Arriba, Abajo, Izquierda, Derecha. Con cada una de estas peticiones se recoge el objeto tablero de la sesión actual, se le pide que mueva sus fichas y a continuación se envía a la vista para mostrar su nuevo estado.

* Acceso a la aplicación. La acción asociada al index de la aplicación comprueba si hubiera un objeto tablero asociado a la sesión. Si es así lo extrae de ella, si no, crea uno nuevo.

## Plantillas Twig

En la plantilla base de la aplicación se crea el menú y se incrustan los CSS y archivos Javascript, activados a través de webpack encore.

El archivo index asociado al controlador principal contiene la presentación del tablero, que básicamente es una tabla construida con ayuda de Bootstrap.

## Javascript

La interacción con el juego se programa en dos archivos Javascript controlados por el archivo javascript principal de la aplicación app.js. Estos dos archivos son:

interacciones.js  - Se encarga de detectar las pulsaciones de teclas.
toques.js  - Se encarga de detectar los toques sobre la pantalla en dispositivos móviles.

La activación de movimiento a través de los iconos de cursor de la pantalla de juego se consigue en la plantilla base, a través de simples enlaces.

# Más juegos y ejemplos de programación en:

[ejerciciosmesa.com](https://ejerciciosmesa.com/)

Otros juegos del autor en:

[mesagames.es](https://mesagames.es/)

