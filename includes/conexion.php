<?php
$servername = "localhost";
$username = "root";
$password = "root123" /*"root123"*/;
$database = "CentroSalud"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
