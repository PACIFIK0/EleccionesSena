<?php
include('../config/db.php');

// Obtener el conteo de votos por candidato
$sql = "
    SELECT c.id, c.nombre, c.descripcion, c.Curso, c.foto, COUNT(v.id) AS total_votos
    FROM candidatos c
    LEFT JOIN votos v ON c.id = v.candidato_id
    GROUP BY c.id
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteo de Votos</title>
    <style>
        .candidato {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }
        .candidato img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <h1>Conteo de Votos</h1>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="candidato">
                <img src="<?php echo $row['foto']; ?>" alt="<?php echo $row['nombre']; ?>">
                <h2><?php echo $row['nombre']; ?></h2>
                <p>Descripcion: <?php echo $row['descripcion']; ?></p>
                <p>Curso: <?php echo $row['Curso']; ?></p>
                <p>Votos: <?php echo $row['total_votos']; ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay candidatos disponibles.</p>
    <?php endif; ?>
    <p><a href="index.php">Volver a Votar</a></p>
    <p><a href="admin_dashboard.php">Volver</a></p>
</body>
</html>

<?php
$conn->close();
?>