<?php
include '../config/db.php'; // Incluir archivo de conexión
// Verificar si se ha pasado un ID a través de la URL
if (isset($_GET['id'])) {
$id = $_GET['id'];
// Preparar la consulta de eliminación
$sql = "DELETE FROM directivos WHERE id = $id";
// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
echo "Usuario eliminado con éxito.";
// Redirigir al listado de usuarios después de la eliminación
header("Location: read.php");
exit;
} else {
echo "Error al eliminar el usuario: " . $conn->error;
}
} else {
echo "ID de usuario no especificado.";
}
?>