# Tres en Raya

## Reglas básicas del enunciado

- El tablero de juego debe ser un grid de 3x3.
- Dos jugadores, uno representado por la marca O y el otro por X.
- El primer jugador en alcanzar 3 marcas seguidas ya sea en horizontal, en vertical o en diagonal
gana.
- Los jugadores juegan en el mismo ordenador, en turnos alternos. Las partidas siempre las empieza el jugador O.

## Consideraciones de desarrollo

- El desarrollo se realiza con la última versión de Laravel disponible (8.42.1).
- La aplicación necesita una base de datos MySQL (o Maria DB) para guardar el desarrollo de las partidas.
- Como framework CSS se utiliza Tailwind (información sobre su instalación aquí: https://tailwindcss.com/docs/guides/laravel).

## Instalación del juego

- Los requisitos mínimos para ejecutar Laravel se detallan aquí: https://laravel.com/docs/8.x/deployment.
- El servidor debe tener además instalado composer y npm.
- Se presupone conocimientos básicos del funcionamiento de Laravel, composer y npm.

Para realizar la instalación seguir los siguientes pasos:

1. Clonar el repositorio y situarse en el directorio raíz del proyecto.
2. Instalar los paquetes PHP ejecutando `composer install`.
3. Modificar el fichero de configuración `.env` con la url correspondiente (APP_URL) y los datos de acceso a la BD. 
4. Ejecutar las migraciones de la base de datos con `php artisan migrate`.
5. Instalar y compilar los assets con `npm install && npm run dev` (`npm run prod` para generar versión optimizadas de js y css).

## Consideraciones de diseño

### 1. Sobre el funcionamiento del juego

- Inicialmente, se muestra un botón para iniciar partida.
- Comienza siempre el jugador O.
- Al pulsar en una casilla vacía, ésta se le asigna al jugador del turno actual.
- Se comprueba en el servidor que cada movimiento sea válido teniendo en cuenta el estado del tablero y si una vez realizado el movimiento hay un ganador.
- Cuando una partida termina se muestra el ganador y un botón para empezar otra partida.

Además:

- Para permitir partidas simultáneas de manera sencilla, sin necesidad de utilizar usuarios registrados, se guarda el identificador de partida en la sesión PHP con las utilidades de Laravel.
- Si una sesión termina inesperadamente por razón indeterminada, se debe iniciar una partida nueva. No se ha considerado necesario realizar una gestión de sesiones (o partidas) incompletas.

### 2. Vistas (Blade)

- No se considera necesario dividir las plantillas en componentes. Como ejemplo sirve la separación del tablero como "contenido" de la plantilla principal `layouts.app`.

### 3. Base de datos

#### a) Esquema de base de datos

No se considera necesario almacenar datos complementarios de la partida más allá de la posición de las fichas en un momento dado. Por tanto, es suficiente una única tabla de partidas que contiene: 
- Las posiciones de las fichas de cada jugador. Como las fichas colocadas se añaden en orden, se puede establecer a quién corresponde el siguiente turno y cómo se desarrolló la partida.
- Fecha de finalización de la partida.
- Ganador de la partida (o tablas).

#### b) Repositorios Laravel

No se considera necesario incluir una capa intermedia para aislar la implementación de las operaciones con los modelos (patrón de repositorios).

### 4. Javascript

- No se ha añadido controles adicionales en el front end. Por ejemplo, para evitar múltiples envíos al hacer click repetidamente en una celda vacía. Como el servidor controla que el movimiento sea correcto solo se procesarán aquellos movimientos que respondan al desarrollo de la partida.
- Como no es posible realizar movimientos o acciones erróneas desde el frontend (que no sean resultado de un uso fraudulento) no se considera necesario informar al usuario de errores tipo "Movimiento incorrecto", etc...

### 5. Gestión de errores

No se ha incluido una gestión adicional de errores. Cualquier error inesperado recibe la respuesta por defecto de Laravel.
