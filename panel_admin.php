<?php
session_start();

// Verifica si el usuario está logueado y si es administrador
if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    echo "Acceso denegado. Necesitas ser administrador para acceder a esta página.";
    exit; // Detiene la ejecución del script si el usuario no es administrador
}

// El resto del código para mostrar el panel de administración sigue aquí
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido del Panel de Administración</title>
</head>
<body>
    <h1>Bienvenido al Panel de Administración</h1>
    <!-- Contenidos del panel, como gestión de usuarios -->
</body>
</html>
