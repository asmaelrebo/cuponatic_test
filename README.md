# Servicio de búsqueda y estadísticas para cuponatic
Servicio de búsqueda solicitado por cuponatic, el backend fue desarrollado con Lumen de Laravel, la BD con MySQL, el front con Bootstrap y javascript (jQuery)
## Instalación
Se puede instalar con docker o directamente desde php
### Docker compose
Debe estar instalado docker, si no lo está seguir instrucciones desde  https://docs.docker.com/install/
Conexión a la base de datos se debe realizar en el archivo .env ubicado en la raiz del proyecto.
Ejecutar el siguiente comando en la raiz del proyecto
```
docker-compose up
```
### PHP
Instalar Lumen según las instrucciones del sitio oficial: https://lumen.laravel.com/docs/5.6
Conexión a la base de datos se debe realizar en el archivo .env ubicado en la raiz del proyecto.
Ejecutar el siguiente comando en la raiz del proyecto
```
php -S localhost:8080 -t public
```

## Importación de datos
***Ignorar este paso si se configuró con Docker***
Para importar los registros es necesario cargar la estructura de la base de datos ubicada en load_data/structure.sql
La importación de los registros se realiza en base al archivo load_data/datos_descuentos_buscador_prueba.2.0.csv con la siguiente query:
```
use cuponatic_test;
load data local infile 'load_data/datos_descuentos_buscador_prueba.2.0.csv' into table products 
CHARACTER SET utf8
fields terminated by ',' 
enclosed by '\"' 
lines terminated by '\r\n' 
IGNORE 1 LINES
(title, description, start_date, end_date, price, image, sold, tags) SET id = NULL;
```

##Funciones
### Buscador (http://server:8080/)
Servicio recibe un request POST con el parámetro "keyword" el cual contiene el texto a buscar y debe devolver la información de los productos, la información retornada es un json.
Al realizar una búsqueda se actualiza el campo count_total al producto y se asocia la palabra buscada en la tabla search_statistics

###Estadistícas (http://server:8080/productos/estadisticas)
Crear una página (PHP o HTML+JS, usted decide) que muestre los 20 productos más
buscados y por cada producto las 5 palabras más usadas que hicieron aparecer dicho producto.