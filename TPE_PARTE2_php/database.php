<?php
    require_once 'config.php';
    class Database {
        public static function connect (){
            try{
                $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $db;
            }
            catch (PDOException $e){
                
                $db = new PDO('mysql:host='.DB_HOST, DB_USER, DB_PASS);
                
                
                $db->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
                $db->exec("USE " . DB_NAME);

                
                $db->exec("CREATE TABLE IF NOT EXISTS categoria (
                    id_categoria INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL
                )");

                $db->exec("CREATE TABLE IF NOT EXISTS pelicula (
                    id_pelicula INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    titulo VARCHAR(150) NOT NULL,
                    director VARCHAR(100) NOT NULL,
                    anio INT NOT NULL,
                    id_categoria INT NOT NULL,
                    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria) ON DELETE CASCADE
                )");

                
                $db->exec("INSERT IGNORE INTO categoria (id_categoria, nombre) VALUES 
                    (1, 'Acción'), 
                    (2, 'Drama'), 
                    (3, 'Comedia')");

                
                $db->exec("INSERT IGNORE INTO pelicula (id_pelicula, titulo, director, anio, id_categoria) VALUES 
                    (1, 'El Padrino', 'Francis Ford Coppola', 1972, 2), 
                    (2, 'Bastardos Sin Gloria', 'Quentin Tarantino', 2009, 1), 
                    (3, 'Superbad', 'Greg Mottola', 2007, 3)");

                return $db;
            }
        }
    }
?>