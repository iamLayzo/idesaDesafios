# API RESTful de Biblioteca

Este proyecto es una API RESTful desarrollada con Laravel para gestionar una biblioteca en línea. Permite la creación, lectura, actualización y eliminación (CRUD) de libros y autores, e incluye autenticación y manejo de excepciones.

---

## Requisitos

- **PHP**: 8.1.25
- **Framework**: Laravel v10.48.25
- **Base de datos**: MySQL
- **ORM**: Eloquent
- **Testing**: PHPUnit
---

## Endpoints

### Autenticación
- **POST** `/api/auth/login` - Iniciar sesión  
- **POST** `/api/auth/register` - Registrar un usuario  

### Autores
- **GET** `/api/authors` - Listar autores (con filtrado, ordenamiento y paginación)  
- **GET** `/api/authors/{id}` - Mostrar detalles de un autor  
- **POST** `/api/authors` - Crear un autor  
- **PUT** `/api/authors/{id}` - Actualizar un autor  
- **DELETE** `/api/authors/{id}` - Eliminar un autor  

### Libros
- **GET** `/api/books` - Listar libros (con filtrado, ordenamiento y paginación)  
- **GET** `/api/books/{id}` - Mostrar detalles de un libro  
- **POST** `/api/books` - Crear un libro  
- **PUT** `/api/books/{id}` - Actualizar un libro  
- **DELETE** `/api/books/{id}` - Eliminar un libro  

---

## Instalación y Configuración

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/iamLayzo/idesaDesafios
   cd idesaDesafios
   ```

2. Instalar dependencias:
   ```bash
   composer install
   ```

3. Configurar el entorno:
   Copiar el archivo `.env.example` y renombrarlo a `.env`. Modificar los valores según tu entorno, especialmente los datos de la base de datos.

4. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```

5. Iniciar el servidor:
   ```bash
   php artisan serve
   ```

---

## Uso de Factories

Para generar datos de prueba:

**Ejecución de seeders**:
   ```bash
   php artisan db:seed
   ```

---

## Filtrado, Ordenamiento y Paginación

- Los endpoints de autores y libros soportan filtros (`name`, `title`, `author_name`), ordenamiento (`sort_by`, `order`) y paginación (`per_page`).  
- Ejemplo de uso:  
  ```
  GET /api/authors?name=Roa&sort_by=name&order=asc&per_page=5
  ```
  ```
  GET /api/books?title=Prejudice&author_name=Austen&sort_by=published_date&order=desc&per_page=3&page=2
  ```

---

## Tests

El proyecto incluye pruebas unitarias y de características. Para ejecutar las pruebas:

```bash
php artisan test
```

---

## Dump de la Base de Datos

Incluye un archivo `dump.sql` con la estructura y datos iniciales de la base de datos. Para restaurar la base de datos:

```bash
mysql -u usuario -p library < dump.sql
```

---


