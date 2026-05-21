<?php
require_once 'database.php'; 

class CategoriaModel {
    private $db;

    public function __construct() {
        
        $this->db = Database::connect();
    }

    
    public function getAll() {
        $query = $this->db->prepare('SELECT * FROM categoria');
        $query->execute();

        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function insert($nombre, $imagen) {
        
        $query = $this->db->prepare("INSERT INTO categoria (nombre, imagen) VALUES (?, ?)");
        
        
        $query->execute([$nombre, $imagen]);
    }

    
    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM categoria WHERE id_categoria = ?');
        $query->execute([$id]);
    }

    
    public function getCategoria($id) {
        $query = $this->db->prepare("SELECT * FROM categoria WHERE id_categoria = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    
    public function update($id, $nombre, $imagen) {
        $query = $this->db->prepare("UPDATE categoria SET nombre = ?, imagen = ? WHERE id_categoria = ?");
        $query->execute([$nombre, $imagen, $id]);
    }
}
?>