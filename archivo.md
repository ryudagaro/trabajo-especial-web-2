integrante 1: ryu dagaro dagaroryu@gmail.com
integrante 2: nicole rodriguez rodriguezmnicole@gmail.com 

tematica: catalogo digital de peliculas, genero y personal del mundo del cine 

descripcion: Es un sitio donde se centraliza la información de distintas películas. Cada película tiene su descripción técnica, el año de estreno y la categoría a la que pertenece (terror, comedia, etc.). Además, el sistema permite registrar a los participantes de cada obra, detallando sus datos personales y el rol que cumplieron, ya sea como parte del elenco o del equipo de producción.

entidades: pelicula, participantes


atrbutos: pelicula: id pelicula ,titulo, descripcion, categoria, año de publicacion
participantes: id participantes ,nombre, nacimiento, nacionalidad, rol, id pelicula(fk)

TPE parte 2 Nicole Rodriguez
Para probar la página localmente, hay que meter la carpeta del proyecto adentro de la carpeta htdocs de XAMPP. Después, hay que iniciar el Apache y el MySQL desde el panel de control y entrar a phpMyAdmin para crear una base de datos vacía que se llame db_peliculas. Ahí adentro hay que importar el archivo .sql que dejamos en el proyecto para que se carguen todas las tablas y las películas automáticas.
Con los servicios corriendo y la base de datos configurada, se puede acceder a la cartelera pública del sitio ingresando desde el navegador a la URL http://localhost/TPE_PARTE2_php/index.php. El acceso general para el público funciona por defecto en modo de "solo lectura", permitiendo ver las películas disponibles, sus detalles y las categorías. Para poder probar y utilizar las funciones restringidas del panel de administración, como agregar, editar o eliminar tanto películas como categorías, se debe iniciar sesión en el sitio utilizando el usuario webadmin con la contraseña admin.




 






