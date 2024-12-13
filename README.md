# Menú dinámico

Este proyecto consta de una pequeña aplicación que realiza un menú dinámico con Programación Orientada a Objetos 🧩.

Este proyecto está orientado un poco, en la estructura de carpetas de varios framework que a lo largo de mi carrera he probado, como son: Codeigniter, Laravel y Lummen.

Para la realización de este proyecto no se utilizó ningún tipo de prepocesador, librería, framework php, css o html.

> Esta aplicación puede ser probada utilizando los contenedores de Docker, más abajo las instrucciones.

> Esta aplicación tiene mucho margen de mejora, por el tiempo otorgado y por el tiempo disponible, se ha realizado lo posible.

## Despliegue 🚀

Para poner en funcionamiento esta aplicación necesitamos tener los siguientes reqerimientos cubiertos:

### Requerimientos 📋
- PHP 8.2
- Apache
- Mysql (PDO)


### Primer paso 🐾

Primero que nada debemos descargar nuestro proyecto y colocarlo dentro de una carpeta de nuestro servidor Apache que sea accesible desde el navegador.

### Seundo paso 🐾🐾

Para iniciar con el despliegue de la apliación para poder probarla, es necario crar la **Base de datos**.

Usted puede encontrar el script para crear la base de datos en la carpeta **db** del proyecto con el nombre **schema.sql**

### Tercer paso 🐾🐾🐾

Una ves creada la base de datos procedemos a configurar las variables de conexión de nuestra base de datos, las cuales las encontrará en ./config/constant.php, colocando las credenciales de su BD.

Ejemplo de configuración:

```php
define('DB_CONFIG', [
    'HOST' => 'db',
    'USER' => 'miuser',
    'PASS' => 'mipass',
    'DBNAME' => 'menus',
    'PORT' => '3306',
    'CHARSET' => 'utf8mb4'
]);
```

### Cuarto paso 🏅

¡Listo! ✨🎉, ahora solo te queda probar el desarrollo realzado.

## Despliegue usando DOCKER 🐳

Para ejecutar nuestra aplicación debemos tener instalado **docker composer**, ya que será la herramienta que utilizaremos para levantar todas las dependencias del proyecto.

Para Ejecutar el proyectro solo es necesario ejecutar los siguientes comandos:

```bash
cd carpeta-del-proyecto
docker compose up --build -d
```

¡Listo!🎉✨, ahora podemos probar nuestra aplicación atra vez del puerto **8080** de nuestro equipo.
