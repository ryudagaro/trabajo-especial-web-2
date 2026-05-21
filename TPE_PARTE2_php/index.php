<?php
require_once 'Sección Categorías/categoriacontroller.php';
require_once 'Sección Películas/PeliculaController.php'; 
require_once 'Sección Login/auth.controllers.php'; 

$action = 'peliculas'; 


if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}


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
        $controller->mostrarLogin(); 
        break;

    case 'verify':
        $controller = new AuthController();
        $controller->login(); 
        break;
    
    default:
        $controller = new PeliculaController();
        $controller->showPeliculas();
        break;

    
}
?>