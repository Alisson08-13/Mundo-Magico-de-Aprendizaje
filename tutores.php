<?php
$servername = "localhost";
$username = "root";        
$password = "";          
$dbname = "database";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

$stmt = $conn->prepare("INSERT INTO `registro tutor` (Nombre, Telefono, Correo) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $telefono, $correo);

$mensaje = "";
if ($stmt->execute()) {
    $mensaje = "✅ Registro guardado correctamente.";
} else {
    $mensaje = "❌ Error al guardar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado del Registro</title>
    <style>
        body {
            background: linear-gradient(to right top, #00c6ff, #0072ff);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .message-box {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 16px;
            text-align: center;
            color: #fff;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        }

        p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        a {
            text-decoration: none;
            background-color: #0288d1;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
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
        <a href="tutores.html">⬅ Volver al formulario</a>
    </div>
</body>
</html>
