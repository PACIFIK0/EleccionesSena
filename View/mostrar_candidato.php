<?php
include '../config/db.php';
include 'Admin.html';
$sql = "CALL MostrarCandidato()";
if ($result = $conn->query($sql)) {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<h2>" . htmlspecialchars($row['nombre']) . "</h2>";
            echo "<p><strong>ID:</strong> " . htmlspecialchars($row['id']) . "</p>";
            echo "<p><strong>Curso:</strong> " . htmlspecialchars($row['Curso']) . "</p>";
            echo "<p><strong>Descripcion:</strong> " . htmlspecialchars($row['descripcion']) . "</p>";
            echo "<img src='../uploads/" . htmlspecialchars($row['foto']) . "' width='200' alt='Foto de " . htmlspecialchars($row['nombre']) . "'>";
            echo "</div>";
        }
    } else {
        echo "No hay candidatos";
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>