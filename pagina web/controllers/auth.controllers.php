<?php



require_once __DIR__ . '/../models/usuario.models.php';
require_once __DIR__ . '/../views/auth.views.php';
require_once __DIR__ . '/../views/error.view.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {

        $this->model = new usuariomodels(); 
        $this->view = new AuthView();
    }
   
  public function login() {
    $user = $_POST['nombre'];
    $nombre = $this->model->buscarusuariobynombre($user);
    $password = $_POST['password'];

    if ($nombre && $nombre->password == $password) {
        session_start();

        $_SESSION['ID_USER'] = $nombre->id_user;
        $_SESSION['USERNAME'] = $nombre->nombre;

        header("Location: " . BASE_URL . "home");
        die();
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
 public function mostrarLogin() {
    $this->view->renderFormLogin();
}
}