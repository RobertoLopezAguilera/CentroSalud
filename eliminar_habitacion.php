<?php
include 'includes/conexion.php';
$id = $_GET['id'];

$sql = "DELETE FROM Habitaciones WHERE id_habitacion=$id";

if ($conn->query($sql) === TRUE) {
    echo "Habitación eliminada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: habitaciones.php");
exit;
?>
