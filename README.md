### Requerimientos

Para la correcta conexión con base de datos se necesita activar la extensión **_pdo_mysql_** en el archivo **php.ini**.

Se necesita el uso de **composer** para instalar los paquetes necesarios y generar los archivos de carga.

```jsx
> composer install
```

### Base de datos

El script de creación de base de datos se encuentra en la carpeta **_/db_** del repositorio.

### Ejecución

Desde la raíz del repositorio, ejecutar el servidor web interno de php.

```jsx
> php -S localhost:3030 -t /public
```

Es importante hacer uso del puerto **3030** ya que será el mismo al cual apunte la aplicación front-end.
