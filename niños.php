<?php
$conexion = new mysqli("localhost", "root", "", "database");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre = trim($_POST['nombre']);
$edad = trim($_POST['edad']);
$tema = trim($_POST['tema']);

if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $nombre)) {
    die("El nombre solo puede contener letras y espacios.");
}

if (!preg_match("/^\d{1,2}$/", $edad) || $edad < 1 || $edad > 18) {
    die("La edad debe ser un número entre 1 y 18.");
}

if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $tema)) {
    die("El tema de dificultad solo puede contener letras y espacios.");
}

$nombre = $conexion->real_escape_string($nombre);
$edad = intval($edad);
$tema = $conexion->real_escape_string($tema);

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
