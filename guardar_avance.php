<?php
include("conexion.php");
header('Content-Type: application/json; charset=utf-8');

$nombre = $_POST['nombre'] ?? '';
$tipo = $_POST['tipo'] ?? '';
$nivel = $_POST['nivel'] ?? '';
$progreso = $_POST['progreso'] ?? 0;

if (!$nombre || !$nivel || !$tipo) {
    echo json_encode(['status' => 'error', 'message' => 'Faltan datos.']);
    exit;
}

// Buscar si ya existe un registro
$check = $conn->prepare("SELECT id FROM avances WHERE nombre=? AND nivel=?");
$check->bind_param("ss", $nombre, $nivel);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    // Actualizar
    $update = $conn->prepare("UPDATE avances SET progreso=?, fecha=NOW() WHERE nombre=? AND nivel=?");
    $update->bind_param("iss", $progreso, $nombre, $nivel);
    $update->execute();
    echo json_encode(['status' => 'ok', 'message' => 'Progreso actualizado']);
} else {
    // Insertar nuevo
    $insert = $conn->prepare("INSERT INTO avances (nombre, tipo_usuario, nivel, progreso) VALUES (?,?,?,?)");
    $insert->bind_param("sssi", $nombre, $tipo, $nivel, $progreso);
    $insert->execute();
    echo json_encode(['status' => 'ok', 'message' => 'Progreso guardado']);
}

$conn->close();
?>
