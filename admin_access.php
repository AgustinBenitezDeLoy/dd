<?php
session_start();

// Verifica si el usuario está logueado y si es administrador
if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    echo "Acceso denegado. Necesitas ser administrador para acceder a esta página.";
    exit;
} else {
    // Si el usuario es administrador, redirige a panel_admin.php
    header("Location: panel_admin.php");
    exit;
}
?>
