<?php
include 'includes/conexion.php';
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$precio = $_POST['precio'];
$fecha_caducidad = $_POST['fecha_caducidad'];

$sql = "INSERT INTO Medicamentos (nombre, descripcion, stock, precio, fecha_caducidad) VALUES ('$nombre', '$descripcion', '$stock', '$precio', '$fecha_caducidad')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo medicamento agregado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: medicamentos.php");
exit;
?>
