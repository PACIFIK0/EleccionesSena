<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];


    // Manejo de la imagen
    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($foto_tmp, "uploads/" . $foto);


    $conn = new mysqli('localhost', 'root', '', 'my_database');


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "CALL ActualizarProducto(?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issds", $id, $nombre, $descripcion, $precio, $foto);


    if ($stmt->execute()) {
        echo "Producto actualizado correctamente";
    } else {
        echo "Error: " . $stmt->error;
    }


    $stmt->close();
    $conn->close();
}
?>


<form method="POST" enctype="multipart/form-data">
    ID del Producto: <input type="text" name="id" required><br>
    Nombre: <input type="text" name="nombre" required><br>
    Descripción: <textarea name="descripcion" required></textarea><br>
    Precio: <input type="text" name="precio" required><br>
    Foto: <input type="file" name="foto" required><br>
    <input type="submit" value="Actualizar Producto">
</form>
