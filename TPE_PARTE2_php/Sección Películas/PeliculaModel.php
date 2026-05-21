<?php
require_once 'database.php';

class PeliculaModel {
    private $db;

    public function __construct() {
        // Usamos nuestra clase estática para conectarnos de forma segura
        $this->db = Database::connect();
    }

    // Listar todas las películas con su categoría
    public function getAll() {
        // Hacemos un INNER JOIN para cruzar la tabla pelicula con categoria
        $query = $this->db->prepare('
            SELECT p.*, c.nombre AS nombre_categoria 
            FROM pelicula p 
            INNER JOIN categoria c ON p.id_categoria = c.id_categoria
        ');
        $query->execute();

        // Devolvemos los resultados como objetos
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Insertar una nueva película
    public function insert($titulo, $director, $anio, $id_categoria) {
        $query = $this->db->prepare('INSERT INTO pelicula (titulo, director, anio, id_categoria) VALUES (?, ?, ?, ?)');
        
        // Pasamos los 4 parámetros en el mismo orden que los signos de pregunta
        $query->execute([$titulo, $director, $anio, $id_categoria]);
    }

    // Eliminar una película por su ID
    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM pelicula WHERE id_pelicula = ?');
        $query->execute([$id]);
    }

    // === NUEVA FUNCIÓN 1: Buscar una sola película por su ID para editarla ===
    public function getPelicula($id) {
        $query = $this->db->prepare('SELECT * FROM pelicula WHERE id_pelicula = ?');
        $query->execute([$id]);
        
        // Retorna un único objeto con los datos de esa película
        return $query->fetch(PDO::FETCH_OBJ);
    }

    // === NUEVA FUNCIÓN 2: Guardar los datos modificados en la Base de Datos ===
    public function update($id, $titulo, $director, $anio, $id_categoria) {
        $query = $this->db->prepare('
            UPDATE pelicula 
            SET titulo = ?, director = ?, anio = ?, id_categoria = ? 
            WHERE id_pelicula = ?
        ');
        
        // Pasamos los datos en el mismo orden estricto de los "?"
        $query->execute([$titulo, $director, $anio, $id_categoria, $id]);
    }
}
?>