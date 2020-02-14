
<h3>Puntos a tener en cuenta al desarrollar</h3>

* Organización
* Seguridad
* Limpieza
* Desacoplamiento de funcionalidades
* MVC -> usarlo de al mejor manera posible
* indentado correcto de código
* reutilización de código correcto para los templates para permitir reutilización si aplica
* asegurar nombres de cosas en inglés para la programación, incluyendo revisar palabras mal escritar para evitar confuciones del desarrollador; una palabra mal escrita se tendrá que corregir aunque se tenga que cambiar toda la BD
* mantener el estandar de nombres de funciones o acoplarnos a uno específico
* visualización y organización de formularios e información lo más presentable posible de acuerdo a los assets que tenemos disponibles (el template comprado)
* finalizar cualquier detalle por más pequeño que sea: margenes disparejo, tamaños de fuentes disparejas, desacomodo de elementos
* asegurar lo mejor posible la presentación responsive de algunas secciones de acuerdo a las posibilidades que ofrece el tema
* no postergar tareas obligatorias; analizar la importancia para saber si vale esperar
* extremo cuidado en la lógica y restricciones propias de las necesidades del sistema
* ponerse en los zapatos del sistema y del cliente; preguntarse a uno mismo "¿esta es la mejor manera de resolver tal cosa?"
* tendrémos fechas y presentación de avances, es por eso que la organización de tareas es muy importante
* tendrémos control de tareas con jira, así alistaremos tareas globales de todo el sistema e iremos desglozando poco a poco
* al terminar un bloque de trabajo o tarea, muy importante asegurar que funcione bien realizando pruebas diversas
* se requerirán validaciones de modelos/formularios de acuerdo a la lógica y requisitos del sistema/cliente


- - - - - - - - - - - - - - - - - - - - -

<br><br>


<h3>Requerido: </h3>

-- php 7.2 o superior para instalación de archivo de composer. ** Es muy probable que se necesite cambiar la ruta del php que se ejecuta en la terminal/cmd desde ahí mismo.

<h5>Cambio en MAC</h5>
-- "which php" para saber la versión de php de la terminal <br>
-- "sudo nano ~/.bash_profile" <br>
-- Dentro del archivo: <br> PATH=/Applications/MAMP/Library/bin:/Applications/MAMP/bin/php/php7.1.12/bin:$PATH <br>
-- reiniciar terminal
-------

<h3>Framework</h3>
Laravel 6 .9| <a href="https://laravel.com/docs/6.x">https://laravel.com/docs/6.x</a>

-------

<h3>Instalación de paqueterías de composer de Laravel</h3>
composer install ó composer install -n<br><br>
** podría ser necesario que eliminen el archivo composer.lock para la instalación de librerías. Inicialmente intentar bajar nuevas librerías con el comando de arriba y probar. <br>
** las librerías están ignoradas con .gitignore

-------

<h3>Instalación de paqueterías de *node* para SASS y compilación automática de archivos</h3>

npm install <br><br>
** tal vez se necesite permisos de instalación de acuerdo al equipo <br>
** podría ser necesario que eliminen el archivo package-lock.json para la instalación de librerías <br>
** las librerías de node están ignoradas con .gitignore

-------

<h3>Base de datos</h3>
nombre: <b>local-pm-app</b> <br>
codificación: utf8 <br>
intercalación: utf8_general_ci <br><br>
** Cambiar configuraciones de bases de datos en el archivo .env de acuerdo a su sistema. <br>
** Una copia de mi archivo .env de inicio estará en la carpeta de <b>_documentos</b>

-------

<h3>Inicio de servidor de laravel</h3>

php artisan serve

<b>** nota</b>: en caso que cambien variables de entorno del archivo .ENV recomiendo que reinicien el servidor

-------

<h3>Migraciones y Seeders iniciales<h3>

php artisan migrate <br>
php artisan db:seed

-------

<h3>Limpieza de cache de Laravel</h3>

php artisan cache:clear <br>
php artisan route:cache   <br>
php artisan config:cache   <br>
php artisan view:clear <br>

** <b>nota:</b> se utilizan cuando se actualizan versiones en vivo o cuando las migraciones no están corriendo correctamente por cache del archivo de migración

_______

<h3>SASS y Compilación de Assets</h3>

-- npm run watch (observa cambios de archivos); necesario cuando se editan archivos del tema o css y/o javascript en carpeta de <b>resources</b><br>
-- npm run dev (mismo de arriba pero sin minificar archivos para visualizar posibles errores)<br>
-- npm run prod  (se usa para empaquetar y minificar los css)

-- La compilación se realiza utilizando los archivos: <br>

* resources/gull (archivo de tema)
* resources/gull/js (archivo de tema)
* resources/gull/styles (archivo de tema)
* resources/js/app.js (scripts) de app)
* resources/sass/app.scss (css de app)


-- Los scripts se compilan y se insertan automáticamente en la carpeta public
_______

<h3>Tema del proyecto</h3>

https://themeforest.net/item/gull-bootstrap-laravel-admin-dashboard-template/23101970 <br>

_______

<h3>Jira</h3>

-- Jira: https://ignis.atlassian.net/secure/BrowseProjects.jspa <br>
-- Bitbucket: https://bitbucket.org/blakmetall/pmv-palmera-vacations <br>
