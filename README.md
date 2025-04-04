# Prueba tecnica

Este proyecto es una aplicación web desarrollada con PHP (sin frameworks), Vue.js y MySQL para la gestión de ofertas. Permite la creación, consulta y exportación de ofertas en formato Excel.

##  Requisitos para ejecutar el proyecto

Antes de ejecutar la aplicación, asegúrate de contar con los siguientes requisitos:

- **PHP** versión 7 o superior.
- **Base de datos** MySQL.
- **Servidor Web** (Apache recomendado, puede usarse XAMPP o Laragon).
- **Extensión PDO de PHP** habilitada para la conexión con la base de datos.
- **Composer** (para gestionar dependencias de PHP).
- **Git** (opcional, para clonar el repositorio).

## Instalación y Configuración

Sigue estos pasos para instalar y ejecutar el proyecto:

### 1️ Clonar el repositorio
Abre la terminal y ejecuta:
```bash
git clone <URL_DEL_REPOSITORIO>
cd <NOMBRE_DEL_PROYECTO>
```

### 2️ Configurar la base de datos
- Importa el archivo SQL que se encuentra en la carpeta `bd/` dentro del proyecto:
  - Puedes usar phpMyAdmin o ejecutar en la terminal:
    ```bash
    mysql -u usuario -p base_de_datos < bd/estructura.sql
    ```

- Modifica el archivo `database.php` con los datos de tu conexión a la base de datos:
  ```php
  $host = "localhost";
  $dbname = "nombre_de_tu_bd";
  $username = "usuario";
  $password = "contraseña";
  ```

### 3️ Instalar dependencias
Ejecuta:
```bash
composer install
```

### 4️ Configurar el servidor
Si usas XAMPP o Laragon, coloca el proyecto dentro de la carpeta `htdocs` o `www`.

Si tienes PHP instalado, puedes iniciar un servidor desde la terminal:
```bash
php -S localhost:8000
```
Luego, abre [http://localhost:8000](http://localhost:8000) en tu navegador.

### 5 Ejecutar la aplicación
Abre el navegador y accede a:
```
http://localhost/NOMBRE_DEL_PROYECTO/index.html
```
Ahí podrás ver, crear y descargar ofertas.

##  Buenas prácticas implementadas
- Código estructurado siguiendo convenciones de PHP y JavaScript.
- Uso de **Vue.js** en el frontend para una experiencia más dinámica.
- Documentación del código y estructura clara en el repositorio.

---


