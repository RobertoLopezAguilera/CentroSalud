<?php
include 'includes/conexion.php';
$id = $_POST['id'];
$nombre = $_POST['nombre'];

$sql = "UPDATE Areas SET nombre='$nombre' WHERE id_area=$id";

if ($conn->query($sql) === TRUE) {
    echo "Área actualizada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: areas.php");
exit;
?>
