<?php
header('Content-Type: application/json; charset=utf-8');
include("conexion.php");

$tipo = $_GET['tipo'] ?? '';
$nombre = $_GET['nombre'] ?? '';

if (!$nombre || !$tipo) {
    echo json_encode(['error' => 'Faltan datos']);
    exit;
}

$sql = "SELECT nivel, progreso FROM avances WHERE nombre='$nombre' AND tipo_usuario='$tipo'";
$resultado = $conn->query($sql);

if (!$resultado) {
    echo json_encode(['error' => $conn->error]);
    exit;
}

$avances = [];
while ($fila = $resultado->fetch_assoc()) {
    $avances[] = [
        'nivel' => $fila['nivel'],
        'progreso' => $fila['progreso'] . '%'
    ];
}

echo json_encode($avances, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
