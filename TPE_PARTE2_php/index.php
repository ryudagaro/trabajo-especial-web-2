<?php
require_once 'Sección Categorías/categoriacontroller.php';
require_once 'Sección Películas/PeliculaController.php'; 
require_once 'Sección Login/auth.controllers.php'; 
// 1. Definimos una acción por defecto si el usuario no pide nada en la URL
$action = 'peliculas'; 

// 2. Verificamos si el usuario envió una acción específica por la URL
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// 3. Tabla de ruteo: parseamos la acción para saber qué Controlador llamar
switch ($action) {
    case 'categorias':
        $controller = new CategoriaController();
        $controller->showCategorias();
        break;

    case 'nueva-categoria':
        $controller = new CategoriaController();
        $controller->createCategoria();
        break;

    case 'eliminar-categoria':
        $controller = new CategoriaController();
        $controller->removeCategoria();
        break;
        
    case 'peliculas':
        $controller = new PeliculaController();
        $controller->showPeliculas();
        break;

    case 'nueva-pelicula':
        $controller = new PeliculaController();
        $controller->createPelicula();
        break;

    case 'eliminar-pelicula':
        $controller = new PeliculaController();
        $controller->removePelicula();
        break;

    case 'editar-pelicula':
        // Instanciamos el controlador si no está hecho arriba y llamamos a la función
        $controller = new PeliculaController();
        $controller->showEditarPelicula();
        break;

    case 'actualizar-pelicula':
        $controller = new PeliculaController();
        $controller->updatePelicula();
        break;

    case 'editar-categoria':
        $controller = new CategoriaController();
        $controller->showEditarCategoria();
        break;

    case 'actualizar-categoria':
        $controller = new CategoriaController();
        $controller->updateCategoria();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'login':
        $controller = new AuthController();
        $controller->mostrarLogin(); // Este método muestra la pantalla con el formulario
        break;

    case 'verify':
        $controller = new AuthController();
        $controller->login(); // Este método procesa cuando le das al botón "Ingresar"
        break;
    
    default:
        $controller = new PeliculaController();
        $controller->showPeliculas();
        break;

    
}
?>