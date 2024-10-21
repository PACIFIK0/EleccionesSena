<?php
include '../config/conexion.php'; // Incluir archivo de conexión
$sql = "SELECT * FROM usuario";//Aquí va el nombre de la tabla donde
almacena sus usuarios
$result = $conn->query($sql);
if ($result->num_rows > 0) {
//Esto debe ir adaptada a la tabla SQL
echo "<a href='admin_dashboard.php'>Inicio</a><br>
<a href='create.php'>Crear usuario</a>
<table border='1'>
<tr>
<th>IDUsuario</th>
<th>Usuario</th>
<th>Correo Electrónico</th>
<th>Tipo de Documento</th>
<th>Número de Documento</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Rol</th>
<th>Acciones</th>
</tr>";
// Mostrar datos

while($row = $result->fetch_assoc()) {
echo "<tr>
<td>" . $row['IDUsuario'] . "</td>
<td>" . $row['Usuario'] . "</td>
<td>" . $row['Correo_Electronico'] . "</td>
<td>" . $row['Tipo_Documento'] . "</td>
<td>" . $row['Numero_Documento'] . "</td>
<td>" . $row['Nombre'] . "</td>
<td>" . $row['Apellido'] . "</td>
<td>" . $row['Rol'] . "</td>
<td>
<a href='update.php?id=" . $row['IDUsuario'] .

"'>Editar</a>

<a href='delete.php?id=" . $row['IDUsuario'] .

"'>Eliminar</a>
</td>
</tr>";
}
echo "</table>";
} else {
echo "0 resultados";
}
$conn->close();
?>