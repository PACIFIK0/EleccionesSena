<?php
include '../config/db.php'; // Incluir archivo de conexión
$sql = "SELECT * FROM directivos";//Aquí va el nombre de la tabla donde almacena sus directivoss
$result = $conn->query($sql);
if ($result->num_rows > 0) {
//Esto debe ir adaptada a la tabla SQL
echo "<a href='admin_dashboard.php'>Inicio</a><br>
<a href='create.php'>Crear directivos</a>
<table border='1'>
<tr>
<th>id</th>
<th>nombre</th>
<th>apellido</th>
<th>username</th>
<th>pass</th>
<th>Rol</th>
<th>Acciones</th>
</tr>";
// Mostrar datos

while($row = $result->fetch_assoc()) {
echo "<tr>
<td>" . $row['id'] . "</td>
<td>" . $row['nombre'] . "</td>
<td>" . $row['apellido'] . "</td>
<td>" . $row['username'] . "</td>
<td>" . $row['pass'] . "</td>
<td>" . $row['Rol'] . "</td>
<td>
<a href='Edit.php?id=" . $row['id'] .

"'>Editar</a>

<a href='Delete.php?id=" . $row['id'] .

"'>Eliminar</a>
</td>
</tr>";
}
echo "</table>";
} else {
echo "0 resultados";
}
include ("Admin.html");
$conn->close();
?>