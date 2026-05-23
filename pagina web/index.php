<?php
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
require_once __DIR__ . '/controllers/peliculas.controllers.php';
require_once __DIR__ . '/controllers/auth.controllers.php';


$action = 'home';


if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $peliculasController = new PeliculasController();
        $peliculasController->home();
        break;

    case 'peliculas':
        $id = $params[1] ?? null;
        $peliculasController = new PeliculasController();
        $peliculasController->mostrarPeliculas($id);
        break;

    case 'login':
        $authController = new AuthController();
        $authController->mostrarLogin(); 
        break;

    case 'verify':
        $authController = new AuthController();
        $authController->login();
        break;

    case 'admin':
        $id = $params[1] ?? null;
        $peliculasController = new PeliculasController();
        $peliculasController->mostrarAdmin($id); 
        break;

    case 'guardar':
        $peliculasController = new PeliculasController();
        $peliculasController->guardarPelicula();
        break;

    case 'borrar':
        $id = $params[1] ?? null;
        $peliculasController = new PeliculasController();
        $peliculasController->borrarPelicula($id);
        break;

    default:
        echo '404 error - Página no encontrada';
        break;
}



