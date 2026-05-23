<?php
class AuthView {

    private function renderHeader() {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Iniciar Sesión</title>
            <link rel="stylesheet" href="<?= BASE_URL ?>estilos.css">
        </head>
        <body>
        <?php
    }

    private function renderFooter() {
        ?>
        </body>
        </html>
        <?php
    }

    public function renderFormLogin() {
        $this->renderHeader();
        ?>
        <main class="container mt-5">
            <a href="<?= BASE_URL ?>home" class="btn btn-outline-secondary mb-3">⬅ Volver a la cartelera</a>
            
            <h2>Iniciar Sesión</h2>
            <form action="<?= BASE_URL ?>verify" method="POST" class="mt-3">
                <div class="mb-3">
                    <label class="form-label">Nombre de Usuario:</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Usuario" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Contraseña:</label>
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                </div>
                
                <button type="submit" class="btn btn-primary mt-2">Entrar al Panel ➔</button>
            </form>
        </main>
        <?php
        $this->renderFooter();
    }
}  