<?php
include('../config/db.php');
// Manejo de la votación
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidato_id = $_POST['candidato'];
    $ip_votante = $_SERVER['REMOTE_ADDR'];

    // Verificar si el usuario ya ha votado
    $checkVoteSql = "SELECT * FROM votos WHERE ip_votante = ? AND candidato_id = ?";
    $checkVoteStmt = $conn->prepare($checkVoteSql);
    $checkVoteStmt->bind_param("si", $ip_votante, $candidato_id);
    $checkVoteStmt->execute();
    $checkVoteResult = $checkVoteStmt->get_result();

    if ($checkVoteResult->num_rows > 0) {
        $mensaje = "<p>Ya has votado por este candidato. Por favor, sal de la página.</p>";
    } else {
        // Insertar el voto en la tabla de votos
        $sql_voto = "INSERT INTO votos (candidato_id, ip_votante) VALUES (?, ?)";
        $stmt_voto = $conn->prepare($sql_voto);
        $stmt_voto->bind_param("is", $candidato_id, $ip_votante);
        $stmt_voto->execute();
        $mensaje = "<p>¡Gracias por votar! Por favor, sal de la página.</p>";
    }
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
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <h1>Elecciones Estudiantiles</h1>
    
    <?php if ($mensaje): ?>
        <div><?php echo $mensaje; ?></div>
    <?php else: ?>
        <form method="GET">
            <button type="submit" name="show_candidates">Votar</button>
        </form>
    
        <?php if (isset($_GET['show_candidates']) && $result->num_rows > 0): ?>
            <form method="POST">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="candidato">
                        <img src="<?php echo $row['foto']; ?>" alt="<?php echo $row['nombre']; ?>">
                        <h2><?php echo $row['nombre']; ?></h2>
                        <p>Descripcion: <?php echo $row['descripcion']; ?></p>
                        <p>Curso: <?php echo $row['Curso']; ?></p>
                        <input type="radio" name="candidato" value="<?php echo $row['id']; ?>" required> Votar
                    </div>
                <?php endwhile; ?>
                <button type="submit">Enviar Voto</button>
            </form>
        <?php elseif ($result->num_rows === 0): ?>
            <p>No hay candidatos disponibles.</p>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>