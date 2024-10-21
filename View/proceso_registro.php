<?php
session_start();

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

// Obtener datos del formulario
$nombre = $_POST['name'];
$apellido = $_POST['surname'];
$username = $_POST['username'];
$pass = $_POST['password'];
$rol = 'Estudiante';

// Consulta directa para insertar los datos del estudiante
$sql = "INSERT INTO directivos(nombre, apellido, username, pass, Rol) VALUES ('$nombre', '$apellido', '$username', '$pass', '$rol')";

// Ejecutar la consulta e insertar los datos
if ($conn->query($sql) === TRUE) {
    header("Location:Login.php"); // Redirigir al login después del registro exitoso
} else {
    echo "Error en el registro: " . $conn->error; // Mostrar el error en caso de fallo
}

// Cerrar la conexión
$conn->close();
?>

