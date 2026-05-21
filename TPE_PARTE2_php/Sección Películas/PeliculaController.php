<?php
// Buscamos el modelo que está en la misma carpeta usando __DIR__
require_once __DIR__ . '/PeliculaModel.php';
// Salimos de "Sección Películas" y entramos a "Sección Categorías" de forma absoluta
require_once __DIR__ . '/../Sección Categorías/categoriamodel.php';

class PeliculaController {
    private $model;
    private $categoriaModel; //  Nueva variable para el segundo modelo

    public function __construct() {
        $this->model = new PeliculaModel();
        $this->categoriaModel = new CategoriaModel(); // Lo inicializamos
    }

    // Candado de seguridad (Igual al de Categorías)
    private function checkLoggedIn() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['ID_USER'])) {
            echo "<script>window.location.href='index.php?action=login';</script>";
            die();
        }
    }

    // Listar películas y pasar también las categorías para el formulario
    public function showPeliculas() {
        // === ARRANCAMOS LA SESIÓN ACÁ ===
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $peliculas = $this->model->getAll();
        
        // Buscamos todas las categorías de la base de datos
        $categorias = $this->categoriaModel->getAll(); 

        // Ahora la vista va a tener acceso tanto a $peliculas como a $categorias
        require_once 'listadoPeliculas.phtml';
    }

    // Procesar la inserción de la nueva película
    public function createPelicula() {
        $this->checkLoggedIn(); // Agregamos el candado de seguridad

        // Validamos que todos los campos del formulario hayan llegado con datos
        if (!empty($_POST['titulo']) && !empty($_POST['director']) && !empty($_POST['anio']) && !empty($_POST['id_categoria'])) {
            $titulo = $_POST['titulo'];
            $director = $_POST['director'];
            $anio = $_POST['anio'];
            $id_categoria = $_POST['id_categoria'];

            // Le pedimos al modelo que la guarde
            $this->model->insert($titulo, $director, $anio, $id_categoria);
        }

        // Al terminar, volvemos al listado principal de películas
        header("Location: index.php?action=peliculas");
    }

    // Procesar la eliminación de la película
    public function removePelicula() {
        $this->checkLoggedIn(); // Agregamos el candado de seguridad

        // Verificamos que venga el ID por la URL
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];

            // Le pedimos al modelo que la borre
            $this->model->delete($id);
        }

        // Redirigimos al listado de películas para ver los cambios
        header("Location: index.php?action=peliculas");
    }

    // === 1. SE EJECUTA AL TOCAR "[Editar]" EN PELÍCULAS ===
    public function showEditarPelicula() {
        $this->checkLoggedIn();
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Buscamos la película específica que queremos editar
            $peliculaEditando = $this->model->getPelicula($id); // (Asegurate de tener esta función en tu PeliculaModel)
            
            // Necesitamos listar todas las películas y categorías de nuevo para la pantalla
            $peliculas = $this->model->getAll();
            $categorias = $this->categoriaModel->getAll(); 
            
            require_once 'listadoPeliculas.phtml';
        }
    }

    // === 2. SE EJECUTA AL DARLE CLIC A "Actualizar" ===
    public function updatePelicula() {
        $this->checkLoggedIn();

        if (!empty($_POST['id_pelicula']) && !empty($_POST['titulo']) && !empty($_POST['director']) && !empty($_POST['anio']) && !empty($_POST['id_categoria'])) {
            $id = $_POST['id_pelicula'];
            $titulo = $_POST['titulo'];
            $director = $_POST['director'];
            $anio = $_POST['anio'];
            $id_categoria = $_POST['id_categoria'];

            // Mandamos los cambios al modelo de películas
            $this->model->update($id, $titulo, $director, $anio, $id_categoria); // (Asegurate de tener esta función en tu PeliculaModel)
        }

        header("Location: index.php?action=peliculas");
    }
}