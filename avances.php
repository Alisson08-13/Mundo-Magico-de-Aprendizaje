<?php
// avances.php
header('Content-Type: application/json; charset=utf-8');
include("conexion.php");

// Array para guardar todos los avances
$avances = [];

// 1️⃣ Niños
$sql_ninos = "SELECT Nombre, Edad, `Tema de dificultad` AS Tema FROM registro_nino1";
$result_ninos = mysqli_query($conn, $sql_ninos);
if ($result_ninos && mysqli_num_rows($result_ninos) > 0) {
    while ($row = mysqli_fetch_assoc($result_ninos)) {
        $avances[] = [
            "nombre" => $row["Nombre"],
            "tipo" => "Niño",
            "progreso" => $row["Tema"]
        ];
    }
}

// 2️⃣ Maestros
$sql_maestros = "SELECT Nombre, Grado FROM registro_maestros1";
$result_maestros = mysqli_query($conn, $sql_maestros);
if ($result_maestros && mysqli_num_rows($result_maestros) > 0) {
    while ($row = mysqli_fetch_assoc($result_maestros)) {
        $avances[] = [
            "nombre" => $row["Nombre"],
            "tipo" => "Maestro",
            "progreso" => "Grado: " . $row["Grado"]
        ];
    }
}

// 3️⃣ Tutores
$sql_tutores = "SELECT Nombre FROM registro_tutor1";
$result_tutores = mysqli_query($conn, $sql_tutores);
if ($result_tutores && mysqli_num_rows($result_tutores) > 0) {
    while ($row = mysqli_fetch_assoc($result_tutores)) {
        $avances[] = [
            "nombre" => $row["Nombre"],
            "tipo" => "Tutor",
            "progreso" => "Acompañando a un niño"
        ];
    }
}

// Enviar datos como JSON
echo json_encode($avances, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

mysqli_close($conn);
?>
