<?php

class peliculasModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=tpobligatorio;charset=utf8', 'root', '');
    }


    public function getpeliculas() {
        $sentencia = $this->db->prepare("SELECT * FROM pelicula");
        $sentencia->execute();
        $peliculas = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $peliculas;
    }

    public function getpeliculabyid($id) {
        $sentencia = $this->db->prepare("
            SELECT pelicula.*, categoria.nombre AS nombre_genero 
            FROM pelicula 
            JOIN categoria ON pelicula.categoria = categoria.id_categoria 
            WHERE pelicula.id_pelicula = ?
        ");
        $sentencia->execute([$id]);
        $pelicula = $sentencia->fetch(PDO::FETCH_OBJ);
        return $pelicula;
    }

    public function insertar($titulo, $descripcion, $categoria, $anio, $elenco, $foto) {
        $query = $this->db->prepare('INSERT INTO pelicula (titulo, descripcion, categoria, anio, elenco, foto) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$titulo, $descripcion, $categoria, $anio, $elenco, $foto]);
    }

    public function actualizar($id, $titulo, $descripcion, $categoria, $anio, $elenco, $foto = null) {
        if ($foto) {
            $query = $this->db->prepare('
                UPDATE pelicula 
                SET titulo = ?, descripcion = ?, categoria = ?, anio = ?, elenco = ?, foto = ? 
                WHERE id_pelicula = ?
            ');
            $query->execute([$titulo, $descripcion, $categoria, $anio, $elenco, $foto, $id]);
        } else {
            $query = $this->db->prepare('
                UPDATE pelicula 
                SET titulo = ?, descripcion = ?, categoria = ?, anio = ?, elenco = ? 
                WHERE id_pelicula = ?
            ');
            $query->execute([$titulo, $descripcion, $categoria, $anio, $elenco, $id]);
        }
    }

    public function borrar($id) {
        $query = $this->db->prepare('DELETE FROM pelicula WHERE id_pelicula = ?');
        $query->execute([$id]);
    }
}