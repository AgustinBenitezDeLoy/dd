<?php
session_start();
$_SESSION = array(); // Limpiar todas las variables de sesión
session_destroy(); // Destruir la sesión
header('Location: index.html'); // Redirigir al inicio de sesión
exit;
?>
