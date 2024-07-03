<?php
include 'includes/conexion.php';
$numero = $_POST['numero'];
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];
$costo = $_POST['costo'];
$id_area = $_POST['id_area'];

$sql = "INSERT INTO Habitaciones (numero, tipo, estado, costo, id_area) VALUES ('$numero', '$tipo', '$estado', '$costo', '$id_area')";

if ($conn->query($sql) === TRUE) {
    echo "Nueva habitación agregada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: habitaciones.php");
exit;
?>
