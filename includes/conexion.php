<?php
$servername = "localhost";
$username = "root";
$password = "1234Love" /*"root123"*/;
$database = "CentroSalud"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
