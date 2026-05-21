<?php
require_once 'database.php'; // Traemos la conexión

class CategoriaModel {
    private $db;

    public function __construct() {
        // Al crearse el modelo, pedimos la conexión a la clase Database
        $this->db = Database::connect();
    }

    // Listado de categorías: Esta función trae todas las categorías de la base
    public function getAll() {
        $query = $this->db->prepare('SELECT * FROM categoria');
        $query->execute();

        // fetchAll nos devuelve un arreglo con todas las filas
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Insertar una nueva categoría
    public function insert($nombre, $imagen) {
        // Añadimos 'imagen' a la consulta SQL
        $query = $this->db->prepare("INSERT INTO categoria (nombre, imagen) VALUES (?, ?)");
        
        // Ejecutamos pasando las dos variables ordenadas
        $query->execute([$nombre, $imagen]);
    }

    // Eliminar una categoría por su ID
    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM categoria WHERE id_categoria = ?');
        $query->execute([$id]);
    }

    // Para traer una sola categoría cuando tocamos "Editar"
    public function getCategoria($id) {
        $query = $this->db->prepare("SELECT * FROM categoria WHERE id_categoria = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    // Para guardar los cambios editados en la base de datos
    public function update($id, $nombre, $imagen) {
        $query = $this->db->prepare("UPDATE categoria SET nombre = ?, imagen = ? WHERE id_categoria = ?");
        $query->execute([$nombre, $imagen, $id]);
    }
}
?>