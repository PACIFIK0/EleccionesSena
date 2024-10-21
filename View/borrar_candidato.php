<?php
include 'Admin.html';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];


    $conn = new mysqli('localhost', 'root', '', 'logindb');


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "CALL BorrarCandidato(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);


    if ($stmt->execute()) {
        echo "Candidato borrado correctamente";
    } else {
        echo "Error: " . $stmt->error;
    }


    $stmt->close();
    $conn->close();
}
?>


<form method="POST">
    ID del Candidato: <input type="text" name="id" required><br>
    <input type="submit" value="Borrar Candidato">
</form>