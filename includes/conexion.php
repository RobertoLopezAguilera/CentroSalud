<?php
$servername = "localhost";
$username = "root";
<<<<<<< HEAD
$password = "root123" /*"root123"*/;
=======
$password = "1234Love" /*"root123"*/;
>>>>>>> 015438a5429332b4db2c50ddaa41de676368c0db
$database = "CentroSalud"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
