<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];

    // Insertar datos del tutor
    $sql = "INSERT INTO registro_tutor1 (Nombre, Telefono, Correo)
            VALUES ('$nombre', '$telefono', '$correo')";

    if ($conn->query($sql) === TRUE) {
        // También guardamos un registro inicial en la tabla de avances
        $avance = "INSERT INTO avances (nombre, tipo_usuario, nivel, progreso)
                   VALUES ('$nombre', 'Tutor', 'Acompañando al niño', 15)";
        $conn->query($avance);

        echo "
        <html><head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Registro Exitoso</title>
        <style>
          body{font-family:'Fredoka One',cursive;background:linear-gradient(135deg,#fdfdfd,#fdfdfd);
          display:flex;align-items:center;justify-content:center;height:100vh;}
          .msg{background:white;border-radius:25px;padding:40px;text-align:center;
          box-shadow:0 10px 30px rgba(0,0,0,0.2);}
          .emoji{font-size:60px;animation:brinca 1.5s infinite ease-in-out;}
          h1{color:#ff3366;margin-bottom:10px;}
          @keyframes brinca{0%,100%{transform:translateY(0);}50%{transform:translateY(-10px);}}
        </style>
        </head><body>
        <div class='msg'>
          <div class='emoji'>🎉</div>
          <h1>¡Registro exitoso!</h1>
          <p>Bienvenido Tutor/a 💕</p>
          <p>Serás redirigido al menú en unos segundos...</p>
        </div>
        <script>
          localStorage.setItem('registrado', 'true');
          localStorage.setItem('tipoUsuario', 'Tutor');
          localStorage.setItem('nombreUsuario', '" . addslashes($nombre) . "');
          setTimeout(()=>window.location='inicio.html',3000);
        </script>
        </body></html>";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
