<?php
$servername = "localhost";
$username = "root";
$password = "root123" /*"1234Love"*/;
$database = "CentroSalud"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
