<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'user.html';

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

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre_usuario = $row['nombre'].' '.$row['apellido'];
    $bienvenida = "Bienvenido, Estudiante: " . htmlspecialchars($nombre_usuario) . "!";
} else {
    $bienvenida = "No se pudo encontrar el nombre del usuario.";
}

$conn->close();
?>