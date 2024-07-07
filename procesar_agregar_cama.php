<?php
include 'includes/conexion.php';
$numero_cama = $_POST['numero_cama'];
$estado = $_POST['estado'];
$id_habitacion = $_POST['id_habitacion'];

$sql = "INSERT INTO camas (numero_cama, estado, id_habitacion) 
VALUES ('$numero_cama', '$estado', '$id_habitacion')";

if ($conn->query($sql) === TRUE) {
    echo "Nueva cama agregada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: camas.php");
exit;
?>