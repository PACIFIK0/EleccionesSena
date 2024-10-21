<?php
session_start();
include '../config/db.php'; // Ruta del archivo de conexión
include 'user.html';
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
header("Location: login.php");
exit;
}
// Obtener el correo del usuario desde la sesión
$username = $_SESSION['username'];
// Consulta para obtener los datos del perfil del usuario
$sql = "SELECT * FROM directivos WHERE username = '$username'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
 $id = $row ['id'];
 $nombre = $row['nombre'];
 $apellido = $row['apellido'];
 $username = $row['username'];
 $pass = $row['pass'];
 $Rol = $row['Rol'];
} else {
echo "No se pudo encontrar el perfil del usuario.";
exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-
scale=1.0">

<title>Editar Perfil</title>
</head>
<body>
<h2>Perfil de Usuario</h2>
<form method="POST" action="actualizar_perfil.php">
<label for="nombre">Nombre:</label>
<input type="hidden" id="id" name="id"
value="<?php echo htmlspecialchars($id); ?>"><br>
<input type="text" id="nombre" name="nombre"
value="<?php echo htmlspecialchars($nombre); ?>"><br>
<label for="apellido">Apellido:</label>
<input type="text" id="apellido" name="apellido"
value="<?php echo htmlspecialchars($apellido); ?>"><br>
<label for="username">Usuario:</label>
<input type="text" id="username" name="username"
value="<?php echo htmlspecialchars($username); ?>"><br>
<label for="pass">Contraseña:</label>
<input type="text" id="pass" name="pass"
value="<?php echo htmlspecialchars($pass); ?>"><br>
<button type="submit">Actualizar Perfil</button>
</form>
<br>
<button href="logout.php">Cerrar sesión</a>
</body>
</html>
<?php
$conn->close();
?>