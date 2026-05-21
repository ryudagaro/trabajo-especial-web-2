<?php

require_once __DIR__ . '/categoriamodel.php';

class CategoriaController {
    private $model;

    public function __construct() {
        
        $this->model = new CategoriaModel();
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

    
    public function showCategorias() {
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        
        $categorias = $this->model->getAll();

        
        require_once 'listadoCategorias.phtml';
    }

    
    public function createCategoria() {
        $this->checkLoggedIn(); 

        if (!empty($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            
            
            $imagen = !empty($_POST['imagen']) ? $_POST['imagen'] : null;

            
            $this->model->insert($nombre, $imagen);
        }
        
        header("Location: index.php?action=categorias");
    }

    
    public function removeCategoria() {
        $this->checkLoggedIn();
        
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];

            
            $this->model->delete($id);
        }

        
        header("Location: index.php?action=categorias");
    }

    
    public function showEditarCategoria() {
        $this->checkLoggedIn();
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $categoriaEditando = $this->model->getCategoria($id);
            
            
            $categorias = $this->model->getAll(); 
            
            
            require_once 'listadoCategorias.phtml';
        }
    }

    
    public function updateCategoria() {
        $this->checkLoggedIn();

        if (!empty($_POST['id_categoria']) && !empty($_POST['nombre'])) {
            $id = $_POST['id_categoria'];
            $nombre = $_POST['nombre'];
            $imagen = !empty($_POST['imagen']) ? $_POST['imagen'] : null;

            
            $this->model->update($id, $nombre, $imagen);
        }

        header("Location: index.php?action=categorias");
    }
}
?>