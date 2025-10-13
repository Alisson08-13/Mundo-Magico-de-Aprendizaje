<?php
$conexion = new mysqli("localhost", "root", "", "database");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre = $conexion->real_escape_string($_POST['nombre']);
$edad = intval($_POST['edad']);
$tema = $conexion->real_escape_string($_POST['tema']);

$sql = "INSERT INTO `registro niño1` (Nombre, Edad, `Tema de dificultad`) 
        VALUES ('$nombre', $edad, '$tema')";

$mensaje = "";

if ($conexion->query($sql) === TRUE) {
    $mensaje = "✅ Registro guardado exitosamente.";
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
            margin: 0;
            height: 100vh;
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
        <a href="niños.html">⬅ Volver al formulario</a>
    </div>
</body>
</html>
