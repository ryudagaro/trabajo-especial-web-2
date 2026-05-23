<?php

class CategoriaModel {
    private $db;

    public function __construct() {

        $this->db =  new PDO('mysql:host=localhost;dbname=tpobligatorio;charset=utf8', 'root', '');
    }

    public function getAll() {
        
        $query = $this->db->prepare('SELECT * FROM categoria');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($nombre) {
        $query = $this->db->prepare('INSERT INTO categoria (nombre) VALUES (?)');
        
        $query->execute([$nombre]);
    }

    public function delete($id) {

        $query = $this->db->prepare('DELETE FROM categoria WHERE id_categoria = ?');
        $query->execute([$id]);
    }
    






}








?>