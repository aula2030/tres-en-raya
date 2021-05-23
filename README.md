# Tres en Raya

## Reglas básicas del enunciado

- El tablero de juego debe ser un grid de 3x3.
- Dos jugadores, uno representado por la marca O y el otro por X.
- El primer jugador en alcanzar 3 marcas seguidas ya sea en horizontal, en vertical o en diagonal
gana.
- Los jugadores juegan en el mismo ordenador, en turnos alternos. Las partidas siempre las empieza el jugador O.

## Consideraciones de desarrollo

- El desarrollo se realiza con la última versión de Laravel (8.42.1). Los requisitos mínimos para el sistema se detallan aquí: https://laravel.com/docs/8.x/deployment.
- La aplicación necesita una base de datos MySQL (o Maria DB) para guardar el desarrollo de las partidas.
- Como framework CSS se utiliza Tailwind (información sobre su instalación aquí: https://tailwindcss.com/docs/guides/laravel).

## Instalación del juego

- Clonar el repositorio.
- Instalar los paquetes PHP con `composer install`.
- Modificar el fichero de configuración `.env` con la url correspondiente (APP_URL) y los datos de acceso a la BD. 
- Ejecutar las migraciones de la base de datos con `php artisan migrate`.
- Instalar y compilar los assets con `npm install && npm run dev`.

## Consideraciones de diseño

### Sobre el juego

- Inicialmente, se muestra un botón para iniciar partida.
- Comienza siempre el jugador O.
- Al pulsar en una casilla vacía, ésta se le asigna al jugador del turno actual.
- Se comprueba en el servidor que cada movimiento sea válido teniendo en cuenta el estado del tablero, y si una vez realizado el movimiento hay un ganador.
- Cuando una partida termina se muestra el ganador y se vuelve al estado inicial.

Además:

- Para permitir partidas simultáneas de manera sencilla, sin necesidad de utilizar usuarios registrados, se guarda el identificador de partida en la sesión con las utilidades de Laravel.
- Si una sesión termina inesperadamente por razón indeterminada, se debe iniciar una partida nueva.
- No se ha considerado necesario realizar una gestión de sesiones (o partidas) perdidas.

### Vistas (Blade)

- No se considera necesario dividir las plantillas en componentes. Como ejemplo sirve la separación del tablero como "contenido" de la plantilla principal `layouts.app`.

### Base de datos

No se considera necesario almacenar datos complementarios de la partida más allá de la posición de las fichas en un momento dado. Por tanto, es suficiente una única tabla de partidas que contiene: 
- Las posiciones de las fichas de cada jugador. Como las fichas colocodas se añaden en orden, se puede establecer a quién corresponde el siguiente turno y cómo se desarrolló la partida.
- Fecha de finalización de la partida.
- Ganador de la partida (o tablas).

### Javascript

- No se ha añadido controles adicionales en el front end. Por ejemplo, para evitar múltiples envíos al hacer click repetidamente en una celda vacía. Como el servidor controla que el movimiento sea correcto solo se procesarán aquellos movimientos que respondan al desarrollo de la partida.
- Como no es posible realizar movimientos o acciones erróneas desde el frontend (que no sean resultado de un uso fraudulento) no se considera necesario informar al usuario de errores tipo "Movimiento incorrecto", etc...

