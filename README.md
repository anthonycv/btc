## Installation
- Instalar el framework y dependencias `composer install`
- Generar el key de artisan `php artisan key:generate`
- Crear el archivo .env en la raiz usando el .env.example como ejemplo
- Configurar el virtual host a usar
- Correr las migraciones `php artisan migrate`
## btc
- La página principal (/) es un html simple en bootstrap, que mediante javascript (jQuery) obtenga cada 10 segundos el precio actual del Bitcoin en USD, el procetaje de diferencia entre otros datos del API de blockchain y lo actualiza en tiempo real sin necesidad de recargar la página.
- En cada consulta a esta API, se guarda en una base de datos (PostgreSQL) el precio registrado para ir llevando un historial. Las migraciones y modelos necesarios se encuentran en el proyecto.

