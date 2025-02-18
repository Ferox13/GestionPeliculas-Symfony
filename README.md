# Aplicación CRUD con Symfony, Doctrine y Security

## Autor
 Fernando Rodríguez Rodríguez

## Credenciales y rutas
### Login
- email: test@email.com
- contraseña: 123456

### Rutas
- /login
- /logout
- /register
- /crear/pelicula
- /editar/pelicula/{id}
- /eliminar/pelicula/{id}


## Descripción
Este proyecto consiste en el desarrollo de una aplicación CRUD utilizando el framework Symfony. La aplicación permite realizar operaciones de creación, lectura, actualización y eliminación sobre una entidad, seleccionada previamente de una lista de temas consensuados con el docente y el resto de los alumnos.

## Requisitos
### Selección del tema
- Cada alumno debe elegir 3 temas ordenados por preferencia y enviarlos al docente por correo.
- El docente asignará los temas según el orden de recepción y publicará la asignación en la aula virtual.
- No se permite repetir temas entre alumnos.

### Tema seleccionado
- Gestor de peliculas

### Funcionalidades mínimas
La aplicación debe contar con las siguientes rutas y vistas:
1. **Ruta raíz**: 
   - Muestra un listado de las entidades.
   - Incluye funcionalidad de filtrado/búsqueda por al menos un campo.
2. **Ruta detalle de la entidad**: 
   - Muestra los detalles de una instancia concreta.
3. **Ruta de creación de instancia**: 
   - Muestra un formulario para crear una nueva instancia de la entidad.
   - Permite guardar la instancia en la base de datos.
4. **Ruta de edición**: 
   - Muestra un formulario para editar una instancia existente.
   - Carga los datos actuales de la instancia para modificarlos.

### Requisitos técnicos
- **Interfaz de usuario**: 
  - Usar Bootstrap para el diseño y estilo.
  - Utilizar plantillas Twig con herencia de plantillas para las partes comunes.
- **Base de datos**: 
  - Usar SQLite como sistema de base de datos.
  - Utilizar el ORM Doctrine para la gestión de entidades.
  - Asegurarse de realizar correctamente las migraciones.
- **Notificaciones al usuario**: 
  - Mostrar mensajes de éxito o error al realizar operaciones de crear, editar o borrar.
  - Redirigir al usuario a una vista específica tras realizar dichas operaciones.

### Parte opcional (puntuación extra)
- Implementar un sistema de autenticación:
  - Requerir inicio de sesión para acceder a cualquier vista que modifique datos.
  - Añadir las vistas y rutas necesarias para el sistema de login.

## Diseño
El diseño de las vistas es libre, siempre y cuando cumpla con los requisitos mencionados. En caso de duda, se puede consultar con el docente.

## Herramientas y tecnologías
- **Framework**: Symfony
- **Frontend**: Bootstrap, Twig
- **Backend**: Doctrine ORM, SQLite
- **Gestión de dependencias**: Composer