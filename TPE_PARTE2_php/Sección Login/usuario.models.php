<?php
 class usuariomodels{
    private $db;
      
       public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_peliculas;charset=utf8', 'root', '');
    }


   public function buscarusuariobynombre($nombre){
        $sentencia= $this->db->prepare("SELECT * FROM usuario WHERE nombre = ?");
         $sentencia->execute([$nombre]);
         $nombre_usuario = $sentencia->fetch(PDO::FETCH_OBJ);
           return $nombre_usuario;
   }
 }
 ?>