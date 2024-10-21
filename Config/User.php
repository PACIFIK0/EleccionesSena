<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_level'] !=='admin')
{
    header("Location: ../views/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panel de Administrador</title>
        <link rel="stylesheet" href="../assets/styles.css">
    </head>
<body>
    <div class="container">
        <h1>Bienvenido, Administrador <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <p>Este es tu panel de administrador. </p>

        <ul>
            <li><a href="manage_users.php">Gestionar usuarios</a></li>
            <li><a href="site_settings.php">Configuarciones del Sitio</a></li>
            <li><a href="reports.php">Ver reportes</a></li>
            <li><a href="../controllers/AuthController.php?action=logout">Cerrar Sesion</a></li>
        </ul>
    </div>
</body>
</html>
