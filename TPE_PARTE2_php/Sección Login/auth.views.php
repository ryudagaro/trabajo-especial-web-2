<?php
class AuthView {
    public function renderFormLogin() {
        echo '
            <h2>Iniciar Sesión</h2>
            <form action="index.php?action=verify" method="POST">
                <input type="text" name="nombre" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Entrar</button>
            </form>
        ';
    }
}
?>