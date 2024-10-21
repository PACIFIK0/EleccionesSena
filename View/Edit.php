<?php
include '../config/db.php'; // Incluir archivo de conexión
include "Admin.html";
// Obtener el ID del usuario a editar
if (isset($_GET['id'])) {
$id = $_GET['id'];
// Obtener datos del usuario
$sql = "SELECT * FROM directivos WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$nombre = $row['nombre'];
$apellido = $row['apellido'];
$username = $row['username'];
$pass = $row['pass'];
$Rol = $row['Rol'];
} else {
echo "Usuario no encontrado.";
}
}
// Guardar los cambios al enviar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$rol = $_POST['Rol'];
// Actualizar los datos del usuario en la base de datos
$sql = "UPDATE directivos SET Nombre='$nombre', Apellido='$apellido',
username='$username', pass='$pass', rol='$rol' WHERE id=$id";
if ($conn->query($sql) === TRUE) {
header("Location: read.php");
} else {
echo "Error actualizando: " . $conn->error;
}
}
?>
<!-- Formulario de edición de usuario -->
<form method="POST" action="edit.php?id=<?php echo $id; ?>">
Nombre: <input type="text" name="nombre" value="<?php echo
$nombre; ?>" required><br>
Apellido: <input type="text" name="apellido"
value="<?php echo $apellido; ?>" required><br>
Usuario: <input type="text" name="username" value="<?php
echo $username; ?>" required><br>
Contraseña: <input type="password" name="pass"
value="<?php echo $pass; ?>" required><br>
Rol: 
<select name="Rol" required>
    <option value="Rector" <?php echo ($Rol == 'Rector') ? 'selected' : ''; ?>>Administrador</option>
    <option value="Estudiante" <?php echo ($Rol == 'Estudiante') ? 'selected' : ''; ?>>Estudiante</option>
</select><br>
<button type="submit">Actualizar</button>
</form>