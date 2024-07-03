<?php
include 'includes/conexion.php';
$id = $_POST['id'];
$numero = $_POST['numero'];
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];
$costo = $_POST['costo'];
$id_area = $_POST['id_area'];

$sql = "UPDATE Habitaciones SET numero='$numero', tipo='$tipo', estado='$estado', costo='$costo', id_area='$id_area' WHERE id_habitacion=$id";

if ($conn->query($sql) === TRUE) {
    echo "Habitación actualizada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: habitaciones.php");
exit;
?>
