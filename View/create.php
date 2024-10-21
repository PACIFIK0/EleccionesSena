<?php
include '../config/db.php'; // Incluir archivo de conexión
include ("Admin.html");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$rol = $_POST['rol'];
// Insertar en la base de datos
$sql = "INSERT INTO directivos (nombre, apellido, username, pass, Rol)
VALUES ('$nombre', '$apellido', '$username', '$pass', '$rol')";
if ($conn->query($sql) === TRUE){
    header("Location: read.php");
    //echo "Registro creado con éxito";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    }
    ?>
    <!-- Formulario para crear un nuevo registro adaptado a la tabla de
    usuarios -->
    <form method="POST" action="create.php">
    Nombre: <input type="text" name="nombre" required><br>
    Apellido: <input type="text" name="apellido" required><br>
    Usuario: <input type="text" name="username" required><br>
    Contraseña: <input type="password" name="pass" required><br>
    <label for="rol">Seleccione un rol:</label>
  <select id="rol" name="rol">
    <option value="Rector">Administrador</option>
    <option value="Estudiante">Estudiante</option>
  </select><br>
    <button type="submit">Crear</button>
    </form>
