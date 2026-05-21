<?php
require_once 'database.php';

class PeliculaModel {
    private $db;

    public function __construct() {
        
        $this->db = Database::connect();
    }

    public function getAll() {
        
        $query = $this->db->prepare('
            SELECT p.*, c.nombre AS nombre_categoria 
            FROM pelicula p 
            INNER JOIN categoria c ON p.id_categoria = c.id_categoria
        ');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($titulo, $director, $anio, $id_categoria) {
        $query = $this->db->prepare('INSERT INTO pelicula (titulo, director, anio, id_categoria) VALUES (?, ?, ?, ?)');
        
        $query->execute([$titulo, $director, $anio, $id_categoria]);
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM pelicula WHERE id_pelicula = ?');
        $query->execute([$id]);
    }

    public function getPelicula($id) {
        $query = $this->db->prepare('SELECT * FROM pelicula WHERE id_pelicula = ?');
        $query->execute([$id]);
        
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function update($id, $titulo, $director, $anio, $id_categoria) {
        $query = $this->db->prepare('
            UPDATE pelicula 
            SET titulo = ?, director = ?, anio = ?, id_categoria = ? 
            WHERE id_pelicula = ?
        ');
        
        $query->execute([$titulo, $director, $anio, $id_categoria, $id]);
    }
}
?>