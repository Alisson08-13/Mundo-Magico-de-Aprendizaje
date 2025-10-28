<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $edad   = $_POST["edad"];
    $tema   = $_POST["tema"];

    $sql = "INSERT INTO `registro_nino1` (`Nombre`, `Edad`, `Tema de dificultad`)
            VALUES ('$nombre', '$edad', '$tema')";

    if ($conn->query($sql) === TRUE) {
        echo "
        <html><head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Registro Exitoso</title>
        <style>
          body {
            font-family: 'Fredoka One', cursive;
            background: linear-gradient(135deg,#fdfdfd,#fdfdfd);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
          }
          .msg {
            background: white;
            border-radius: 25px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
          }
          .emoji { font-size: 60px; animation: brinca 1.5s infinite ease-in-out; }
          h1 { color: #ff3366; margin-bottom: 10px; }
          @keyframes brinca {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
          }
        </style>
        </head><body>
        <div class='msg'>
          <div class='emoji'>🎉</div>
          <h1>¡Registro exitoso!</h1>
          <p>Bienvenido al Silabario Mágico 👦</p>
          <p>Serás redirigido en unos segundos...</p>
        </div>
        <script>
          // Guardamos los datos de registro para identificar al usuario en inicio.html
          localStorage.setItem('registrado', 'true');
          localStorage.setItem('tipoUsuario', 'Niño');
          localStorage.setItem('nombreUsuario', '" . addslashes($nombre) . "');
          // Redirige al menú
          setTimeout(()=>window.location='inicio.html', 3000);
        </script>
        </body></html>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
