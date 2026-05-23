<?php
class peliculasView {

    private function renderHeader() {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>TP Especial - Películas</title>
            <link class="css" rel="stylesheet" href="<?= BASE_URL ?>estilos.css">
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

    public function mostrarHome($peliculas, $logueado) {
        $this->renderHeader();
        ?>
        <main class="container mt-5">
            <?php if ($logueado) { ?>
                <a href="<?= BASE_URL ?>admin" class="btn btn-admin mb-3">Ir al Panel de Administración</a>
            <?php } else { ?>
                <a href="<?= BASE_URL ?>login" class="btn btn-outline-primary mb-3">Entrar como Administrador</a>
            <?php } ?>

            <h1>Cartelera de Películas</h1>
            <ul class="list-group mt-3">
                <?php foreach ($peliculas as $p) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong><?= $p->titulo ?></strong> 
                        <a href="<?= BASE_URL ?>peliculas/<?= $p->id_pelicula ?>" class="btn btn-sm btn-primary">Ver Detalles ➔</a>
                    </li>
                <?php } ?>
            </ul>
        </main>
        <?php
        $this->renderFooter();
    }

    public function renderPelicula($pelicula) {
        $this->renderHeader();
        $imgSrc = !empty($pelicula->foto) ? BASE_URL . $pelicula->foto : '';
        ?>
        <main class="container mt-5">
            <h1>Información de la Película</h1>
            <a href="<?= BASE_URL ?>home" class="btn btn-outline-secondary mb-4">⬅ Volver al inicio</a>
            
            <div class="card p-4">
                <h2><?= htmlspecialchars($pelicula->titulo) ?></h2>
                <?php if ($imgSrc) { ?>
                    <img src="<?= $imgSrc ?>" alt="Portada" class="img-fluid my-3" style="max-width: 300px;">
                <?php } ?>
                <p><strong>Descripción:</strong> <?= htmlspecialchars($pelicula->descripcion) ?></p>
                <p><strong>Año de publicación:</strong> <?= $pelicula->anio ?></p>
                <p><strong>Género:</strong> <?= htmlspecialchars($pelicula->nombre_genero) ?></p>
                <p><strong>Elenco:</strong> <?= htmlspecialchars($pelicula->elenco) ?></p> 
            </div>
        </main>
        <?php
        $this->renderFooter();
    }

    public function mostrarPanelAdmin($peliculas, $generos, $peliculaAEditar = null) {
        $this->renderHeader();
        ?>
        <main class="container mt-5">
            <a href="<?= BASE_URL ?>home" class="btn btn-outline-secondary mb-3">⬅ Volver a la cartelera</a>
            
            <?php if ($peliculaAEditar) { ?>
                <h1>Modificar Película: <?= htmlspecialchars($peliculaAEditar->titulo) ?></h1>
            <?php } else { ?>
                <h1>Panel de Control (Administrador)</h1>
            <?php } ?>

            <form action="<?= BASE_URL ?>guardar" method="POST" enctype="multipart/form-data" class="my-4">
                <input type="hidden" name="id_pelicula" value="<?= $peliculaAEditar ? $peliculaAEditar->id_pelicula : '' ?>">

                <div class="mb-3">
                    <label class="form-label">Título de la película:</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Ej: El Padrino" value="<?= $peliculaAEditar ? htmlspecialchars($peliculaAEditar->titulo) : '' ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Descripción / Sinopsis:</label>
                    <textarea name="descripcion" class="form-control" placeholder="Escriba aquí..." required><?= $peliculaAEditar ? htmlspecialchars($peliculaAEditar->descripcion) : '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Año de lanzamiento:</label>
                    <input type="date" name="anio" class="form-control" value="<?= $peliculaAEditar ? $peliculaAEditar->anio : '' ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Género Cinematográfico:</label>
                    <select name="categoria" class="form-select" required>
                        <option value="">-- Seleccione un Género --</option>
                        <?php foreach ($generos as $g) { 
                            $selected = ($peliculaAEditar && $g->id_categoria == $peliculaAEditar->categoria) ? 'selected' : ''; ?>
                            <option value="<?= $g->id_categoria ?>" <?= $selected ?>><?= $g->nombre ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Elenco / Actores:</label>
                    <input type="text" name="elenco" class="form-control" placeholder="Actor 1, Actor 2..." value="<?= $peliculaAEditar ? htmlspecialchars($peliculaAEditar->elenco) : '' ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Foto de portada (Opcional):</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*">
                </div>

                <?php if ($peliculaAEditar) { ?>
                    <button type="submit" class="btn btn-warning">Confirmar Cambios ✏️</button>
                    <a href="<?= BASE_URL ?>admin" class="btn btn-link text-secondary text-decoration-none ms-3">Cancelar Edición</a>
                <?php } else { ?>
                    <button type="submit" class="btn btn-success">Guardar Película ➔</button>
                <?php } ?>
            </form>

            <h2 class="mt-5">Lista de Películas Cargadas</h2>
            <ul class="list-group mt-3">
                <?php foreach ($peliculas as $p) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong><?= $p->titulo ?></strong> 
                        <div>
                            <a href="<?= BASE_URL ?>admin/<?= $p->id_pelicula ?>" class="btn btn-sm btn-outline-warning me-2">✏️ Editar</a>
                            <a href="<?= BASE_URL ?>borrar/<?= $p->id_pelicula ?>" class="btn btn-sm btn-outline-danger">❌ Eliminar</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </main>
        <?php
        $this->renderFooter();
    }
}