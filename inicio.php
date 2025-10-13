<?php
session_start();

// Conexión
$conn = new mysqli("localhost", "root", "", "database");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el usuario ya está registrado en alguna base
$registrado = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $conn->real_escape_string($_POST["correo"]);

    $consultas = [
        "SELECT * FROM `registro niño1` WHERE Correo = '$correo'",
        "SELECT * FROM `registro maestros` WHERE Correo = '$correo'",
        "SELECT * FROM `registro tutor` WHERE Correo = '$correo'"
    ];

    foreach ($consultas as $query) {
        $resultado = $conn->query($query);
        if ($resultado && $resultado->num_rows > 0) {
            $registrado = true;
            break;
        }
    }

    if (!$registrado) {
        $error = "❌ No se encontró registro con ese correo.";
    } else {
        $_SESSION['correo'] = $correo;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio | Aprende a Leer</title>
    <style>
        body {
            margin: 0;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background: linear-gradient(to right top, #00c6ff, #0072ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 40px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
            text-align: center;
            color: white;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            margin-bottom: 25px;
        }

        input[type="email"] {
            padding: 12px;
            width: 80%;
            max-width: 300px;
            border: none;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #0288d1;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            color: white;
            margin-bottom: 20px;
        }

        .levels {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .levels a {
            display: block;
            padding: 15px;
            border-radius: 12px;
            background-color: #4fc3f7;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .levels a:hover {
            background-color: #0288d1;
        }

        .error {
            color: #ffdddd;
            background-color: #d32f2f;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .success {
            color: #c8e6c9;
            background-color: #388e3c;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!isset($_SESSION['correo'])): ?>
            <h1>¡Mundo Magico de Aprendizaje! </h1>
            <p>Por favor, ingresa tu correo para comenzar. Debes estar registrado como niño, maestro o tutor.</p>
            <?php if (isset($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <input type="email" name="correo" placeholder="Tu correo registrado" required>
                <br>
                <input type="submit" value="Ingresar">
            </form>
        <?php else: ?>
            <h1>Hola </h1>
            <p>Elige un nivel para comenzar a aprender:</p>
            <div class="levels">
                <a href="nivel1.php"> Nivel 1: Letras y sonidos</a>
                <a href="nivel2.php"> Nivel 2: Palabras básicas</a>
                <a href="nivel3.php"> Nivel 3: Lectura de frases</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
