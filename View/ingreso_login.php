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
$user = $_POST['username'];
$pass = $_POST['password'];

// Consulta directa para verificar usuario y contraseña
$sql = "SELECT * FROM directivos WHERE username = '$user' AND pass = '$pass'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Establecer sesión
    
    $_SESSION['username'] = $user;
    $_SESSION['rol'] = $row['Rol'];

    // Redirigir según el rol del usuario
    if ($row['Rol'] == 'Rector') {
        header("Location: admin_dashboard.php");
    } elseif ($row['Rol'] == 'Estudiante') {
        header("Location: user_dashboard.php");
    } 
} else {
    echo "Usuario o contraseña incorrectos.";
}

$conn->close();
?>
