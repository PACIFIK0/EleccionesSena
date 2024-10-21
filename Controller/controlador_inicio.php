<?php

include '../Config/conexion.php';

$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

$validar_login = "SELECT * FROM directivos WHERE usuario = :username AND contraseña = :password ";

$stmt = $conexion->prepare($validar_login);

$stmt -> execute ([
    ':username' => $username,
    ':password' => $password
]);

if($stmt->rowCount() > 0){
    if ($username === 'Willy') 
    header("Location: Admin.html");
} else {
    echo '
    <script>
    alert("El usuario no está registrado");
    window.location = "../View/Login.php";
    </script>
    ';
    exit;
}
?>