<?php
include '../config/db.php'; // Incluir archivo de conexión
if (isset($_GET['id'])) {
$id = $_GET['id'];

// Obtener el nombre del usuario para mostrar en la confirmación
$sql = "SELECT username FROM directivos WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$username = $row['username'];
} else {
echo "Usuario no encontrado.";
exit;
}
} else {
echo "ID de usuario no especificado.";
exit;
}
?>
<h2>¿Estás seguro que deseas eliminar al usuario: <?php echo $username;
?>?</h2>
<p>Esta acción no se puede deshacer.</p>
<a href="Borrar.php?id=<?php echo $id; ?>">Eliminar</a>
<a href="read.php">Cancelar</a>
