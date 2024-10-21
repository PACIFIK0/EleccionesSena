<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el nombre de usuario basado en el correo electrónico almacenado en la sesión
$user = $_SESSION['username'];

// Consulta para obtener el nombre de usuario
$sql = "SELECT * FROM directivos WHERE username = '$user'";
$result = $conn->query($sql);



echo '<a href="read.php">Crear usuario</a><br>';
echo '<a href="logout.php">Cerrar sesión</a><br>';
include ("Admin.html");
$conn->close();
?>
