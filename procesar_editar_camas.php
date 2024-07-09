<?php
include 'includes/conexion.php';

$id = $_POST['id'];
$numero_cama = $_POST['numero_cama'];
$estado = $_POST['estado'];
$id_habitacion = $_POST['id_habitacion'];

$sql = "UPDATE camas SET numero_cama='$numero_cama', estado='$estado' WHERE id_cama='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: camas.php?id_habitacion=$id_habitacion");
    exit;
} else {
    echo "Error al actualizar el registro: " . $conn->error;
}

$conn->close();
?>
