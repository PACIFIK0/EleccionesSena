<?php
   $server="localhost";
   $username="root";
   $password="";
   $database="logindb";


   try{ 

    $conexion= new PDO("mysql:host=$server;dbname=$database;charset=utf8",$username,$password);

   
    echo "Funciono!";

}catch(PDOException $error){
    die ('conexion fallida: '.$error -> getMessage());
}
   

?>