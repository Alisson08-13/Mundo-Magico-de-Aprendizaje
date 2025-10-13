<?php
$conexion = new mysqli("localhost", "root", "", "database");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre = $conexion->real_escape_string($_POST['nombre']);
$correo = $conexion->real_escape_string($_POST['correo']);
$numero = $conexion->real_escape_string($_POST['numero']);
$grado = $conexion->real_escape_string($_POST['grado']);

$sql = "INSERT INTO `registro maestros` (Nombre, Correo, Numero, Grado)
        VALUES ('$nombre', '$correo', '$numero', '$grado')";

$mensaje = "";

if ($conexion->query($sql) === TRUE) {
    $mensaje = "✅ Registro exitoso.";
} else {
    $mensaje = "❌ Error al guardar: " . $conexion->error;
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado del Registro</title>
    <style>
        body {
            background: linear-gradient(to right top, #00c6ff, #0072ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .message-box {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            padding: 40px;
            border-radius: 16px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            color: white;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        a {
            background-color: #0288d1;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0277bd;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <p><?php echo $mensaje; ?></p>
        <a href="maestro.html">⬅ Volver al formulario</a>
    </div>
</body>
</html>
