<?php
include 'includes/conexion.php';
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$precio = $_POST['precio'];
$fecha_caducidad = $_POST['fecha_caducidad'];

$sql = "UPDATE Medicamentos SET nombre='$nombre', descripcion='$descripcion', stock='$stock', precio='$precio', fecha_caducidad='$fecha_caducidad' WHERE id_medicamento=$id";

if ($conn->query($sql) === TRUE) {
    echo "Medicamento actualizado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: medicamentos.php");
exit;
?>
