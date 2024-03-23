<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "reentraste";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$mensaje = ""; // Mensaje para el usuario
$redireccion = ""; // URL de redirección

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $stmt = $conn->prepare("SELECT id, rol, contraseña, validado FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($usuario = $resultado->fetch_assoc()) {
        if (password_verify($contraseña, $usuario['contraseña'])) {
            if ($usuario['validado'] === 'rechazado') {
                $mensaje = "Tu cuenta ha sido rechazada.";
            } elseif ($usuario['validado'] === 'validado') {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['rol'] = $usuario['rol'];
                $mensaje = "Sesión iniciada con éxito. Serás redirigido en breve...";
                if ($usuario['rol'] == 'administrador') {
                    $redireccion = "panel_admin.php";
                } else {
                    $redireccion ="pagina_vendedor.php"; // Asegúrate de que esta es la ruta correcta
                }
            } else {
                $mensaje = "Tu cuenta está pendiente de verificación.";
            }
        } else {
            $mensaje = "Credenciales inválidas.";
        }
    } else {
        $mensaje = "Credenciales inválidas.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <?php if (!empty($mensaje)) echo "<p>$mensaje</p>"; ?>
    <?php if (!empty($redireccion)) : ?>
        <script>
            setTimeout(function() {
                window.location.href = '<?php echo $redireccion; ?>';
            }, 2000); // Redirige después de 2 segundos
        </script>
    <?php endif; ?>
</body>
</html>
