<?php
include '../config/db.php';
include ("Admin.html");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $Curso = $_POST['Curso'];


    // Manejo de la imagen
    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($foto_tmp, "../uploads/" . $foto);


    $conn = new mysqli('localhost', 'root', '', 'logindb');


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "CALL InsertarCandidato(?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $descripcion, $Curso, $foto);


    if ($stmt->execute()) {
        echo "Producto insertado correctamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<form method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre" required><br>
    Descripción: <textarea name="descripcion" required></textarea><br>
    <br><label for="Curso">Seleccione un curso:</label>
  <select id="Curso" name="Curso">
    <option value="1101">1101</option>
    <option value="1102">1102</option>
    <option value="1103">1103</option>
    <option value="1104">1104</option>
    <option value="1105">1105</option>
    <option value="1106">1106</option>
  </select><br>
    <br>Foto: <input type="file" name="foto" required><br>
    <br><input type="submit" value="Insertar Candidato">
</form>
