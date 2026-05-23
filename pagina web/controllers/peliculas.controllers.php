<?php
require_once __DIR__ . '/../models/peliculas.models.php';
require_once __DIR__ . '/../views/peliculas.view.php';
require_once __DIR__ . '/../views/error.view.php';
require_once __DIR__ . '/../models/categoriamodel.php';

class peliculascontroller {

    private $model;
    private $view;
    private $errorView;
    private $categoriaModel;

    public function __construct() {
        $this->model = new peliculasModel();
        $this->view = new peliculasView();
        $this->errorView = new errorview();
        $this->categoriaModel = new CategoriaModel(); 
    }
  
    public function home() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $logueado = isset($_SESSION['ID_USER']); 
        
        $peliculas = $this->model->getpeliculas();
        $this->view->mostrarHome($peliculas, $logueado); 
    }

    public function mostrarpeliculas($id) {
        $pelicula = $this->model->getpeliculabyid($id);

        if (!$pelicula) { 
            return $this->errorView->renderError("La película con el ID $id no existe.");
        }

        $this->view->renderPelicula($pelicula);
    }

    public function mostrarAdmin($id = null) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['ID_USER'])) {
            header("Location: " . BASE_URL . "login");
            die(); 
        }

        $peliculas = $this->model->getpeliculas();
        $generos = $this->categoriaModel->getAll(); 

        $peliculaAEditar = null;
        if ($id != null) {
            $peliculaAEditar = $this->model->getpeliculabyid($id);
        }

        $this->view->mostrarPanelAdmin($peliculas, $generos, $peliculaAEditar);
    }

    public function guardarPelicula() {
        if (session_status() == PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['ID_USER'])) { header("Location: " . BASE_URL . "login"); die(); }

        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $anio = $_POST['anio'];
        $categoria = $_POST['categoria']; 
        $elenco = $_POST['elenco'];       
        $id_pelicula = $_POST['id_pelicula']; 

        $fotoRuta = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0) {
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
                $nombreFoto = uniqid() . "-" . $_FILES['imagen']['name'];
                $destino = "images/" . $nombreFoto;
                
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
                    $fotoRuta = $destino; 
                }
            }
        }

        if (!empty($id_pelicula)) {
            $this->model->actualizar($id_pelicula, $titulo, $descripcion, $categoria, $anio, $elenco, $fotoRuta);
        } else {
            $this->model->insertar($titulo, $descripcion, $categoria, $anio, $elenco, $fotoRuta);
        }

        header("Location: " . BASE_URL . "admin");
        die();
    }

    public function borrarPelicula($id) {
        if (session_status() == PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['ID_USER'])) { header("Location: " . BASE_URL . "login"); die(); }

        $this->model->borrar($id);

        header("Location: " . BASE_URL . "admin");
        die();
    }
}