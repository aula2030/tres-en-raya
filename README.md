# Tres en Raya

## Reglas básicas del enunciado

- El tablero de juego debe ser un grid de 3x3.
- Dos jugadores, uno representado por la marca O y el otro por X.
- El primer jugador en alcanzar 3 marcas seguidas ya sea en horizontal, en vertical o en diagonal
gana.
- Los jugadores juegan en el mismo ordenador, en turnos alternos.

## Consideraciones de desarrollo

- El desarrollo se realiza con la última versión de Laravel. En el momento del desarrollo es la 8.42.1.
- La aplicación necesita una base de datos MySQL para guardar el desarrollo de las partidas.

## Instalación

- Clonar el repositorio.
- Instalar los paquetes PHP con `composer install`.
- Modificar el fichero de configuración `.env` con la url correspondiente (APP_URL) y los datos de acceso a la BD. 
- Ejecutar las migraciones de la base de datos con `php artisan migrate`.
- Instalar y compilar los assets con `npm install && npm run dev`.
