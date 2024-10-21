<?php

include 'C:/X4mpp/htdocs/eleccion_personero/Config/conexion.php';

$name = isset($_POST['name']) ? $_POST['name'] : null;
$surname = isset($_POST['surname']) ? $_POST['surname'] : null;
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

$query = "INSERT INTO directivos (nombre, apellido, usuario, contraseña) 
VALUES (:name, :surname, :username, :password) ";

$stmt = $conexion -> prepare ($query);

$stmt -> execute ([
    ':name' => $name ,
    ':surname' => $surname ,
    ':username' => $username ,
    ':password' => $password
]);

if ($stmt) {
    echo '
    <script>
        window.location = "../View/Login.php";
    </script>
    ';
}

$stmt = null;
$conexion = null;
?>