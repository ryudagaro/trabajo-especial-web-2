<?php

require_once __DIR__ . '/usuario.models.php';
require_once __DIR__ . '/auth.views.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new usuariomodels();
        $this->view = new AuthView();
    }

    public function login() {
       
        $user = isset($_POST['usuario']) ? $_POST['usuario'] : (isset($_POST['nombre']) ? $_POST['nombre'] : '');
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if (!empty($user) && !empty($password)) {
            $nombre = $this->model->buscarusuariobynombre($user);

            if ($nombre && $nombre->password == $password) {
                
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['ID_USER'] = $nombre->id;
                $_SESSION['USERNAME'] = $nombre->nombre;

                header("Location: index.php?action=categorias");
                die();
            } else {
                echo "Usuario o contraseña incorrectos";
            }
        } else {
            echo "Por favor, complete todos los campos";
        }
    }

    public function mostrarLogin() {
        $this->view->renderFormLogin();
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: index.php?action=categorias");
        die();
    }
}
    
?>
