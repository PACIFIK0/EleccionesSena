<?php
include('../config/db.php');
// Manejo de la votación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidato_id = $_POST['candidato'];

    // Insertar el voto en la tabla de votos
    $sql_voto = "INSERT INTO votos (candidato_id) VALUES (?)";
    $stmt_voto = $conn->prepare($sql_voto);
    $stmt_voto->bind_param("i", $candidato_id);
    $stmt_voto->execute();
    
    echo "<p>¡Gracias por votar!</p>";
}

// Obtener candidatos
$sql = "SELECT * FROM candidatos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votación Estudiantil</title>
    <style>
        .candidato {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }
        .candidato img {
            width: 250px;
            height: 200px;
        }
    </style>
</head>
<body>
    <h1>Elecciones Estudiantiles</h1>
    <form method="POST">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="candidato">
                    <img src="<?php echo $row['foto']; ?>" alt="<?php echo $row['nombre'] . ' ' . $row['descripcion']; ?>">
                    <h2><?php echo $row['nombre'] . ' ' . $row['descripcion']; ?></h2>
                    <p>Curso: <?php echo $row['Curso']; ?></p>
                    <input type="radio" name="candidato" value="<?php echo $row['id']; ?>" required> Votar
                </div>
            <?php endwhile; ?>
            <button type="submit">Enviar Voto</button>
        <?php else: ?>
            <p>No hay candidatos disponibles.</p>
        <?php endif; ?>
    </form>
</body>
</html>

<?php
$conn->close();
?>