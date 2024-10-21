<?php
// Verificar si se ha enviado el formulario de actualización
include '../config/db.php'; // Ruta del archivo de conexión
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$username = $_POST['username'];
$pass = $_POST['pass'];
// Actualizar los datos del perfil del usuario
$update_sql = "UPDATE directivos SET
nombre='$nombre',
apellido='$apellido',
username='$username',
pass='$pass' WHERE id = '$id'";
echo $username;
if ($conn->query($update_sql) === TRUE) {
echo "Perfil actualizado con éxito.";
// Actualizar el correo en la sesión si se ha cambiado
$_SESSION['username'] = $username;
header("Location: user_dashboard.php");
exit;
} else {
echo "Error al actualizar el perfil: " . $conn->error;
}
?>