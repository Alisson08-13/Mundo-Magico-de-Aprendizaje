<?php
$servername = "localhost";
$username = "root";   // el usuario por defecto de XAMPP
$password = "";       // deja vacío si no pusiste contraseña
$dbname = "database"; // ⚠️ cambia por el nombre exacto de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
