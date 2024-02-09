# Notes-App Aplicación de Notas
Aplicación hecha con PHP MVC Framework y JS+CSS en el FrontEnd.

## Objetivo
Esta sencilla aplicación hace que mediante login/register puedas crear simples Notas de tareas o obligaciones que tengas que hacer para no olvidarte.

## Funcionamiento
En la aplicación se puede hacer lo siguiente:

### Crear una cuenta o loguearse
En `/login` y `/register` puedes crearte una cuenta o loguearte si ya dispones de una, dentro del login se tiene una opción de **recordarme**, donde a través de un **token** se guarda
la sesión del usuario sin necesidad de volverse a loguear hasta que el propio usuario decida **cerrar sesión**.

### Creación de Notas
Teniendo una vez creada tu cuenta, accediendo a `/misNotas` puedes crear, borrar y filtrar tus notas.

### Manipular Notas
En la sección de **filtros** dentro de `/misNotas` puedes filtrar por:
<ul>
 <li>Estado de la Nota</li>
 <li>Nombre del título</li>
 <li>Por Notas importantes</li>
</ul>
También puedes modificar su cotenido o borrarlas si no las consideras necesarias o has terminado lo que tenías apuntado en ellas.

## Requisitos
Solo precisas tener **Docker** o **Docker Desktop** instalado para correr o probar esta aplicación.

## Como usarla
Clona el repositorio en tu carpeta de preferencia y dentro de la carpeta raíz del proyecto ejecuta el siguiente comando:
```
docker compose up -d
```
Si la app te da error de que no tiene composer instalado, ejecuta el siguiente comando a continuación dentro de la carpeta raíz:
```
docker compose exec app composer install
```

Docker te construirá una imagen con un sencillo servicio PHP-Apache y un MYSQL con la Base de Datos para poder usarla.


### Servidor MYSQL
También puedes probar y usar una imagen de Docker que he subido que debería contener un servidor mysql junto con la Base de Datos necesaria, la puedes encontrar
en Docker escribiendo `juanignaso/notesapp-mysql-server` en el buscador de imágenes.

## Recursos Usados
 [JQuery](https://releases.jquery.com/)

 [Mi Framework PHP](https://github.com/JuanIgnaso/php-mvc-framework)

