<?php

require_once __DIR__ . '/PeliculaModel.php';
require_once __DIR__ . '/../Sección Categorías/categoriamodel.php';

class PeliculaController {
    private $model;
    private $categoriaModel; 

    public function __construct() {
        $this->model = new PeliculaModel();
        $this->categoriaModel = new CategoriaModel(); 
    }

    private function checkLoggedIn() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['ID_USER'])) {
            echo "<script>window.location.href='index.php?action=login';</script>";
            die();
        }
    }

    public function showPeliculas() {
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $peliculas = $this->model->getAll();
        
        $categorias = $this->categoriaModel->getAll(); 

        require_once 'listadoPeliculas.phtml';
    }

    public function createPelicula() {
        $this->checkLoggedIn(); 

        if (!empty($_POST['titulo']) && !empty($_POST['director']) && !empty($_POST['anio']) && !empty($_POST['id_categoria'])) {
            $titulo = $_POST['titulo'];
            $director = $_POST['director'];
            $anio = $_POST['anio'];
            $id_categoria = $_POST['id_categoria'];

            $this->model->insert($titulo, $director, $anio, $id_categoria);
        }

        header("Location: index.php?action=peliculas");
    }

    public function removePelicula() {
        $this->checkLoggedIn(); 
        
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];

            $this->model->delete($id);
        }

        header("Location: index.php?action=peliculas");
    }

    public function showEditarPelicula() {
        $this->checkLoggedIn();
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $peliculaEditando = $this->model->getPelicula($id); 
            $peliculas = $this->model->getAll();
            $categorias = $this->categoriaModel->getAll(); 
            
            require_once 'listadoPeliculas.phtml';
        }
    }

    public function updatePelicula() {
        $this->checkLoggedIn();

        if (!empty($_POST['id_pelicula']) && !empty($_POST['titulo']) && !empty($_POST['director']) && !empty($_POST['anio']) && !empty($_POST['id_categoria'])) {
            $id = $_POST['id_pelicula'];
            $titulo = $_POST['titulo'];
            $director = $_POST['director'];
            $anio = $_POST['anio'];
            $id_categoria = $_POST['id_categoria'];

            $this->model->update($id, $titulo, $director, $anio, $id_categoria);
        }

        header("Location: index.php?action=peliculas");
    }
}
?>