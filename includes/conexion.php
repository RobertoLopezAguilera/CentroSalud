<?php
$servername = "localhost";
$username = "root";
$password = "68462699426" /*"root123"*/;
$database = "CentroSalud"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
