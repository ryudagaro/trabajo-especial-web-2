<?php
// Buscamos el modelo que está al lado usando __DIR__
require_once __DIR__ . '/categoriamodel.php';

class CategoriaController {
    private $model;

    public function __construct() {
        // El controlador crea una instancia del modelo para poder usarlo
        $this->model = new CategoriaModel();
    }

    private function checkLoggedIn() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['ID_USER'])) {
            // Si el header falla, este script obliga al navegador a viajar sí o sí
            echo "<script>window.location.href='index.php?action=login';</script>";
            die();
        }
    }

    // Listado de categorías
    public function showCategorias() {
        // === ACÁ ESTÁ EL CAMBIO CLAVE ===
        // Iniciamos la sesión para que la vista pueda leer las variables del Admin
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // 1. Le pide al modelo todas las categorías
        $categorias = $this->model->getAll();

        // 2. Incluimos la vista
        require_once 'listadoCategorias.phtml';
    }

    // Procesar la inserción de la categoría
    public function createCategoria() {
        $this->checkLoggedIn(); // Tu candado de seguridad clave

        if (!empty($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            
            // Si el usuario pegó un link lo guardamos, si no, queda como null (vacío)
            $imagen = !empty($_POST['imagen']) ? $_POST['imagen'] : null;

            // Le mandamos los dos datos al modelo
            $this->model->insert($nombre, $imagen);
        }
        
        header("Location: index.php?action=categorias");
    }

    // Procesar la eliminación de la categoría
    public function removeCategoria() {
        $this->checkLoggedIn();
        // Verificamos que venga el ID por la URL
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];

            // Le pedimos al modelo que la borre
            $this->model->delete($id);
        }

        // Redirigimos al listado para ver los cambios
        header("Location: index.php?action=categorias");
    }

    // 1. Se ejecuta al tocar "[Editar]". Carga los datos en el formulario.
    public function showEditarCategoria() {
        $this->checkLoggedIn();
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Buscamos la categoría específica en la BD
            $categoriaEditando = $this->model->getCategoria($id);
            
            // CORRECCIÓN 1: Cambiamos getCategorias() por getAll() que es el real
            $categorias = $this->model->getAll(); 
            
            // CORRECCIÓN 2: Usamos require_once que es la forma en que traés tus vistas
            require_once 'listadoCategorias.phtml';
        }
    }

    // 2. Se ejecuta al darle clic a "Actualizar"
    public function updateCategoria() {
        $this->checkLoggedIn();

        if (!empty($_POST['id_categoria']) && !empty($_POST['nombre'])) {
            $id = $_POST['id_categoria'];
            $nombre = $_POST['nombre'];
            $imagen = !empty($_POST['imagen']) ? $_POST['imagen'] : null;

            // Mandamos los cambios al modelo
            $this->model->update($id, $nombre, $imagen);
        }

        header("Location: index.php?action=categorias");
    }
}
?>